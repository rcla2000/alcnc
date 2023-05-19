$(document).ready(function () {
    const form = document.querySelector("#frm-denuncia");
    const inputNombre = document.querySelector("#name");
    const inputTelefono = document.querySelector("#phone");
    const inputMensaje = document.querySelector("#mensaje");
    const mascaraTelefono = {
        mask: "0000-0000",
    };

    IMask(inputTelefono, mascaraTelefono);
    // Material Select Initialization
    $(".mdb-select").materialSelect();

    inputNombre.addEventListener("keypress", soloLetras);
    inputTelefono.addEventListener("keypress", soloNumeros);

    var asunto = $("#tipoAsunto");
    asunto.change(function () {
        if (asunto.val() === "2") {
            $("#fecha").prop("disabled", false);
            $("#fechadiv").show();
        } else {
            $("#fecha").prop("disabled", true);
            $("#fechadiv").hide();
        }
    });

    form.addEventListener("submit", (e) => {
        e.preventDefault();
        let errores = 0;

        if (estaVacio(inputNombre.value)) {
            agregarError(
                inputNombre,
                inputNombre.nextElementSibling,
                "Ingrese su nombre."
            );
            errores += 1;
        } else {
            limpiarError(inputNombre, inputNombre.nextElementSibling);
        }

        if (estaVacio(inputTelefono.value)) {
            agregarError(
                inputTelefono,
                inputTelefono.nextElementSibling,
                "Ingrese su número de teléfono."
            );
            errores += 1;
        } else if (!telefonoSvCorrecto(inputTelefono.value)) {
            agregarError(
                inputTelefono,
                inputTelefono.nextElementSibling,
                "Ingrese un número de teléfono válido. Los números nacionales comienzan con el número 2,6 o 7."
            );
            errores += 1;
        } else {
            limpiarError(inputTelefono, inputTelefono.nextElementSibling);
        }

        if (estaVacio(inputMensaje.value)) {
            agregarError(
                inputMensaje,
                inputMensaje.nextElementSibling,
                "Ingrese el mensaje o asunto de su denuncia."
            );
            errores += 1;
        } else {
            limpiarError(inputMensaje, inputMensaje.nextElementSibling);
        }

        if (errores == 0) {
            $.confirm({
                title: "Confirmar información",
                content: "¿Esta seguro/a que desea enviar esta denuncia?",
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
                                content: "Envío de denuncia cancelado",
                            });
                        },
                    },
                },
            });
        }
    });
});
