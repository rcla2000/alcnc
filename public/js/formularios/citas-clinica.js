///funcion para filtrar fechas disponibles por especialidad
const form = document.querySelector('#frm-cita');
const especialidad = document.querySelector('#espe');
const errorFecha = document.querySelector('#error-fecha');

form.addEventListener('submit', (e) => {
    e.preventDefault();
    let errores = 0;

    if (estaVacio(especialidad.value)) {
        agregarError(especialidad, especialidad.nextElementSibling, 'Debe seleccionar una especialidad');
        errores += 1;
    } else {
        limpiarError(especialidad, especialidad.nextElementSibling);
    }

    if (estaVacio(document.querySelector('#fecha').value)) {
        errorFecha.textContent = 'Seleccione una fecha disponible para la cita';
        errores += 1;
    } else {
        errorFecha.textContent = '';
    }

    if (errores == 0) {
        $.confirm({
            title: "Confirmar información",
            content: "¿Esta seguro/a que desea realizar su cita?",
            buttons: {
                si: {
                    text: "SÍ",
                    btnClass: "btn-success",
                    keys: ["enter", "shift"],
                    action: function () {
                        form.submit();
                    },
                },
                no: {
                    text: "NO",
                    btnClass: "btn-danger",
                    keys: ["enter", "shift"],
                    action: function () {
                        $.alert({
                            title: "Información",
                            content: "Cita cancelada",
                        });
                    },
                },
            },
        });
    }
});

function filtrar(espe) {
    var fechas =[];
    var hoy =new Date();
    var tomorrow = new Date( hoy.getTime() + 24*60*60*1000);
    var finMes = new Date(hoy.getFullYear(), hoy.getMonth() + 1, 0)
    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    ////realizo consulta para filtrar las fechas disponibles segun especialidad
    ////la consulta me devuelve un json
    $.post( '/filtrarCitas',{espec:espe } ,function( data ) {
                data.forEach(e => {
                    var fecha = new Date(e.fecha_cita);
                    fecha.setMinutes(fecha.getMinutes()+fecha.getTimezoneOffset())
                    fechas.push(fecha);
                });
                
                ////aqui cargo el loaader para mientras carga las fechas disponibles
                $('#fechacita').empty();
                $('#fechacita').addClass('text-center')
                $('#fechacita').html('<p>Verficando fechas disponibles...'+  
                                        '<div class="preloader-wrapper big active">'+
                                        '<div class="spinner-layer spinner-blue-only">'+
                                        '<div class="circle-clipper left"> <div class="circle"></div></div>'+
                                        '<div class="gap-patch"><div class="circle"></div></div>'+
                                        '<div class="circle-clipper right">'+
                                        '<div class="circle"></div>'+
                                        '</div>  </div></div>');
                ////aqui pongo un temporizador para que cargue el datepicker en 2 segundos
                setTimeout(() => {
                    $('#fechacita').removeClass('text-center')
                    $('#fechacita').empty();
                    $('#fechacita').html(
                    
                    '<input placeholder="Select date" type="text" id="fecha" name="fecha" class="form-control">'+
                    '<i class="fas fa-calendar input-prefix" tabindex=0></i>'
                    );
                        $('#fechacita').datepicker({
                            disable: fechas,
                            min:tomorrow,
                            max: finMes,
                            monthsFull: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Juio', 'Julio', 'Agosto', 'Septiembre', 'Octubre',  'Noviembre', 'Diciembre'],
                            weekdaysShort: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'],
                            clear: 'limpiar',
                            formatSubmit: 'yyyy/mm/dd'
                        });
                    }, "2000");
        });
}

///cuando cambio la especialidad filtro las fechas disponibles con la funcion 'filtrar'
$('#espe').change(function() {
    var especialidad = $('#espe option:selected').text();
    filtrar(especialidad)
})

$('.boton').click(function(){
    $('#alerta').hide();
})