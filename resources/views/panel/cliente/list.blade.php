@extends('layout.layout')
@push('css-header')
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endpush
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Clientes</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Lista clientes</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Lista Clientes</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                {{-- <button class="btn btn-pill btn-warning d-block" style="padding: 0.2rem 0.5rem"
                                    type="button" id="limpiar"><i class="fas fa-trash"></i> otros</button> --}}
                                <p></p>
                                <button class="btn btn-pill btn-primary d-block" style="padding: 0.2rem 0.5rem;"
                                    type="button" id="new"><i class="fas fa fa-plus"></i> Nuevo cliente</button>
                            </div>
                            <br>
                            <table id="data_table" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Codigo</th>
                                        <th>Nombre</th>
                                        <th>Descripcion</th>
                                        <th>Telefono</th>
                                        <th>Dirrecion</th>
                                        <th>Num Factura</th>
                                        <th>Nit/CI</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Codigo</th>
                                        <th>Nombre Cliente</th>
                                        <th>Descripcion</th>
                                        <th>Telefono</th>
                                        <th>Dirrecion</th>
                                        <th>Num Factura</th>
                                        <th>Nit/CI</th>
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

    <!-- Main content -->
    <x-.cliente.modal-cliente />
@endsection
@push('java-script')
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>

    <script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>

    <script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    {{-- alert --}}
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- modal iframe --}}
    <script src="https://unpkg.com/emodal@1.2.69/dist/eModal.min.js"></script>
    {{-- momentjs --}}
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>

    {{-- sistema --}}
    <script src="{{ asset('panel/cliente/list.js') }}"></script>
    <script src="{{ asset('panel/cliente/modalCliente/create.js') }}"></script>
    <script src="{{ asset('panel/cliente/modalCliente/store.js') }}"></script>
    <script src="{{ asset('panel/cliente/modalCliente/edit.js') }}"></script>
    <script src="{{ asset('panel/cliente/modalCliente/update.js') }}"></script>
    <script src="{{ asset('panel/cliente/modalCliente/delete.js') }}"></script>

    <script src="{{ asset('panel/cliente/modalCotizacion/cotizacion.js') }}"></script>
@endpush
