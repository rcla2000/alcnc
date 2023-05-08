var hoy =new Date();
var tomorrow = new Date( hoy.getTime() + 24*60*60*1000);
var finMes = new Date(hoy.getFullYear(), hoy.getMonth() + 1, 0)
$('.datepicker').datepicker({
        min:tomorrow,
        max: finMes,
        formatSubmit: 'yyyy/mm/dd'

});


function mostrarCampos(valor){
$('#loader-carga').show()

    

switch (valor) {
    case 1:
    $('.botones-iniciales').hide()
    setTimeout(() => {
        
         $('.campo-lugar').show()
         $('.campos-mobiliario').show()
         $('.botonera').show()
         $('.campo-fecha').show()
         $('#loader-carga').hide()
        }, '1000');
        break;
    case 2:
        $('.botones-iniciales').hide()
        setTimeout(() => {
            $('.campo-fecha').show()
            $('.campos-mobiliario').show()
            $('.botonera').show()
            $('#loader-carga').hide()
        }, '1000');
        break;
    case 3:
        $('.campo-lugar').hide()
        $('.campo-fecha').hide() 
        $('.campos-mobiliario').hide()
        $('.botonera').hide()
        setTimeout(() => {
            $('.botones-iniciales').show()
            $('#sillas').prop("checked", false);
            $('#cantSillas').val('');
            $('#lugar').prop('selectedIndex',0);
            $('#loader-carga').hide()
        }, '1000');
        break;

    default:
        break;
}

}
function habilitarCampos(campo1,campo2){
if ($('#'+campo1).is(':checked')) {
    $('#'+campo2).prop('disabled',false)
} else {
    $('#'+campo2).val('')
    $('#'+campo2).prop('disabled',true)
}
}