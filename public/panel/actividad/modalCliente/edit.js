
$(document).on("click", ".edit", function () {
    const id = $(this).data('id');
    $('#form_cliente').trigger("reset");
    $.ajax({
        type: "GET",
        url: `${base_url}/cliente/edit/${id}`,
        dataType: "json",
        success: function (response) {
            $('#cliente_id').val(response.data.cliente.id);
            $('#nombre').val(response.data.cliente.nombre);
            $('#telefono').val(response.data.cliente.telefono);
            $('#dirrecion').val(response.data.cliente.dirrecion);
            $('#facturacion').val(response.data.cliente.facturacion);
            $('#nit').val(response.data.cliente.nit);
            $("#cliente").modal("show");
            $('#cliente .modal-title').text('Editar Cliente');
            $('#contactos').children().remove();
            load_contacto_edit(response.data.contactos);
        },
        error: function (request, status, error) {
            Swal.fire({
                icon: 'error',
                title: 'Ocurrio un error',
                html: '',
            });
        }
    });
    $('#save').removeClass('store update');
    $('#save').addClass('update');
    $('#nuevo_contacto').show();
});

function load_contacto_edit(contactos) {
    var HTMLcontacto = ``;
    contactos.forEach(contacto => {
        HTMLcontacto += `
    <div id="accordion">
        <div class="card card-light">
            <div class="card-header">
                <h4 class="card-title w-100">
                    <div class="col-md-12 d-flex justify-content-between mb-0">
                        <div class="m-0">
                            <p class="m-2">${contacto.nombre == null ? '' : contacto.nombre} - ${contacto.celular == null ? '' : contacto.celular}</p>
                        </div>
                        <div>
                            <button class="btn btn-pill btn-warning inline m-1 contact_editar"
                                data-toggle="collapse" href="#collapse${contacto.id}"
                                style="padding: 0.2rem 0.5rem;" type="button">Editar</button>
                            <a class="btn btn-pill btn-danger inline m-1 contact_delete" data-id="${contacto.id}"
                                style="padding: 0.2rem 0.5rem;" type="button">Eliminar</a>
                        </div>

                    </div>
                </h4>
            </div>
            <div id="collapse${contacto.id}" class="collapse" data-parent="#accordion">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="contacto_nombre" class="col-sm-4 col-form-label">Contacto
                                    nombre:</label>
                                <div class="col-sm-8">
                                    <input type="text" name="contacto_id[]" class="form-control"
                                        id="contacto_id" placeholder="Contacto nombre" value="${contacto.id}" hidden>
                                    <input type="text" name="contacto_nombre[]" class="form-control"
                                        id="contacto_nombre" placeholder="Contacto nombre" value="${contacto.nombre == null ? '' : contacto.nombre}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="celular_contacto" class="col-sm-4 col-form-label">
                                    Contacto Celular:</label>
                                <div class="col-sm-8">
                                    <input type="text" name="celular_contacto[]" class="form-control" value="${contacto.celular == null ? '' : contacto.celular}"
                                        id="celular_contacto" placeholder="Celular Contacto">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label for="email" class="col-sm-2 col-form-label">Email:</label>
                                <div class="col-sm-10">
                                    <input type="email" name="email[]" class="form-control" value="${contacto.email == null ? '' : contacto.email}"
                                        id="email" placeholder="Email">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        `;
    });
    $('#contactos').append(HTMLcontacto);
}
$(document).on("click", "#nuevo_contacto", function () {
    añadir_contacto()
});
function añadir_contacto() {
    const HTMLContacto = `
<div class="card-body">
    <div class="callout callout-success">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group row">
                    <label for="contacto_nombre" class="col-sm-4 col-form-label">Contacto
                        nombre:</label>
                    <div class="col-sm-8">

                        <input type="text" name="contacto_nombre[]"
                            class="form-control" id="contacto_nombre"
                            placeholder="Contacto nombre">
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group row">
                    <label for="celular_contacto" class="col-sm-4 col-form-label">
                        Contacto Celular:</label>
                    <div class="col-sm-8">
                        <input type="text" name="celular_contacto[]"
                            class="form-control" id="celular_contacto"
                            placeholder="Celular Contacto">
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label">Email:</label>
                    <div class="col-sm-10">
                        <input type="email" name="email[]" class="form-control"
                            id="email" placeholder="Email">
                    </div>
                </div>
            </div>
            <div class="col-md-12 d-flex justify-content-end">
                <button class="btn btn-pill btn-danger d-block contact_delete_edit"
                    style="padding: 0.2rem 0.5rem;" type="button">Eliminar</button>
            </div>
        </div>
    </div>
</div>`;
    $('#contactos').append(HTMLContacto);
}
$(document).on("click", ".contact_delete_edit", function () {
    $(this).parent().parent().parent().parent().remove();
});

$(document).on("click", ".contact_delete", function () {
    const id = $(this).data('id');
    const view = $(this);
    Swal.fire({
        title: 'Esta seguro de eliminar este contacto?',
        text: "Este proceso no se podra revertir!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, eliminar esto!'
    }).then((result) => {
        if (result.isConfirmed) {
            eliminar_contacto(id, view)
        }
    })
});

function eliminar_contacto(id, view) {
    $.ajax({
        type: "DELETE",
        url: `${base_url}/contacto/delete/${id}`,
        dataType: "json",
        success: function (response) {
            if (response.status == 'ok') {
                Swal.fire(
                    response.message,
                    'Eliminado correctamente',
                    'success'
                );
                //vista eliminada
                view.parent().parent().parent().parent().parent().remove();
                table.draw();
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Ocurrio un error',
                    html: '',
                });
            }
        },
        error: function (request, status, error) {
            Swal.fire({
                icon: 'error',
                title: 'Error servidor',
                html: '',
            });
        }
    });
}