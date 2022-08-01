@extends('layout.layout')
@push('css-header')
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    {{-- select2 --}}
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endpush
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Lista Cotizaciones</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Lista Cotizaciones</li>
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
                            <h3 class="card-title">Lista de Cotizaciones</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <button class="btn btn-pill btn-warning d-block" style="padding: 0.2rem 0.5rem"
                                    type="button" id="limpiar"><i class="fas fa-trash"></i> otros</button>
                                <button class="btn btn-pill btn-primary d-block" style="padding: 0.2rem 0.5rem;"
                                    type="button" id="nueva_cotizacion"><i class="fa fa-folder-plus"></i> Nueva
                                    Cotizacion</button>
                            </div>
                            <br>
                            <table id="datatable_cotizacion" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Fecha </th>
                                        <th>Nombre</th>
                                        <th>Servicio</th>
                                        <th>Dirrecion</th>
                                        <th>Contacto</th>
                                        <th>Contacto Cel</th>
                                        <th>Estado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Fecha </th>
                                        <th>Nombre</th>
                                        <th>Servicio</th>
                                        <th>Dirrecion</th>
                                        <th>Contacto</th>
                                        <th>Contacto Cel</th>
                                        <th>Estado</th>
                                        <th>Acciones</th>
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
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>

    <script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

    {{-- select2 --}}
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://unpkg.com/emodal@1.2.69/dist/eModal.min.js"></script>
    {{-- momentjs --}}
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>

    {{-- cotizaciones --}}
    <script src="{{ asset('panel/cotizacion/list.js') }}"></script>
    <script src="{{ asset('panel/cotizacion/modalCotizacion/create.js') }}"></script>
    <script src="{{ asset('panel/cotizacion/modalCotizacion/store.js') }}"></script>
    <script src="{{ asset('panel/cotizacion/modalCotizacion/edit.js') }}"></script>
    <script src="{{ asset('panel/cotizacion/modalCotizacion/update.js') }}"></script>
    <script src="{{ asset('panel/cotizacion/modalCotizacion/delete.js') }}"></script>
    <script src="{{ asset('panel/cotizacion/modalCotizacion/table.js') }}"></script>
@endpush
