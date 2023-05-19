const inputCantidad = document.querySelector("#cantidad");
const inputNombre = document.querySelector("#nombreDocumento");
const fechaNacimiento = document.querySelector("#fechaDoc");
const btnEnviar = document.querySelector("#btn-enviar-solicitud");
const errorFechaNacimiento = document.querySelector("#error-fecha-nacimiento");
const formulario = document.querySelector("#registroForm");

inputCantidad.addEventListener("keypress", soloNumeros);

formulario.addEventListener("submit", (e) => {
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
        $.confirm({
            title: 'Confirmar información',
            content: '¿Esta seguro/a que desea enviar la solicitud?',
            buttons: {
                si: {
                    text: 'SÍ',
                    btnClass: 'btn-success',
                    keys: ['enter', 'shift'],
                    action: function(){
                        formulario.submit();
                    }
                },
                no: {
                    text: 'NO',
                    btnClass: 'btn-danger',
                    keys: ['enter', 'shift'],
                    action: function(){
                        $.alert({
                            title: 'Información',
                            content: 'No se envió su información',
                        });
                    }
                }
            }
        });
    }
});

// Material Select Initialization
$(document).ready(function () {
    var fecha = new Date();
    $(".mdb-select").materialSelect();
    $(".datepicker").datepicker({
        format: "dd/mm/yyyy",
        formatSubmit: "dd/mm/yyyy",
        hiddenPrefix: "prefix__",
        hiddenSuffix: "__suffix",
        min: new Date(1926, 1, 1),
        max: new Date(fecha.getTime() - 24 * 60 * 60 * 1000),
    });
});

function siguienteAtras(siguiente, atras) {
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
                content: "Ingrese el tipo de tramite y la cantidad correcta",
                buttons: {
                    Aceptar: {
                        btnClass: "btn-danger",
                    },
                },
            });
        } else {
            valor = $("#tipoTramite").val();
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
            $(siguiente).show(400);
            $(atras).hide(400);
        }
    } else {
        $(siguiente).show(400);
        $(atras).hide(400);
    }
}
