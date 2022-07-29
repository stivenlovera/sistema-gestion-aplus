<?php

namespace App\Http\Controllers\proyecto;

use App\Http\Controllers\Controller;
use DataTables;
use DB;
use Illuminate\Http\Request;

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
                'servicio.nombre as nombre_servicio'
            )
            ->join('servicio', 'cotizacion.servicio_id', 'servicio.id')
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
            ->rawColumns(['acciones'])
            ->make(true);
    }

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
