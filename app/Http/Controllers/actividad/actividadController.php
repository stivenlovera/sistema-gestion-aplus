<?php

namespace App\Http\Controllers\actividad;

use App\Http\Controllers\Controller;
use DataTables;
use DateTime;
use DB;
use Illuminate\Http\Request;
use \stdClass;

/* use Validator; */
class actividadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $proyecto = DB::table('proyecto')
            ->where('proyecto.id', $id)
            ->first();
        return view('panel.actividad.list', compact('proyecto'));
    }

    public function datatable()
    {
        $proyecto = DB::table('actividad_personal')
            ->select(
                'actividad_personal.*',
                DB::raw('DATE_FORMAT(actividad_personal.fecha_registro, "%Y/%m/%d") as fecha_registro'),
            )
            ->join('proyecto', 'proyecto.id', 'actividad_personal.proyecto_id')
            ->get();
        return Datatables::of($proyecto)
            ->addIndexColumn()
            ->addColumn('estado_actividad', function ($data) {
                $button = "
                <span class='badge badge-info right'><h6 class='m-0'>$data->estado_actividad</h6></span>
                ";
                return $button;
            })
            ->addColumn('acciones', function ($data) { //fa fa-check
                /* $button = "
            <i class='fas fa-play m-1 text-primary " . ($data->estado_actividad == "Comenzar" ? "cursor-pointer iniciar" : "disabled-pointer") . "' data-id='$data->id' ></i>
            <i class='fas fa-pause m-1 text-warning " . ($data->estado_actividad == "Ejecutandose" ? "cursor-pointer Ejecutandose" : "disabled-pointer") . "' data-id='$data->id' ></i>
            <i class='fas fa-stop m-1 text-danger " . ($data->estado_actividad == "Stop" ? "cursor-pointer parar" : "disabled-pointer") . "' data-id='$data->id' ></i>
            "; */
                $button = "
                    <button type='button' class='btn btn-default btn-sm iniciar' data-id='$data->id' " . ($data->estado_actividad == "Comenzar" ? "" : "disabled") . " ><i class='fas fa-play text-primary'></i></button>
                    <button type='button' class='btn btn-default btn-sm pausar' data-id='$data->id' " . ($data->estado_actividad == "Ejecutandose" ? "" : "disabled") . "><i class='fas fa-pause text-success'></i></button>
                    <button type='button' class='btn btn-default btn-sm parar' data-id='$data->id' " . ($data->estado_actividad == "Comenzar" ? "" : "disabled") . "><i class='fas fa-stop text-danger'></i></button>
                    <i class='fas fa-pencil-alt m-1 text-success cursor-pointer' title='Editar Actividad' data-id='$data->id' ></i>
                    <i class='fas fa-trash m-1 text-danger cursor-pointer' title='Editar Actividad' data-id='$data->id' ></i>
                ";
                return $button;
            })
            ->rawColumns(['acciones', 'estado_actividad'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $actividad = DB::table('actividad_personal')->insertGetId([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'proyecto_id' => $request->proyecto_id,
            'persona_id' => auth()->user()->id,
            'horas_estimadas' => $request->horas_estimadas,
            'fecha_registro' => date('Y-m-d', strtotime($request->fecha_registro)),
            'dias' => 0,
            'estado_actividad' => 'Comenzar',
        ]);
        if ($actividad) {
            return response()->json([
                'status' => 'ok',
                'message' => 'Actividad registrada correctamente',
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Ocurrio un error',
            ], 200);
        }
    }

    public function iniciar(Request $request)
    {
        $tarea = DB::table('tareas')
            ->where('tareas.actividad_personal_id', $request->actividad_personal_id)
            ->insertGetId([
                'descripcion' => $request->descripcion,
                'fecha_inicio' => date('Y-m-d H:i:s', strtotime($request->fecha_registro)),
                'actividad_personal_id' => $request->actividad_personal_id,
            ]);
        $actividad = DB::table('actividad_personal')
            ->where('actividad_personal.id', $request->actividad_personal_id)
            ->update([
                'estado_actividad' => 'Ejecutandose',
            ]);
        if ($tarea) {
            return response()->json([
                'status' => 'ok',
                'message' => 'Actividad iniciada',
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Ocurrio un error',
            ], 200);
        }
    }
    public function pausar(Request $request)
    {
        $data = DB::table('tareas')
            ->where('tareas.actividad_personal_id', $request->actividad_personal_id)
            ->first();
        $contador = $this->calcular_minutos($data->fecha_inicio, $request->fecha_registro);
        $tarea = DB::table('tareas')
            ->where('tareas.actividad_personal_id', $request->actividad_personal_id)
            ->update([
                'descripcion' => $request->descripcion,
                'fecha_fin' => date('Y-m-d H:i:s', strtotime($request->fecha_registro)),
                'actividad_personal_id' => $request->actividad_personal_id,
                'horas' => $contador->horas,
            ]);
        $actividad = DB::table('actividad_personal')
            ->where('actividad_personal.id', $request->actividad_personal_id)
            ->first();
        $update = DB::table('actividad_personal')
            ->where('actividad_personal.id', $request->actividad_personal_id)
            ->update([
                'estado_actividad' => 'Comenzar',
                'horas_usadas' => $actividad->horas_usadas + $contador->horas,
                'dias' => $actividad->dias + $contador->dias,
            ]);
        if ($update) {
            return response()->json([
                'status' => 'ok',
                'message' => 'Actividad Pausada correctamente',
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Ocurrio un error',
            ], 200);
        }
    }
    public function parar(Request $request)
    {
        $data = DB::table('tareas')
            ->where('tareas.actividad_personal_id', $request->actividad_personal_id)
            ->first();
        $contador = $this->calcular_minutos($data->fecha_inicio, $request->fecha_registro);
        $tarea = DB::table('tareas')
            ->where('tareas.actividad_personal_id', $request->actividad_personal_id)
            ->update([
                'descripcion' => $request->descripcion,
                'fecha_fin' => date('Y-m-d H:i:s', strtotime($request->fecha_registro)),
                'actividad_personal_id' => $request->actividad_personal_id,
                'horas' => $contador->horas,
            ]);
        $actividad = DB::table('actividad_personal')
            ->where('actividad_personal.id', $request->actividad_personal_id)
            ->first();
        $update = DB::table('actividad_personal')
            ->where('actividad_personal.id', $request->actividad_personal_id)
            ->update([
                'horas_usadas' => $actividad->horas_usadas + $contador->horas,
                'dias' => $actividad->dias + $contador->dias,
                'estado_actividad' => 'Finalizado',
            ]);
        if ($update) {
            return response()->json([
                'status' => 'ok',
                'message' => 'Actividad Finalizada correctamente',
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Ocurrio un error',
            ], 200);
        }
    }
    private function calcular_minutos($fecha_inicio, $fecha_fin)
    {
        $fecha_inicio = new DateTime($fecha_inicio);
        $fecha_fin = new DateTime($fecha_fin);
        $diff = $fecha_inicio->diff($fecha_fin);

        $datos = new stdClass();
        $datos->dias = $diff->days;
        $datos->horas = (($diff->days * 24) + $diff->h) + (100 / 60 * ($diff->i) / 100);
        $datos->min = (100 / 60 * ($diff->i) / 100);
        return $datos;
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
