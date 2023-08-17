const inputCantidad = document.querySelector("#cantidad");
const inputNombre = document.querySelector("#nombreDocumento");
const fechaNacimiento = document.querySelector("#fechaDoc");
const btnEnviar = document.querySelector("#btn-enviar-solicitud");
const errorFechaNacimiento = document.querySelector("#error-fecha-nacimiento");
const chkAutentica = document.querySelector('#autentica');
const totalCancelar = document.querySelector('#totalCancelar');
const btnPagar = document.querySelector('#btn-pago');
const nombres = document.querySelector('#nombres');
const apellidos = document.querySelector('#apellidos');
const mes = document.querySelector('#mes');
const anio = document.querySelector('#anio');
const selectRegiones = document.querySelector('#region');
const cp = document.querySelector('#cp');
const formPago = document.querySelector('#frm-pago');
let precioDocumento = 0;

inputCantidad.addEventListener("keypress", soloNumeros);
cp.addEventListener('keypress', soloNumeros);
nombres.addEventListener('keypress', soloLetras);
apellidos.addEventListener('keypress', soloLetras);

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

const peticion = async (url, tipo, encabezados, cuerpo) => {
    let opciones = {
        headers: encabezados,
        method: tipo
    }

    if (tipo == 'POST' && cuerpo !== null) {
        opciones.body = cuerpo;
    }

    try {
        const response = await fetch(url, opciones);
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

const obtenerPrecioDocumento = async (idSolicitud) => {
    const encabezados = {
        'Content-Type': 'application/json'
    }
    const data = await peticion(route('documento.precio', [idSolicitud]), 'GET', encabezados, null);
    if (data) {
        return data.precio;
    }
    return false;
}

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

            const precio = await obtenerPrecioDocumento(valor);

            if (precio) {
                precioDocumento = precio;
                $(siguiente).show(400);
                $(atras).hide(400);
            }

            if (!precio) {
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


const obtenerRegiones = async () => {
    const encabezados = {
        'Content-Type': 'application/json',
    }
    const regiones = await peticion(route('wompi.regiones'), 'GET', encabezados, null);
    if (regiones) {
        return regiones;
    }
    return false;
}

const crearOption = (valor, texto) => {
    const option = `<option value="${valor}">${texto}</option>`;
    return option;
}

// Validaciones de campos de formulario de pago
const validarFormularioPago = async (e) => {
    // Se evita el envío del formulario;
    e.preventDefault();

    const email = document.querySelector('#email');
    const telefono = document.querySelector('#telefono');
    const direccion = document.querySelector('#direccion');
    const ciudad = document.querySelector('#ciudad');
    const divsErrores = document.querySelectorAll('.mi-error');
    let errores = 0;

    errores += campoRequerido(nombres, divsErrores[3], 'Ingrese sus nombres');
    errores += campoRequerido(apellidos, divsErrores[4], 'Ingrese sus apellidos');
    errores += campoRequerido(email, divsErrores[5], 'Ingrese su correo electrónico');
    errores += campoEmail(email, divsErrores[5], 'Ingrese un correo electrónico válido');
    errores += campoRequerido(telefono, divsErrores[6], 'Ingrese su número de teléfono');
    errores += campoRequerido(ciudad, divsErrores[7], 'Especifique una ciudad');
    errores += campoRequerido(cp, cp.nextElementSibling, 'Ingrese el código postal');
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
        $.confirm({
            title: 'Confirmar información',
            content: '¿Está seguro/a que desea confirmar el pago de su solicitud?',
            buttons: {
                si: {
                    text: 'SÍ',
                    btnClass: 'btn-success',
                    keys: ['enter', 'shift'],
                    action: function(){
                        formPago.submit();
                    }
                },
                no: {
                    text: 'NO',
                    btnClass: 'btn-danger',
                    keys: ['enter', 'shift'],
                    action: function(){
                        $.alert({
                            title: 'Información',
                            content: 'Acción cancelada',
                        });
                    }
                }
            }
        });
    } 
}

btnEnviar.addEventListener("click", async (e) => {
    e.preventDefault();
    let errores = 0;

    errores += campoRequerido(inputNombre, inputNombre.nextElementSibling, "Ingrese el nombre en la partida o documento.");
   
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

        // Se mandan a llamar las regiones devueltas por el API Wompi solo si no se han cargado previamente
        // if (!selectRegiones.hasChildNodes()) {
            const regiones = await obtenerRegiones();
            if (regiones) {
                let options = '';
                regiones.forEach(region => {
                    region.territorios.forEach(territorio => {
                        const option = crearOption(`${region.id};${territorio.id}`, `${region.nombre} - ${territorio.nombre}`);
                        options += option;
                    }) 
                });
                selectRegiones.innerHTML = options;
            }

            if (!regiones) {
                $.alert({
                    title: "Error",
                    content: "Ha ocurrido un error al cargar el formulario de pago.",
                    buttons: {
                        Aceptar: {
                            btnClass: "btn-danger",
                        },
                    },
                });
            }
        // }

        $('#modal-pago').modal('toggle');
    }
});

formPago.addEventListener('submit', validarFormularioPago);

