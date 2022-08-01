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
                    <h1>Contactos</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Lista Contactos</li>
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
                            <h3 class="card-title">Lista de Contactos</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                               <p></p>
                                <button class="btn btn-pill btn-primary d-block" style="padding: 0.2rem 0.5rem;"
                                    type="button" id="new"><i class="fas fa-user-edit"></i> Nuevo Contactos</button>
                            </div>
                            <br>
                            <table id="data_table" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Nombres</th>
                                        <th>Celular</th>
                                        <th>Email</th>
                                        <th>Cliente</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                               <tbody>

                               </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Nombres</th>
                                        <th>Celular</th>
                                        <th>Email</th>
                                        <th>Cliente</th>
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
    <x-.contacto.modal-contacto />
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

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://unpkg.com/emodal@1.2.69/dist/eModal.min.js"></script>
    <script>
       /*  var table=$("#data_table").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
        }).buttons().container().appendTo('#data_table_wrapper .col-md-6:eq(0)'); */

        var table = $('#data_table').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: `${base_url}/contacto/lista?orden=${$('#ordenar').val()}`, //
            order: [],
            columns: [{
                    data: "nombre",
                    name: "nombre"
                },
                {
                    data: "celular",
                    name: "celular"
                },
                {
                    data: "email",
                    name: "email"
                },
               
                {
                    data: 'nombre_cliente',
                    name: 'nombre_cliente'
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
    <script src="{{ asset('panel/cliente/modalCliente/create.js') }}"></script>
    <script src="{{ asset('panel/cliente/modalCliente/store.js') }}"></script>
    <script src="{{ asset('panel/cliente/modalCliente/edit.js') }}"></script>
    <script src="{{ asset('panel/cliente/modalCliente/update.js') }}"></script>
    <script src="{{ asset('panel/cliente/modalCliente/delete.js') }}"></script>
@endpush
