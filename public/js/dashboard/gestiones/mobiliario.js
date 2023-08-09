const table = $('#tabla-mobiliario').on('draw.dt', function() {
        $('[data-toggle="tooltip"]').tooltip();
    }).DataTable({
        processing: true,
        serverSide: true,
        ajax: route('gestiones.mobiliario.solicitudes'),
        columns: [
            {
                data: 'acciones',
                name: 'Acciones',
                className: 'text-center'
            },
            {
                data: 'usuario',
                name: 'usuario',
            },
            {
                data: 'lugar_solicitado',
                name: 'lugar_solicitado',
            },
            {
                data: 'fecha_solicitud',
                name: 'fecha_solicitud',
            },
            {
                data: 'fecha_evento',
                name: 'fecha_evento',
            },
            {
                data: 'estado',
                name: 'estado',
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


