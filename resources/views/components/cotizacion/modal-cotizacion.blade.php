<div class="modal fade" id="cotizacion">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="fecha_registro" class="col-sm-4 col-form-label">Fecha Registro:</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="fecha_registro"
                                        placeholder="Fecha Registro" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="nombre" class="col-sm-4 col-form-label">Tipo de Servicio:</label>
                                <div class="col-sm-8">
                                    
                                        <select name="tipo_servicio" class="form-control select2" style="width: 100%;">
                                          <option selected="selected">Alabama</option>
                                          <option>Alaska</option>
                                          <option>California</option>
                                          <option>Delaware</option>
                                          <option>Tennessee</option>
                                          <option>Texas</option>
                                          <option>Washington</option>
                                        </select>
                                     
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">

                        </div>
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label for="nombre" class="col-sm-2 col-form-label">Cotizacion:</label>
                                <div class="col-sm-10">
                                    <input type="text" name="nombre" class="form-control" id="nombre"
                                        placeholder="Titulo de cotizacion">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <p>
                                <code> Informacion de cliente</code>
                            </p>
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
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="contacto" class="col-sm-4 col-form-label">Contacto:</label>
                                <div class="col-sm-8">
                                    <input type="text" name="contacto" class="form-control" id="contacto"
                                        placeholder="Contacto">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="celular_contacto" class="col-sm-4 col-form-label">Celular Contacto:</label>
                                <div class="col-sm-8">
                                    <input type="text" id="celular_contacto" class="form-control"
                                        id="celular_contacto" placeholder="Celular Contacto">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label for="email" class="col-sm-2 col-form-label">Email:</label>
                                <div class="col-sm-10">
                                    <input type="email" name="email" class="form-control" id="email"
                                        placeholder="Email">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="facturacion" class="col-sm-4 col-form-label">Nombre p/
                                    Facturacion:</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="facturacion" id="facturacion"
                                        placeholder="Nombre p/ Facturacion">
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
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="d-flex justify-content-between">
                                        <h3 class="card-title mt-2">Detalle</h3>
                                        <button class="btn btn-pill btn-primary d-block" style=""
                                            type="button" id="añadir_item"><i class="fas fa-plus"></i> Agregar
                                            item</button>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body table-responsive p-0" style="height: 300px;">
                                    <table class="table table-head-fixed text-nowrap">
                                        <thead>
                                            <tr>
                                                <th>Item</th>
                                                <th>Codigo</th>
                                                <th>Descripcion</th>
                                                <th>Cantidad</th>
                                                <th>P/U</th>
                                                <th>P/T</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody id="items">
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">

                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="total" class="col-sm-4 col-form-label">Total:</label>
                                <div class="col-sm-8">
                                    <input type="text" id="total" class="form-control" id="total"
                                        placeholder="Total">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </div>
</div>
