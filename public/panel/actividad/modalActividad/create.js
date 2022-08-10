$(document).on("click", "#create_actividad", function () {
    $("#actividad").modal("show");
    $('#actividad .modal-title').text('Crear Actividad');
    $('#save').removeClass('store update');
    $('#save').addClass('store');
    $('#form_actividad').trigger("reset");

});
function load_contacto_nuevo() {

    HTMLcontacto = `
            <div class="card-body">
                <div class="callout callout-success">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="contacto_nombre" class="col-sm-4 col-form-label">Contacto
                                    nombre:</label>
                                <div class="col-sm-8">
                                    <input type="text" name="contacto_id[]" class="form-control"
                                        id="contacto_id" placeholder="Contacto nombre" value="" hidden>
                                    <input type="text" name="contacto_nombre[]" class="form-control"
                                        id="contacto_nombre" placeholder="Contacto nombre" value="">
                                </div>
                            </div>
                        </div>
                       
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="celular_contacto" class="col-sm-4 col-form-label">
                                    Contacto Celular:</label>
                                <div class="col-sm-8">
                                    <input type="text" name="celular_contacto[]" class="form-control" value=""
                                        id="celular_contacto" placeholder="Celular Contacto">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label for="email" class="col-sm-2 col-form-label">Email:</label>
                                <div class="col-sm-10">
                                    <input type="email" name="email[]" class="form-control" value=""
                                        id="email" placeholder="Email">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `;

    $('#contactos').append(HTMLcontacto);
}