const table = $('#tabla-usuarios').on('draw.dt', function() {
    $('[data-toggle="tooltip"]').tooltip();
}).DataTable({
    processing: true,
    serverSide: true,
    ajax: route('gestiones.usuarios.listar'),
    columns: [
        // {
        //     data: 'acciones',
        //     name: 'Acciones',
        //     className: 'text-center'
        // },
        {
            data: 'name',
            name: 'name',
        },
        {
            data: 'username',
            name: 'username',
        },
        {
            data: 'dui',
            name: 'dui',
        },
        {
            data: 'rol',
            name: 'rol',
        },
        {
            data: 'area',
            name: 'area',
        },
        {
            data: 'direccion',
            name: 'dirección',
        },
    ],
    language: {
        'decimal': '',
        'emptyTable': 'No hay información',
        'info': 'Mostrando _START_ a _END_ de _TOTAL_ registros',
        'infoEmpty': 'Mostrando 0 to 0 of 0 Entradas',
        'infoFiltered': '(Filtrado de _MAX_ total entradas)',
        'infoPostFix': '',
        'thousands': ',',
        'lengthMenu': 'Mostrar _MENU_ registros',
        'loadingRecords': 'Cargando...',
        'processing': 'Procesando...',
        'search': 'Buscar:',
        'zeroRecords': 'Sin resultados encontrados',
        'paginate': {
        'first': 'Primero',
        'last': 'Último',
        'next': 'Siguiente',
        'previous': 'Anterior'
        }
    },
});



