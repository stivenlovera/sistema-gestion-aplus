<?php

namespace App\Http\Controllers\cliente;

use App\Http\Controllers\Controller;
use DataTables;
use DB;
use Illuminate\Http\Request;
use Validator;

class clienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('panel.cliente.list');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function datatable()
    {
        $clientes = DB::table('cliente')
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
        return Datatables::of($clientes)
            ->addIndexColumn()
            ->addColumn('acciones', function ($data) {
                $button = "
                <button type='button' class='btn btn-primary btn-sm m-0 d-inline cotizar' data-id='$data->id'>Cotizar</button>
                <button type='button' class='btn btn-secondary btn-sm m-0 d-inline edit' data-id='$data->id'>Editar</button>
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
        //dd($request->all());
        $rules = array(
            'nombre' => 'required',
            'descripcion' => 'nullable',
            'telefono' => 'nullable|numeric',
            'dirrecion' => 'nullable',
            'facturacion' => 'nullable',
            'nit' => 'nullable',

            'contacto_nombre.*' => 'required',
            'celular_contacto.*' => 'required|numeric',
            'email.*' => 'nullable|email',
        );
        $messages = [
            'nombre.required' => "Nombre es requerido",
            'contacto_nombre.*.required' => "contacto nombre es requerido",
            'celular_contacto.*.required' => "contacto celular es requerido",
            'celular_contacto.*.numeric' => "contacto celular debe ser un numero",
            'email.*.email' => "contacto email debe ser un email",
        ];
        $error = Validator::make($request->all(), $rules, $messages);
        if (count($error->errors()->all()) > 0) {
            return response()->json([
                'status' => 'error',
                'message' => $error->errors()->all(),
            ]);
        }
        //analizar cadena de codigo deacuendo a la ultima fecha
        $cant = DB::table('cliente')->whereBetween('fecha_registro', [date('Y-m-d'), date("Y-m-d", strtotime(date('Y-m-d') . "+ 1 days"))])->get();

        $cliente = DB::table('cliente')->insertGetId([
            'codigo' => date('Ymd', strtotime($request->fecha_registro)) . (count($cant) + 1),
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'telefono' => $request->telefono,
            'dirrecion' => $request->dirrecion,
            'facturacion' => $request->facturacion,
            'fecha_registro' => date('Y-m-d H:i:s', strtotime($request->fecha_registro)),
            'nit' => $request->nit,
        ]);
        $this->store_contacto($request, $cliente);
        if ($cliente) {
            return response()->json([
                'status' => 'ok',
                'message' => 'Registrado correctamente',
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Ocurrio un error',
            ], 200);
        }
    }
    public function store_contacto(Request $request, $id)
    {
        foreach ($request->contacto_nombre as $key => $nombre) {
            $data = DB::table('contacto')->insert([
                'nombre' => $request->contacto_nombre[$key],
                'celular' => $request->celular_contacto[$key],
                'email' => $request->email[$key],
                'cliente_id' => $id,
            ]);
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
        $cliente = DB::table('cliente')->where('id', $id)->first();
        $contactos = DB::table('contacto')->where('cliente_id', $id)->get();
        if ($cliente) {
            return response()->json([
                'status' => 'ok',
                'data' => [
                    'cliente' => $cliente,
                    'contactos' => $contactos,
                ],
                'message' => 'Registrado correctamente',
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Ocurrio un error',
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
        $rules = array(
            'nombre' => 'required',
            'descripcion' => 'nullable',
            'telefono' => 'nullable|numeric',
            'dirrecion' => 'nullable',
            'facturacion' => 'nullable',
            'nit' => 'nullable',

            'contacto_nombre.*' => 'required',
            'celular_contacto.*' => 'required|numeric',
            'email.*' => 'nullable|email',
        );
        $messages = [
            'nombre.required' => "Nombre es requerido",
            'contacto_nombre.*.required' => "contacto nombre es requerido",
            'celular_contacto.*.required' => "contacto celular es requerido",
            'celular_contacto.*.numeric' => "contacto celular debe ser un numero",
            'email.*.email' => "contacto email debe ser un email",
        ];
        $error = Validator::make($request->all(), $rules, $messages);
        if (count($error->errors()->all()) > 0) {
            return response()->json([
                'status' => 'error',
                'message' => $error->errors()->all(),
            ]);
        }
        //analizar cadena de codigo deacuendo a la ultima fecha
        $cliente = DB::table('cliente')
            ->where('id', $id)
            ->update([
                'nombre' => $request->nombre,
                'descripcion' => $request->descripcion,
                'telefono' => $request->telefono,
                'dirrecion' => $request->dirrecion,
                'facturacion' => $request->facturacion,
                'nit' => $request->nit,
            ]);
        //$this->store_contacto($request, $cliente);
        foreach ($request->contacto_nombre as $key => $contactos) {
            try {
                //dump('update');
                $data = DB::table('contacto')->where('id', $request->contacto_id[$key])
                    ->update([
                        'nombre' => $request->contacto_nombre[$key],
                        'celular' => $request->celular_contacto[$key],
                        'email' => $request->email[$key],
                        'cliente_id' => $id,
                    ]);
            } catch (\Throwable $th) {
                //dump('insert');
                $data = DB::table('contacto')->insert([
                    'nombre' => $request->contacto_nombre[$key],
                    'celular' => $request->celular_contacto[$key],
                    'email' => $request->email[$key],
                    'cliente_id' => $id,
                ]);
            }
        }
        return response()->json([
            'status' => 'ok',
            'message' => 'Modificado correctamente',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = DB::table('cliente')->where('id', $id)->delete();
        $delete_contacto = DB::table('contacto')->where('cliente_id', $id)->delete();
        if ($delete) {
            return response()->json([
                'status' => 'ok',
                'message' => 'Cliente eliminado',
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Ocurrio un error',
            ], 200);
        }
    }
}
