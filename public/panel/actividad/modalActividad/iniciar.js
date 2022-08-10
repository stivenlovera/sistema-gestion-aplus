$(document).on("click", ".iniciar", function () {
    const id = $(this).data('id');
    Swal.fire({
        title: 'Esta seguro de Iniciar Actividad?',
        text: "Se contabilizará el tiempo al momento de dar click en inciar",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Iniciar!'
    }).then((result) => {
        if (result.isConfirmed) {
            iniciar(id)
        }
    })
});
function iniciar(id) {
    $.ajax({
        type: "POST",
        url: `${base_url}/actividad/iniciar`,
        data:{
            actividad_personal_id:id,
            fecha_registro:moment().format('YYYY-MM-DD HH:mm:ss'),
        },
        dataType: "json",
        success: function (response) {
            if (response.status == 'ok') {
                Swal.fire({
                    icon: 'success',
                    title:response.message,
                    html: '',
                });
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
$(document).on("click", ".pausar", function () {
    const id = $(this).data('id');
    Swal.fire({
        title: 'Esta seguro de Pausar esta Actividad?',
        text: "Se cancelara el contador de tiempo de la actividad",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Pausar'
    }).then((result) => {
        if (result.isConfirmed) {
            pausar(id)
        }
    })
});
function pausar(id) {
    $.ajax({
        type: "POST",
        url: `${base_url}/actividad/pausar`,
        data:{
            actividad_personal_id:id,
            fecha_registro:moment().format('YYYY-MM-DD HH:mm:ss'),
        },
        dataType: "json",
        success: function (response) {
            if (response.status == 'ok') {
                Swal.fire({
                    icon: 'success',
                    title:response.message,
                    html: '',
                });
                table.draw();
            } else {
                Swal.fire({
                    icon: 'success',
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
$(document).on("click", ".parar", function () {
    const id = $(this).data('id');
    Swal.fire({
        title: 'Esta seguro de dar por finalizada esta Actividad?',
        text: "Se cancelara el contador de tiempo de la actividad",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Pausar'
    }).then((result) => {
        if (result.isConfirmed) {
            parar(id)
        }
    })
});
function parar(id) {
    $.ajax({
        type: "POST",
        url: `${base_url}/actividad/parar`,
        data:{
            actividad_personal_id:id,
            fecha_registro:moment().format('YYYY-MM-DD HH:mm:ss'),
        },
        dataType: "json",
        success: function (response) {
            if (response.status == 'ok') {
                Swal.fire({
                    icon: 'success',
                    title:response.message,
                    html: '',
                });
                table.draw();
            } else {
                Swal.fire({
                    icon: 'success',
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