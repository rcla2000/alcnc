$(document).ready(function() {
    $('a[href*="#"]').click(function() {
        var destino = $(this.hash);
        if (destino.length == 0) {
            destino = $('a[name="' + this.hash.substr(1) + '"]');
        }
        if (destino.length == 0) {
            destino = $('html');
        }
        $('html, body').animate({
            scrollTop: destino.offset().top
        }, 500);
        return false;
    });

    new WOW().init();
});

$('.carousel').carousel()

const nombre = document.querySelector('#nombre');
const telefono = document.querySelector('#telefono');
const mensaje = document.querySelector('#mensaje');
const form = document.querySelector('#frm-mensaje');

form.addEventListener('submit', (e) => {
    e.preventDefault();
    let errores = 0;

    if (estaVacio(nombre.value)) {
        errores += 1;
        agregarError(
            nombre,
            nombre.nextElementSibling,
            'Ingrese su nombre completo'
        );
    } else {
        limpiarError(nombre, nombre.nextElementSibling);
    }

    if (estaVacio(telefono.value)) {
        errores += 1;
        agregarError(
            telefono,
            telefono.nextElementSibling,
            'Ingrese su número de teléfono'
        );
    } else {
        limpiarError(telefono, telefono.nextElementSibling);
    }

    if (estaVacio(mensaje.value)) {
        errores += 1;
        agregarError(
            mensaje,
            mensaje.nextElementSibling,
            'Ingrese el mensaje a enviar'
        );
    } else {
        limpiarError(mensaje, mensaje.nextElementSibling);
    }

    if (errores == 0) {
        $.confirm({
            title: 'Confirmar información',
            content: '¿Esta seguro/a que desea enviar su mensaje?',
            buttons: {
                si: {
                    text: 'SÍ',
                    btnClass: 'btn-success',
                    keys: ['enter', 'shift'],
                    action: function() {
                        form.submit();
                    }
                },
                no: {
                    text: 'NO',
                    btnClass: 'btn-danger',
                    keys: ['enter', 'shift'],
                    action: function() {
                        $.alert({
                            title: 'Información',
                            content: 'Operación cancelada',
                        });
                    }
                }
            }
        });
    }
});