<div class="modal fade" id="cliente">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form_cliente">
                    <input type="text" name="fecha_registro" id="fecha_registro" hidden>
                    <input type="text" name="cliente_id" id="cliente_id" hidden>
                    <div class="row">
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
                                <label for="telefono" class="col-sm-4 col-form-label">Telefono:</label>
                                <div class="col-sm-8">
                                    <input type="text" name="telefono" class="form-control" id="telefono"
                                        placeholder="Telefono">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label for="dirrecion" class="col-sm-2 col-form-label">Dirrecion:</label>
                                <div class="col-sm-10">
                                    <input type="text" name="dirrecion" class="form-control" id="dirrecion"
                                        placeholder="Dirrecion">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 d-flex justify-content-between mb-2">
                            <p class="mb-0">
                                <code>Contactos</code>
                            </p>
                            <button class="btn btn-pill btn-primary d-block" style="padding: 0.2rem 0.5rem;"
                                type="button" id="nuevo_contacto"><i class="fas fa-user-edit"></i> Nuevo
                                Contacto</button>
                        </div>
                        <div class="col-md-12" id="contactos">
                          
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="facturacion" class="col-sm-4 col-form-label">
                                    Nombre Facturacion:</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="facturacion" id="facturacion"
                                        placeholder="Nombre Facturacion">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="nit" class="col-sm-4 col-form-label">NIT/CI</label>
                                <div class="col-sm-8">
                                    <input type="text" name="nit" class="form-control" id="nit"
                                        placeholder="NIT/CI">
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
