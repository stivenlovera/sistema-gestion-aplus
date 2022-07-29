<?php

namespace App\Http\Controllers\cliente;

use App\Http\Controllers\Controller;
use DataTables;
use DB;
use Illuminate\Http\Request;
/* use PDF; */
use Validator;

class contactoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('panel.cliente.contacto.list');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function datatable()
    {
        $contactos = DB::table('contacto')
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
        return Datatables::of($contactos)
            ->addIndexColumn()
            ->addColumn('acciones', function ($data) {
                $button = "  <button type='button' class='btn btn-secondary btn-sm m-0 d-inline edit' data-id='$data->id'>Editar</button>
                    <button type='button' class='btn btn-danger btn-sm m-0 d-inline delete' data-id='$data->id'>Eliminar</button>
                ";
                return $button;
            })
            ->rawColumns(['acciones'])
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
        dd($request->all());
        $rules = array(
            'nombre' => 'required',
            'descripcion' => 'nullable',
            'telefono' => 'nullable|numeric',
            'dirrecion' => 'nullable',
            'facturacion' => 'nullable',
            'nit' => 'nullable',
        );
        $messages = [
            'nombre.required' => "Nombre es requerido",
        ];
        $error = Validator::make($request->all(), $rules, $messages);
        if (count($error->errors()->all()) > 0) {
            return response()->json([
                'status' => 'error',
                'message' => $error->errors()->all(),
            ]);
        }

        $cliente = DB::table('cliente')->insertGetId([
            'codigo' => '',
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'telefono' => $request->telefono,
            'dirrecion' => $request->dirrecion,
            'facturacion' => $request->facturacion,
            'nit' => $request->nit,
        ]);
        $this->store_contacto($request, $cliente);
        if ($cliente) {
            return response()->json([
                'status' => 'ok',
                'message' => 'Resgistrado correctamente',
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Ocurrio un error',
            ], 200);
        }
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
        $delete = DB::table('contacto')->where('id', $id)->delete();
        if ($delete) {
            return response()->json([
                'status' => 'ok',
                'message' => 'Contacto eliminado',
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Ocurrio un error',
            ], 200);
        }
    }
}
