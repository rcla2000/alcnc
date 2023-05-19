const solicitud = document.querySelector('#solicitud');
const form = document.querySelector('#frm-funerario');

form.addEventListener('submit', (e) => {
    e.preventDefault();
    let errores = 0;

    if (estaVacio(solicitud.value)) {
        agregarError(solicitud, solicitud.nextElementSibling, 'Ingrese los detalles de su solicitud.');
        errores += 1;
    } else {
        limpiarError(solicitud, solicitud.nextElementSibling);
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
                        form.submit();
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

