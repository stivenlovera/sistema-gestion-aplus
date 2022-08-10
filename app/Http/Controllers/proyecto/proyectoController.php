<?php

namespace App\Http\Controllers\proyecto;

use App\Http\Controllers\Controller;
use DataTables;
use DB;
use Illuminate\Http\Request;

/* use Validator; */

class proyectoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('panel.proyecto.list');
    }
    public function datatable()
    {
        $proyecto = DB::table('proyecto')
            ->select(
                'proyecto.*',
                'proyecto_estado.nombre as proyecto_estado'
            )
            ->join('proyecto_estado', 'proyecto_estado.id', 'proyecto.proyecto_estado_id')
            ->get();
        return Datatables::of($proyecto)
            ->addIndexColumn()
            ->addColumn('acciones', function ($data) {
                $button = "
            <a href=" . route('actividad', ['id' => $data->id]) . " class='btn btn-primary btn-sm m-0 d-inline actividad' data-id='$data->id'>Actividades</a>
            <button type='button' class='btn btn-secondary btn-sm m-0 d-inline edit' data-id='$data->id'>Editar</button>
            <button type='button' class='btn btn-danger btn-sm m-0 d-inline delete' data-id='$data->id'>Eliminar</button>
            ";
                return $button;
            })
            ->addColumn('proyecto_estado', function ($data) { //fa fa-check
                switch ($data->proyecto_estado) {
                    case 'en curso':
                        $button = "
                        <button type='button' class='btn btn-primary btn-block btn-sm estado_proyecto' data-id='$data->id' ><i class='fa fa-retweet'></i> $data->proyecto_estado</button>
                    ";
                        break;
                    case 'finalizado':
                        $button = "
                        <button type='button' class='btn btn-success btn-block btn-sm estado_proyecto' data-id='$data->id' ><i class='fa fa-exclamation-triangle'></i> $data->proyecto_estado</button>
                    ";
                        break;
                    default:
                        $button = "
                        <button type='button' class='btn btn-danger btn-block btn-sm estado_proyecto' data-id='$data->id' ><i class='fa fa-exclamation-triangle'></i> $data->proyecto_estado</button>
                    ";
                        break;
                }

                return $button;
            })
            ->rawColumns(['acciones', 'proyecto_estado'])
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
        //
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
