var table = $('#data_table').DataTable({
    processing: true,
    serverSide: true,
    responsive: true,
    ajax: `${base_url}/cliente/lista?orden=${$('#ordenar').val()}`, //
    order: [],
    columns: [{
            data: "codigo",
            name: "codigo"
        },
        {
            data: "nombre",
            name: "nombre"
        },
        {
            data: "descripcion",
            name: "descripcion"
        },
        {
            data: "telefono",
            name: "telefono"
        },
        {
            data: "dirrecion",
            name: "dirrecion"
        },
        {
            data: 'facturacion',
            name: 'facturacion'
        },
        {
            data: 'nit',
            name: 'nit'
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