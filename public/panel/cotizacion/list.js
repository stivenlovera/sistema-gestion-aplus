
var table = $('#datatable_cotizacion').DataTable({
    processing: true,
    serverSide: true,
    responsive: true,
    ajax: `${base_url}/cotizacion/lista?orden=${$('#ordenar').val()}`, //
    order: [],
    columns: [{
        data: "fecha_registro",
        name: "fecha_registro"
    },
    {
        data: "nombre",
        name: "nombre"
    },
    {
        data: "servicio_nombre",
        name: "servicio_nombre"
    },
    
    {
        data: "cliente_dirrecion",
        name: "cliente_dirrecion"
    },
    {
        data: "contacto_nombre",
        name: "contacto_nombre"
    },
    {
        data: "contacto_celular",
        name: "contacto_celular"
    },
    {
        data: "estado_cotizacion",
        name: "estado_cotizacion"
    },
    {
        data: "acciones",
        name: "acciones"
    },
    ],
    language: {
        url: "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
    }
});

