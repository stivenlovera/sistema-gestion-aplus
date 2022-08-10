@extends('layout.layout')
@push('css-header')
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    {{-- select2 --}}
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endpush
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Lista Actividades: {{ $proyecto->nombre }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Actividades</a></li>
                        <li class="breadcrumb-item active">Lista Actividades</li>
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
                            <h3 class="card-title">lista de actividades</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div></div>
                                <button class="btn btn-pill btn-primary d-block" style="padding: 0.2rem 0.5rem;"
                                    type="button" id="create_actividad"><i class="fa fa-plus"></i> Crear actividad</button>
                            </div>
                            <br>
                            <table id="table" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Fecha Reg.</th>
                                        <th>Nombre</th>
                                        <th>Descripcion</th>
                                        <th>Dias</th>
                                        <th>H. Estimadas</th>
                                        <th>H. Usadas</th>
                                        <th>Estado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
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
    <x-.actividad.modal-actividad :proyecto='$proyecto' />
@endsection
@push('java-script')
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>

    {{-- select2 --}}
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://unpkg.com/emodal@1.2.69/dist/eModal.min.js"></script>
    {{-- momentjs --}}
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script>
        var table = $('#table').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: `${base_url}/actividad/data-table`, //
            order: [],
            columns: [
                {
                    data: "fecha_registro",
                    name: "fecha_registro",
                    width: "10%",
                },
                {
                    data: "nombre",
                    name: "nombre",
                    width: "25%",
                },
                {
                    data: "descripcion",
                    name: "descripcion",
                    width: "10%",
                },
                {
                    data: "dias",
                    name: "dias",
                    width: "10%",
                },
                {
                    data: "horas_estimadas",
                    name: "horas_estimadas",
                    width: "10%",
                },
                {
                    data: "horas_usadas",
                    name: "horas_usadas",
                    width: "10%",
                },
                {
                    data: "estado_actividad",
                    name: "estado_actividad",
                    width: "10%",
                },
                {
                    data: "acciones",
                    name: "acciones",
                    width: "15%",
                },
            ],
            language: {
                url: "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
            }
        });
    </script>
    <script src="{{ asset('panel/actividad/modalActividad/iniciar.js') }}"></script>
    <script src="{{ asset('panel/actividad/modalActividad/create.js') }}"></script>
    <script src="{{ asset('panel/actividad/modalActividad/store.js') }}"></script>
    <script src="{{ asset('panel/actividad/modalActividad/edit.js') }}"></script>
    <script src="{{ asset('panel/actividad/modalActividad/update.js') }}"></script>
    <script src="{{ asset('panel/actividad/modalActividad/delete.js') }}"></script>
@endpush
