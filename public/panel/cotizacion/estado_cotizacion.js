
$(document).on("click", ".delete", function () {
    const id = $(this).data('id');
    Swal.fire({
        title: 'Esta seguro de eliminar este cliente?',
        text: "Este proceso no se podra revertir!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, eliminar esto!'
    }).then((result) => {
        if (result.isConfirmed) {
            eliminar(id)
        }
    })
});
function eliminar(id) {
    $.ajax({
        type: "DELETE",
        url: `${base_url}/cliente/delete/${id}`,
        dataType: "json",
        success: function (response) {
            if (response.status == 'ok') {
                Swal.fire(
                    response.message,
                    'Eliminado correctamente',
                    'success'
                );

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
