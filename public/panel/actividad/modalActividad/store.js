$(document).on("click", ".store", function () {
    $('#fecha_registro').val(moment().format('YYYY-MM-DD HH:mm:ss'));
    $.ajax({
        type: "POST",
        url: `${base_url}/actividad/store`,
        dataType: "json",
        data: $('#form_actividad').serialize(),
        success: function (response) {
            if (response.status == 'ok') {
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: response.message,
                    showConfirmButton: false,
                    timer: 2000
                });
                table.draw();
                $("#actividad").modal("hide");
            } else {
                $alert = "";
                response.message.forEach(function (error) {
                    $alert += `* ${error}<br>`;
                });
                Swal.fire({
                    icon: 'error',
                    title: 'complete the following fields to continue:',
                    html: $alert,
                });
            }
        },
        error: function (request, status, error) {
            Swal.fire({
                icon: 'error',
                title: 'Ocurrio un error',
                html: '',
            });
        },
        fail: function (error) {
            Swal.fire({
                icon: 'error',
                title: 'Error de servidor',
                html: '',
            });
        }
    });
});