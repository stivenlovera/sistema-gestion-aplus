<?php

namespace App\Http\Controllers\proyecto;

use App\Http\Controllers\Controller;
use DataTables;
use DB;
use Illuminate\Http\Request;
use Validator;

class cotizacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('panel.cotizaciones.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function datatable()
    {
        $cotizaciones = DB::table('cotizacion')
            ->select(
                'cotizacion.*',
                DB::raw('DATE_FORMAT(cotizacion.fecha_registro, "%Y/%m/%d %h:%m") as fecha_registro'),
                'servicio.nombre as servicio_nombre',
                'cliente.codigo as cliente_codigo',
                'cliente.nombre as cliente_nombre',
                'cliente.dirrecion as cliente_dirrecion',
                'contacto.nombre as contacto_nombre',
                'contacto.celular as contacto_celular',
                'cliente.nit as cliente_nit'
            )
            ->join('servicio', 'cotizacion.servicio_id', 'servicio.id')
            ->join('cliente', 'cliente.id', 'cotizacion.cliente_id')
            ->join('contacto', 'contacto.id', 'cotizacion.contacto_id')
        //filtrando
        /*  ->when(!empty(request()->orden), function ($query) {
        switch (request()->orden) {
        case 'ci':
        return $query->orderBy('ci', 'ASC');
        break;
        case 'nombre':
        return $query->orderBy('nombre', 'ASC');
        break;
        case 'apellido':
        return $query->orderBy('apellido', 'ASC');
        break;
        case 'nacionalidad':
        return $query->orderBy('nacionalidad', 'ASC');
        break;
        default:
        # code...
        break;
        }
        }) */
            ->get();
        return Datatables::of($cotizaciones)
            ->addIndexColumn()
            ->addColumn('acciones', function ($data) {
                $button = "
                <button type='button' class='btn btn-secondary btn-sm m-0 d-inline edit' data-id='$data->id'>Editar</button>
                <button type='button' class='btn btn-danger btn-sm m-0 d-inline delete' data-id='$data->id'>Eliminar</button>
                ";
                return $button;
            })
            ->addColumn('estado_cotizacion', function ($data) { //fa fa-check
                switch ($data->estado_cotizacion) {
                    case 'No aprobado':
                        $button = "
                            <button type='button' class='btn btn-warning btn-block btn-sm estado_proyecto' data-id='$data->id' ><i class='fa fa-exclamation-triangle'></i> $data->estado_cotizacion</button>
                        ";
                        break;
                    case 'Aprobado':
                        $button = "
                            <button type='button' class='btn btn-success btn-block btn-sm estado_proyecto' data-id='$data->id' ><i class='fa fa-exclamation-triangle'></i> $data->estado_cotizacion</button>
                        ";
                        break;
                    default:
                        # code...
                        break;
                }

                return $button;
            })
            ->rawColumns(['acciones', 'estado_cotizacion'])
            ->make(true);
    }

    public function create()
    {
        $porcentajes = $this->porcentajes();
        if ($porcentajes) {
            return response()->json([
                'status' => 'ok',
                'data' => [
                    'porcentajes' => $porcentajes,
                ],
                'message' => 'Datos necesarios',
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Ocurrio un error',
            ], 200);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $rules = array(
            'tipo_servicio_id' => 'required',
            'fecha_registro' => 'nullable',
            'contacto_id' => 'required',
            'cliente_id' => 'required',
            'nombre' => 'required',

            'item_id.*' => 'nullable',
            'item_nombre.*' => 'required',
            'item_codigo.*' => 'required',
            'item_descripcion.*' => 'required',
            'item_cantidad.*' => 'required|numeric',
            'item_utilidad.*' => 'required|numeric',
            'item_precio_unitario_compra.*' => 'required|numeric',
            'item_precio_total_compra.*' => 'required|numeric',
            'item_precio_unitario.*' => 'required|numeric',
            'item_precio_total.*' => 'required|numeric',

            'porcentaje_a' => 'required|numeric',
            'porcentaje_b' => 'required|numeric',
            'porcentaje_c' => 'required|numeric',
            'utilidades' => 'required|numeric',

            'total_costo' => 'required|numeric',
            'total' => 'required|numeric',
        );
        $messages = [
            'tipo_servicio_id.required' => 'Selecione tipo de servicio',
            'fecha_registro.required' => 'nullable',
            'contacto_id.required' => 'Selecione un contacto',
            'cliente_id.required' => 'Selecione un cliente',
            'nombre.required' => 'Nombre es requerido',

            'item_id.*.required' => 'nullable',
            'item_numero.*.required' => 'Item es requerido',
            'item_codigo.*.required' => 'Codigo es requerido',
            'item_descripcion.*.required' => 'Descripcion es requerido',
            'item_cantidad.*.required' => 'Cantidad es requerido',
            'item_cantidad.*.numeric' => 'Cantidad debe se un numero',
            'item_utilidad.*.required' => 'Utilidad es requerida',
            'item_utilidad.*.numeric' => 'Utilidad debe se un numero',
            'item_precio_unitario_compra.*.required' => 'Precio unitario compra es requerido',
            'item_precio_unitario_compra.*.numeric' => 'Precio unitario compra debe ser un numero',
            'item_precio_total_compra.*.required' => 'Total compra es requerido',
            'item_precio_total_compra.*.numeric' => 'Total compra debe ser un numero',
            'item_precio_unitario.*.required' => 'Precio unitario es requerido',
            'item_precio_unitario.*.numeric' => 'Precio unitario debe ser un numero',
            'item_precio_total.*.required' => 'Precio total es requerido',
            'item_precio_total.*.numeric' => 'Precio total debe ser un numero',

            'porcentaje_a' => 'required|numeric',
            'porcentaje_b' => 'required|numeric',
            'porcentaje_c' => 'required|numeric',
            'utilidades' => 'required|numeric',

            'total_costo.required' => 'Total costo es requerido',
            'total_costo.numeric' => 'Total costo debe ser un numero',
            'total.required' => 'Total es requerido',
            'total.numeric' => 'Total debe ser numero',
        ];
        $error = Validator::make($request->all(), $rules, $messages);
        if (count($error->errors()->all()) > 0) {
            return response()->json([
                'status' => 'error',
                'message' => $error->errors()->all(),
            ]);
        }

        $cotizacion = DB::table('cotizacion')->insertGetId([
            'servicio_id' => $request->tipo_servicio_id,
            'fecha_registro' => date('Y-m-d H:i:s', strtotime($request->fecha_registro)),
            'cliente_id' => $request->cliente_id,
            'contacto_id' => $request->contacto_id,
            'nombre' => $request->nombre,
            'precio_total' => $request->total,
            'costo_total' => $request->total_costo,
            'utilidades' => $request->utilidades,
            'porcentaje_a' => $request->porcentaje_a,
            'porcentaje_b' => $request->porcentaje_b,
            'porcentaje_c' => $request->porcentaje_c,
            'uso_porcentaje_a' => $request->uso_porcentaje_a,
            'uso_porcentaje_b' => $request->uso_porcentaje_b,
            'uso_porcentaje_c' => $request->uso_porcentaje_c,
            'cotizacion_estado_id' => '1',
        ]);
        foreach ($request->item_cantidad as $key => $cantidad) {
            /*  if ($request->item_id[$key] == null) {
            $this->create_items($request, $key, $cotizacion);
            } else {
            $this->update_items($request, $key, $cotizacion);
            } */
            $this->create_items($request, $key, $cotizacion);
        }
        if ($cotizacion) {
            return response()->json([
                'status' => 'ok',
                'message' => 'Cotizacion registrada correctamente',
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Ocurrio un error',
            ], 200);
        }
    }

    public function create_items(Request $request, $key, $cotizacion_id)
    {
        $materiales = DB::table('material_cotizacion')
            ->insert([
                'item' => $request->item_numero[$key],
                'codigo' => $request->item_codigo[$key],
                'descripcion' => $request->item_descripcion[$key],
                'cantidad' => $request->item_cantidad[$key],
                'utilidad' => $request->item_utilidad[$key],
                'precio_unitario_compra' => $request->item_precio_unitario_compra[$key],
                'precio_total_compra' => $request->item_precio_total_compra[$key],
                'precio_unitario' => $request->item_precio_unitario[$key],
                'precio_total' => $request->item_precio_total[$key],
                'cotizacion_id' => $cotizacion_id,
            ]);
    }
    public function update_items(Request $request, $key, $cotizacion_id)
    {
        $materiales = DB::table('material_cotizacion')->where('id', $request->item_id[$key])
            ->update([
                'item' => $request->item_numero[$key],
                'codigo' => $request->item_codigo[$key],
                'descripcion' => $request->item_descripcion[$key],
                'cantidad' => $request->item_cantidad[$key],
                'utilidad' => $request->item_utilidad[$key],
                'precio_unitario_compra' => $request->item_precio_unitario_compra[$key],
                'precio_total_compra' => $request->item_precio_total_compra[$key],
                'precio_unitario' => $request->item_precio_unitario[$key],
                'precio_total' => $request->item_precio_total[$key],
                'cotizacion_id' => $cotizacion_id,
            ]);
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
        $cotizacion = DB::table('cotizacion')
            ->select(
                'cotizacion.*',
                'contacto.nombre as contacto_nombre',
                'contacto.celular as contacto_celular',
                'contacto.email as contacto_email',
                'cliente.codigo',
                'cliente.nombre',
                'cliente.descripcion',
                'cliente.telefono',
                'cliente.dirrecion',
                'cliente.facturacion',
                'cliente.nit'
            )
            ->join('cliente', 'cliente.id', 'cotizacion.cliente_id')
            ->join('contacto', 'contacto.id', 'cotizacion.contacto_id')
            ->where('cotizacion.id', $id)
            ->first();
        $items = DB::table('material_cotizacion')
            ->where('material_cotizacion.cotizacion_id', $id)
            ->get();
        $cotizacion->items = $items;
        if ($cotizacion) {
            return response()->json([
                'status' => 'ok',
                'data' => $cotizacion,
                'message' => 'informacion de cotizacion',
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'A ocurrido un error',
            ], 200);
        }
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
    /*estado cotizacion */
    public function estado_cotizacion($id)
    {
        $cotizacion = DB::table('cotizacion')
            ->where('cotizacion.id', $id)
            ->update([
                'estado_cotizacion' => 'Aprovado',
            ]);
        if ($cotizacion) {
            return response()->json([
                'status' => 'ok',
                'message' => 'Estado',
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'A ocurrido un error',
            ], 200);
        }
    }
    /*servicio */
    public function tipo_servicio(Request $request)
    {
        if (!isset($request->searchTerm)) {
            $tipo_servicios = DB::table('servicio')->get();
        } else {
            $tipo_servicios = DB::table('servicio')->where('nombre', 'like', '%' . $request->searchTerm . '%')
                ->distinct('nombre')
                ->get();
        }
        $data = [];
        foreach ($tipo_servicios as $row) {
            $data[] = array(
                "id" => $row->id,
                "text" => $row->nombre,
            );
        }
        return response()->json($data);
    }
    public function cliente(Request $request)
    {
        if (!isset($request->searchTerm)) {
            $tipo_servicios = DB::table('cliente')->get();
        } else {
            $tipo_servicios = DB::table('cliente')->where('nombre', 'like', '%' . $request->searchTerm . '%')
                ->distinct('nombre')
                ->get();
        }
        $data = [];
        foreach ($tipo_servicios as $row) {
            $data[] = array(
                "id" => $row->id,
                "text" => $row->nombre,
                "telefono" => $row->telefono,
                "dirrecion" => $row->dirrecion,
                "facturacion" => $row->facturacion,
                "nit" => $row->nit,
            );
        }
        return response()->json($data);
    }
    public function contacto(Request $request)
    {
        if (!isset($request->searchTerm)) {
            $tipo_servicios = DB::table('contacto')
                ->where('contacto.cliente_id', $request->cliente_id)
                ->get();
        } else {
            $tipo_servicios = DB::table('contacto')
                ->where('nombre', 'like', '%' . $request->searchTerm . '%')
                ->where('contacto.cliente_id', $request->cliente_id)
                ->distinct('nombre')
                ->get();
        }
        $data = [];
        foreach ($tipo_servicios as $row) {
            $data[] = array(
                "id" => $row->id,
                "text" => $row->nombre,
                "celular" => $row->celular,
                "email" => $row->email,
            );
        }
        return response()->json($data);
    }
    private function porcentajes()
    {
        $porcentajes = DB::table('porcentajes')
            ->get();
        return $porcentajes;
    }
}
