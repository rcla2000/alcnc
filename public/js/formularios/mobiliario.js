var hoy = new Date();
var tomorrow = new Date(hoy.getTime() + 24 * 60 * 60 * 1000);
var finMes = new Date(hoy.getFullYear(), hoy.getMonth() + 1, 0);

const form = document.querySelector('#frm-solicitar');
const lugar = document.querySelector('#lugar');
const errorFecha = document.querySelector('#error-fecha');
const cantidadMesas = document.querySelector('#cantMesas');
const cantidadSillas = document.querySelector('#cantSillas');
const cantidadCanopis = document.querySelector('#cantCanopis');
const tipoSolicitud = document.querySelector('#tipo-solicitud');

cantidadMesas.addEventListener('keypress', soloNumeros);
cantidadSillas.addEventListener('keypress', soloNumeros);
cantidadCanopis.addEventListener('keypress', soloNumeros);

form.addEventListener('submit', (e) => {
    e.preventDefault();
    let errores = 0;

    // Validamos el campo lugar solo si el tipo de solicitud es para lugar
    if (tipoSolicitud.value == 1) {
        if (estaVacio(lugar.value)) {
            agregarError(
                lugar,
                lugar.nextElementSibling,
                'Seleccione el lugar'
            );
            errores += 1;
        } else {
            limpiarError(lugar, lugar.nextElementSibling);
        }
    }

    if (estaVacio(document.querySelector('#fecha').value)) {
        errorFecha.textContent = 'Seleccione una fecha del calendario';
        errores += 1;
    } else {
        errorFecha.textContent = '';
    }

    if(estaVacio(cantidadMesas.value) && estaVacio(cantidadSillas.value) && estaVacio(cantidadCanopis.value)) {
        $.alert({
            title: "Error",
            content: "Especifique al menos un tipo de mobiliario y su cantidad (sillas, mesas, canopis)",
        });
        errores += 1;
    } else if (cantidadMesas.value == 0 && cantidadSillas.value == 0 && cantidadCanopis.value == 0) {
        $.alert({
            title: "Error",
            content: "La cantidad de mobiliario a solicitar debe ser mayor a cero",
        });
        errores += 1;
    }

    if (errores == 0) {
        $.confirm({
            title: "Confirmar información",
            content: "¿Esta seguro/a que desea enviar la solicitud de mobiliario?",
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
                            content: "Solicitud de mobiliario cancelada",
                        });
                    },
                },
            },
        });
    }

});

$(".datepicker").datepicker({
    min: tomorrow,
    max: finMes,
    formatSubmit: "yyyy/mm/dd",
});

function mostrarCampos(valor) {
    // Se obtiene el tipo de solicitud según el botón clickeado por el usuario 
    // para validar campos especeificos de ese tipo de solicitud
    tipoSolicitud.value = valor;
    $("#loader-carga").show();

    switch (valor) {
        case 1:
            $(".botones-iniciales").hide();
            setTimeout(() => {
                $(".campo-lugar").show();
                $(".campos-mobiliario").show();
                $(".botonera").show();
                $(".campo-fecha").show();
                $("#loader-carga").hide();
            }, "1000");
            break;
        case 2:
            $(".botones-iniciales").hide();
            setTimeout(() => {
                $(".campo-fecha").show();
                $(".campos-mobiliario").show();
                $(".botonera").show();
                $("#loader-carga").hide();
            }, "1000");
            break;
        case 3:
            $(".campo-lugar").hide();
            $(".campo-fecha").hide();
            $(".campos-mobiliario").hide();
            $(".botonera").hide();
            setTimeout(() => {
                $(".botones-iniciales").show();
                $("#sillas").prop("checked", false);
                $("#cantSillas").val("");
                $("#lugar").prop("selectedIndex", 0);
                $("#loader-carga").hide();
            }, "1000");
            break;

        default:
            break;
    }
}

function habilitarCampos(campo1, campo2) {
    if ($("#" + campo1).is(":checked")) {
        $("#" + campo2).prop("disabled", false);
    } else {
        $("#" + campo2).val("");
        $("#" + campo2).prop("disabled", true);
    }
}
