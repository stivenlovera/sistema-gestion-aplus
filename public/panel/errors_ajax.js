function error_status(jqXHR) {
    switch (jqXHR.status) {
        case 419:
            Swal.fire({
                icon: 'error',
                title: 'Sesion expirada',
                html: 'Porfavor recarge la pagina'
            });
            break;
        case 401:
            Swal.fire({
                icon: 'error',
                title: 'Sesion expirada',
                html: 'Porfavor recarge la pagina'
            });
            break;
        default:
            Swal.fire({
                icon: 'error',
                title: 'A ocurrido un error en el servidor',
                html: 'error de server',
            });
            break;
    }
}
function fail() {
    Swal.fire({
        icon: 'error',
        title: 'Error de conexion',
        html: 'error de server',
    });
}