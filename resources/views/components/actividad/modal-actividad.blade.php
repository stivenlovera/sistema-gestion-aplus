<div class="modal fade" id="actividad">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form_actividad">
                    <input type="text" name="fecha_registro" id="fecha_registro" hidden>
                    <input type="text" name="actividad_personal_id" id="actividad_personal_id" hidden>
                    <input type="text" name="proyecto_id" id="proyecto_id" value="{{$proyecto->id}}" hidden>
                    <input type="text" name="actividad_personal_id" id="actividad_personal_id" hidden>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="nombre" class="col-sm-4 col-form-label">Proyecto:</label>
                                <div class="col-sm-8">
                                    <input type="text" name="nombre_proyecto" class="form-control" id="nombre_proyecto"
                                    value="{{$proyecto->nombre}}"
                                        placeholder="Proyecto" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="telefono" class="col-sm-4 col-form-label">Horas estimadas:</label>
                                <div class="col-sm-8">
                                    <input type="number" name="horas_estimadas" class="form-control" id="horas_estimadas"
                                        placeholder="Horas estimadas">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="nombre" class="col-sm-4 col-form-label">Nombre:</label>
                                <div class="col-sm-8">
                                    <input type="text" name="nombre" class="form-control" id="nombre"
                                        placeholder="Nombre">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="telefono" class="col-sm-4 col-form-label">Horas usadas:</label>
                                <div class="col-sm-8">
                                    <input type="number" name="horas_usadas" class="form-control" id="horas_usadas"
                                        placeholder="Horas usadas" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="telefono" class="col-sm-4 col-form-label">Creado por:</label>
                                <div class="col-sm-8">
                                    <input type="text" name="creado_por" class="form-control"
                                    value="{{ auth()->user()->persona->nombre }} {{ auth()->user()->persona->apellido }}"
                                        id="creado_por" placeholder="Creado por:" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label for="telefono" class="col-sm-2 col-form-label">Descripcion:</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" rows="3" name="descripcion" placeholder="Descripcion"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    {{-- <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div> --}}
                </form>

            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="save">Guardar</button>
            </div>
        </div>
    </div>
</div>
