$(document).on("click", ".update", function () {

    $.ajax({
        type: "PUT",
        url: `${base_url}/cliente/update/${$('#cliente_id').val()}`,
        data: $('#form_cliente').serialize(),
        dataType: "json",
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
                $("#cliente").modal("hide");
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
    });
    $('#title_modal_usuario').text('Editar usuario')
    $("#usuario").modal("show");
});