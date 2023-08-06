const table = $('#tabla-mobiliario').on('draw.dt', function() {
        $('[data-toggle="tooltip"]').tooltip();
    }).DataTable({
        processing: true,
        serverSide: true,
        ajax: route('gestiones.mobiliario.solicitudes'),
        columns: [
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
            {
                data: 'acciones',
                name: 'Acciones',
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

    $('.dataTables_length').addClass('bs-select');

// Para que la persona solo pueda buscar en la tabla al presionar Enter
var search = $.fn.dataTable.util.throttle(
    function (val) {
        table.search(val).draw();
    },
    1000
);

$(".dataTables_filter input")
    .unbind() // Unbind previous default bindings
    .bind("keyup input", function(e) { // Bind our desired behavior
        // If the user pressed ENTER, search
        if (e.keyCode == 13) {
            search(this.value);
        }
        // Ensure we clear the search if they backspace far enough
        if(this.value == "") {
            //dtable.search("").draw();
            search("");
        }
        return;
    });


// Se agrega un botón de búsqueda al buscador del datatables
const crearBoton = (texto, clase) => {
    const boton = document.createElement('button');
    boton.type = 'button';
    boton.textContent = texto;
    boton.className = clase;
    return boton;
}

const filtro = document.querySelector('.dataTables_filter');
const botonBusqueda = crearBoton('Buscar', 'btn btn-success btn-sm');
botonBusqueda.addEventListener('click', () => {
    const busqueda = document.querySelector('.dataTables_filter input').value;
    search(busqueda);
});
filtro.appendChild(botonBusqueda);

