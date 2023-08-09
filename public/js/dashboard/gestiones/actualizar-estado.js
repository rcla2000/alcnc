const comentarios = document.querySelector('#comentarios');
const form = document.querySelector('#frm-solicitud');

form.addEventListener('submit', (e) => {
    e.preventDefault();
    let errores = 0;

    if (estaVacio(comentarios.value)) {
        agregarError(comentarios, comentarios.nextElementSibling, 'Ingrese un comentario');
        errores += 1;
    } else {
        limpiarError(comentarios, comentarios.nextElementSibling);
    }

    if (errores == 0) {
        $.confirm({
            title: 'Confirmar información',
            content: '¿Esta seguro/a que desea actualizar los datos de esta solicitud?',
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
                            content: 'Operación cancelada',
                        });
                    }
                }
            }
        });
    }
});
