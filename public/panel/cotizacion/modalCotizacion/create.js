$(document).on("click", "#nueva_cotizacion", function () {
    $('#form_cotizacion').trigger("reset");
    $('.tipo_servicio_id').val(null).trigger('change');
    $('.cliente_id').val(null).trigger('change');
    $('.contacto_id').val(null).trigger('change');
    $.ajax({
        type: "GET",
        url: `${base_url}/cotizacion/create`,
        dataType: "json",
        success: function (response) {
            $('#fecha_registro').val(moment().format('YYYY/MM/D hh:mm:ss'))/
            response.data.porcentajes.forEach(porcentajes => {
                switch (porcentajes.nombre) {
                    case 'a':
                        $('#uso_porcentaje_a').val(porcentajes.porcentaje);
                        break;
                    case 'b':
                        $('#uso_porcentaje_b').val(porcentajes.porcentaje);
                        break;
                    case 'c':
                        $('#uso_porcentaje_c').val(porcentajes.porcentaje);
                        break;
                    default:
                        break;
                }
            });
            /*data*/
            $("#cotizacion").modal("show");
            $('#cotizacion .modal-title').text('Nueva Cotizacion');
            $('#save').removeClass('store update');
            $('#save').addClass('store');
            $('#items').html('');
        },
        error: function (jqXHR, textStatus, errorThrown) {
            error_status(jqXHR)
        },
        fail: function () {
            fail()
        }
    });
});

/*Select */
function select2() {
    /*tipo servicio */
    $('.tipo_servicio_id').select2({
        theme: "bootstrap4",
        ajax: {
            url: `${base_url}/cotizacion/tipo-servicio`,
            type: "post",
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    searchTerm: params.term // search term
                };
            },
            processResults: function (response) {
                return {
                    results: response
                };
            },
            cache: true
        }
    }).on('select2:select', function (e) {
        dias = e.params.data.duracion_day;
        /*   $('#edit_fecha_inicio').prop('disabled', false);
          $('#edit_fecha_inicio').val('');
          $('#edit_fecha_fin').val('');
          $('#edit_duracion_evento').val(e.params.data.duracion_day);
          $('#edit_report_alert').val(e.params.data.report_alert);
          $('#edit_tipo_evento').val(e.params.data.tipo_evento); */
    });

    /* cliente */
    $('.cliente_id').select2({
        theme: "bootstrap4",
        ajax: {
            url: `${base_url}/cotizacion/cliente`,
            type: "post",
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    searchTerm: params.term // search term
                };
            },
            processResults: function (response) {
                return {
                    results: response
                };
            },
            cache: true
        }
    }).on('select2:select', function (e) {
        $('#telefono').val(e.params.data.telefono);
        $('#dirrecion').val(e.params.data.dirrecion);
        $('#nit').val(e.params.data.nit);
        $('#facturacion').val(e.params.data.facturacion);
        /*select*/
        $('.contacto_id').prop('disabled', false);
        $('.contacto_id').val(null).trigger('change');
        select_contacto();
    });
}

function select_contacto() {
    $('.contacto_id').select2({
        theme: "bootstrap4",
        ajax: {
            url: `${base_url}/cotizacion/contacto`,
            type: "post",
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    searchTerm: params.term,
                    cliente_id: $('.cliente_id').val() // search term
                };
            },
            processResults: function (response) {
                return {
                    results: response
                };
            },
            cache: true
        }
    }).on('select2:select', function (e) {
        $('#email').val(e.params.data.email);
        $('#celular_contacto').val(e.params.data.celular);
    });
}

select_contacto();
select2();