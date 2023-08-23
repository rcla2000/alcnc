const table = $('#tabla-solicitudes').on('draw.dt', function() {
    $('[data-toggle="tooltip"]').tooltip();
}).DataTable({
    processing: true,
    serverSide: true,
    ajax: route('gestiones.estadoFamiliar.solicitudes'),
    columns: [
        {
            data: 'acciones',
            name: 'Acciones',
            className: 'text-center'
        },
        {
            data: 'dui_solicitante',
            name: 'dui_solicitante',
        },
        {
            data: 'nombre_documento',
            name: 'nombre_documento'
        },
        {
            data: 'fecha_solicitud',
            name: 'fecha_solicitud',
        },
        {
            data: 'estado_solicitud',
            name: 'estado_solicitud',
            className: 'text-center'
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

const detaSoli = (idSoli) => {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.post("/detalle-gestion", {
            id: idSoli
        },
        function(data, status) {
            $('#detalleSolicitud').empty();
            $('#detalleSolicitud').html(data);
            $('#centralModalSm').modal('toggle')
        }).fail(function(e) {
        console.log(e);
        alert("error: " + e);
    });
}



