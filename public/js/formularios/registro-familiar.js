const inputCantidad = document.querySelector("#cantidad");
const inputNombre = document.querySelector("#nombreDocumento");
const fechaNacimiento = document.querySelector("#fechaDoc");
const btnEnviar = document.querySelector("#btn-enviar-solicitud");
const errorFechaNacimiento = document.querySelector("#error-fecha-nacimiento");
const formulario = document.querySelector("#registroForm");
const chkAutentica = document.querySelector('#autentica');
const totalCancelar = document.querySelector('#totalCancelar');
const btnPagar = document.querySelector('#btn-pago');
const nombres = document.querySelector('#nombres');
const apellidos = document.querySelector('#apellidos');
const mes = document.querySelector('#mes');
const anio = document.querySelector('#anio');
let precioDocumento = 0;
const formatoMes = {
    mask: '00'
}
const formatoAnio = {
    mask: '0000'
}

inputCantidad.addEventListener("keypress", soloNumeros);
nombres.addEventListener('keypress', soloLetras);
apellidos.addEventListener('keypress', soloLetras);
IMask(mes, formatoMes);
IMask(anio, formatoAnio);

// Material Select Initialization
$(document).ready(function () {
    var fecha = new Date();
    $(".datepicker").datepicker({
        format: "dd/mm/yyyy",
        formatSubmit: "dd/mm/yyyy",
        hiddenPrefix: "prefix__",
        hiddenSuffix: "__suffix",
        min: new Date(1926, 1, 1),
        max: new Date(fecha.getTime() - 24 * 60 * 60 * 1000),
    });
});

async function siguienteAtras(siguiente, atras) {
    if (siguiente == "#paso2") {
        var tramite = $("#tipoTramite");
        var cantidad = $("#cantidad");
        if (
            tramite.val() === null ||
            cantidad.val() === "" ||
            cantidad.val() == 0
        ) {
            $.alert({
                title: "Alerta",
                content: "Ingrese el tipo de trámite y la cantidad correcta",
                buttons: {
                    Aceptar: {
                        btnClass: "btn-danger",
                    },
                },
            });
        } else {
            const valor = $("#tipoTramite").val();
            switch (valor) {
                case "1":
                    $("#fechaDoc").attr("placeholder", "* Fecha de nacimiento");
                    break;
                case "2":
                    $("#fechaDoc").attr("placeholder", "* Fecha de matrimonio");
                    break;
                case "3":
                    $("#fechaDoc").attr("placeholder", "* Fecha de defunción");
                    break;
                case "4":
                    $("#fechaDoc").attr(
                        "placeholder",
                        "* Boleta de nacimiento"
                    );
                    break;
            }

            const data = await obtenerPrecioDocumento(valor);

            if (data) {
                precioDocumento = data.precio;
                $(siguiente).show(400);
                $(atras).hide(400);
            }

            if (!data) {
                $.alert({
                    title: "Error",
                    content: "Ha ocurrido un error inesperado",
                    buttons: {
                        Aceptar: {
                            btnClass: "btn-danger",
                        },
                    },
                });
            }
        }
    } else {
        $(siguiente).show(400);
        $(atras).hide(400);
    }
}

const obtenerPrecioDocumento = async (idSolicitud) => {
    try {
        const response = await fetch(route('documento.precio', [idSolicitud]), {
            headers: {
                'Content-Type': 'application/json',
            },
        });

        if (response.status === 200) {
            const data = await response.json();
            return data;
        }
        return false;
    } catch(error) {
        console.error(error);
        return false;
    }
}

const totalPagar = (precio, cantidad, autentica) => {
    if (autentica) precio += 2;
    return cantidad * precio;
}

const tarjetaVencida = (mes, anio) => {
    const fecha = new Date();
    const mesActual = fecha.getMonth() + 1;
    const anioActual = fecha.getFullYear();

    if (parseInt(anio) > anioActual) {
        return false;
    } else if (parseInt(anio) == anioActual) {
        if (parseInt(mes) >= mesActual) {
            return false;
        }
        return true;
    }
    return true;
}

// Validaciones de campos de formulario de pago
const validarFormularioPago = () => {
    const email = document.querySelector('#email');
    const telefono = document.querySelector('#telefono');
    const direccion = document.querySelector('#direccion');
    const divsErrores = document.querySelectorAll('.mi-error');
    let errores = 0;

    errores += campoRequerido(mes, divsErrores[1], 'Especifique mes de vencimiento');
    errores += campoRequerido(anio, divsErrores[2], 'Especifique año de vencimiento');
    errores += campoRequerido(nombres, divsErrores[3], 'Ingrese sus nombres');
    errores += campoRequerido(apellidos, divsErrores[4], 'Ingrese sus apellidos');
    errores += campoRequerido(email, divsErrores[5], 'Ingrese su correo electrónico');
    errores += campoRequerido(telefono, divsErrores[6], 'Ingrese su número de teléfono');
    errores += campoRequerido(direccion, direccion.nextElementSibling, 'Ingrese su dirección');

    if (tarjetaVencida(mes.value, anio.value)) {
        agregarError(mes, divsErrores[1], 'Error');
        agregarError(anio, divsErrores[2], 'Error');
        errores += 1;
    } else {
        limpiarError(mes, divsErrores[1]);
        limpiarError(anio, divsErrores[2]);
    }

    if (errores == 0) {
        alert('todo bien');
    } else {
        alert('Hay errores');
    }
}

btnEnviar.addEventListener("click", (e) => {
    e.preventDefault();
    let errores = 0;

    if (estaVacio(inputNombre.value)) {
        agregarError(
            inputNombre,
            inputNombre.nextElementSibling,
            "Ingrese el nombre en la partida o documento."
        );
        errores += 1;
    } else {
        limpiarError(inputNombre, inputNombre.nextElementSibling);
    }

    if (!fechaCorrecta(fechaNacimiento.value)) {
        errorFechaNacimiento.textContent =
            "Especifique la fecha de nacimiento.";
        errores += 1;
    } else {
        errorFechaNacimiento.textContent = "";
    }

    if (errores == 0) {
        const total = totalPagar(precioDocumento, inputCantidad.value, chkAutentica.checked);
        totalCancelar.textContent = `Total a pagar $${total.toFixed(2)}`;
        $('#modal-pago').modal('toggle');
        // $.confirm({
        //     title: 'Confirmar información',
        //     content: '¿Esta seguro/a que desea enviar la solicitud?',
        //     buttons: {
        //         si: {
        //             text: 'SÍ',
        //             btnClass: 'btn-success',
        //             keys: ['enter', 'shift'],
        //             action: function(){
        //                 formulario.submit();
        //             }
        //         },
        //         no: {
        //             text: 'NO',
        //             btnClass: 'btn-danger',
        //             keys: ['enter', 'shift'],
        //             action: function(){
        //                 $.alert({
        //                     title: 'Información',
        //                     content: 'No se envió su información',
        //                 });
        //             }
        //         }
        //     }
        // });
    }
});

btnPagar.addEventListener('click', validarFormularioPago);

