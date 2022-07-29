@extends('layout.layout')
@push('css-header')
@endpush
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Lista Proyectos</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Proyectos</a></li>
                        <li class="breadcrumb-item active">Lista Proyectos</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Tabla de informacion de proyectos</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <button class="btn btn-pill btn-warning d-block" style="padding: 0.2rem 0.5rem"
                                    type="button" id="limpiar"><i class="fas fa-trash"></i> otros</button>
                                <button class="btn btn-pill btn-primary d-block" style="padding: 0.2rem 0.5rem;"
                                    type="button" id="new"><i class="fa fa-folder-plus"></i> Nuevo proyecto</button>
                            </div>

                            <br>
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Rendering engine</th>
                                        <th>Browser</th>
                                        <th>Platform(s)</th>
                                        <th>Engine version</th>
                                        <th>CSS grade</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Rendering engine</th>
                                        <th>Browser</th>
                                        <th>Platform(s)</th>
                                        <th>Engine version</th>
                                        <th>CSS grade</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">DataTable with default features</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">

                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <x-.cotizacion.modal-cotizacion />
@endsection
@push('java-script')
   
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://unpkg.com/emodal@1.2.69/dist/eModal.min.js"></script>
    <script>
        var table = $('#table').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: `${base_url}/usuario/data-table?orden=${$('#ordenar').val()}`, //
            order: [],
            columns: [{
                    data: "ci",
                    name: "ci"
                },
                {
                    data: "nombre",
                    name: "nombre"
                },
                {
                    data: "apellido",
                    name: "apellido"
                },
                {
                    data: "nacionalidad",
                    name: "nacionalidad"
                },
                {
                    data: "edad",
                    name: "edad"
                },
                {
                    data: "email",
                    name: "email"
                },
                {
                    data: "celular",
                    name: "celular"
                },
                {
                    data: 'dirrecion',
                    name: 'dirrecion'
                },
                {
                    data: "acciones",
                    name: "acciones"
                },
            ],
            language: {
                url: "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
            }
        });
    </script>
    <script src="{{ asset('panel/cotizacion/modalCotizacion/create.js') }}"></script>
    <script src="{{ asset('panel/cotizacion/modalCotizacion/store.js') }}"></script>
    <script src="{{ asset('panel/cotizacion/modalCotizacion/edit.js') }}"></script>
    <script src="{{ asset('panel/cotizacion/modalCotizacion/update.js') }}"></script>
    <script src="{{ asset('panel/cotizacion/modalCotizacion/delete.js') }}"></script>
@endpush
