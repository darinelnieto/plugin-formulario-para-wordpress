if($("[type=radio]").prop("checked") == false ){
    $('#botonConUno').attr("disabled",true);
    $('#botonDestinoDos').attr("disabled",true);
    $('#botonDestinoTres').attr("disabled",true);
    $('#botonDestinoCuatro').attr("disabled",true);
    $('#envia').attr("disabled",true);
}
$("input[name=paisDestino]").click(function(){
$('#botonConUno').attr("disabled",false).css({'filter':'none', 'cursor': 'pointer'});
});

$("input[name=estudio]").click(function(){
$('#botonDestinoDos').attr("disabled",false).css({'filter':'none', 'cursor': 'pointer'});
});
$("input[name=fechaViaje]").click(function(){
    $('#botonDestinoTres').attr("disabled",false).css({'filter':'none', 'cursor': 'pointer'});
    });
$("input[name=edad]").focus(function(){
    $('#botonDestinoCuatro').attr("disabled",false).css({'filter':'none', 'cursor': 'pointer'});
    });
$("input[name=politicas]").click(function(){
    $('#envia').attr("disabled",false).css({'filter':'none', 'cursor': 'pointer'});
    });
$("input[name=politicas]").click(function(){
    $('#htmlProgreso').css({'width':'100%', 'transition':'3s'});
    $('.porcentaje').replaceWith('<p style="color:white" class="porcentaje">100%</p>');
});

$('#botonConUno').click(function(){
$('#interesEstudio').css({ 'display':'block', 'transition': '1s' });
$('#paisDestino').css({ 'display':'none', 'transition': '1s' });
   $('#htmlProgreso').css({'width':'20%', 'transition':'3s'});
   $('.porcentaje').replaceWith('<p style="color:white" class="porcentaje">20%</p>');
});
$('#botonAtrasUno').click(function(){
$('#interesEstudio').css({ 'display':'none', 'transition': '1s' });
$('#paisDestino').css({ 'display':'block', 'transition': '1s' });
});
$('#botonDestinoDos').click(function(){
$('#interesEstudio').css({ 'display':'none', 'transition': '1s' });
$('#fechaViaje').css({ 'display':'block', 'transition': '1s' });
$('#htmlProgreso').css({'width':'40%', 'transition':'3s'});
$('.porcentaje').replaceWith('<div style="color:white" class="porcentaje">40%</div>');
});
$('#botonAtrasDos').click(function(){
$('#interesEstudio').css({ 'display':'block', 'transition': '1s' });
$('#fechaViaje').css({ 'display':'none', 'transition': '1s' });
});
$('#botonDestinoTres').click(function(){
$('#datosPersonales').css({ 'display':'block', 'transition': '1s' });
$('#fechaViaje').css({ 'display':'none', 'transition': '1s' });
$('#htmlProgreso').css({'width':'60%', 'transition':'3s'});
$('.porcentaje').replaceWith('<p style="color:white" class="porcentaje">60%</p>');
});
$('#botonAtrasTres').click(function(){
$('#datosPersonales').css({ 'display':'none', 'transition': '1s' });
$('#fechaViaje').css({ 'display':'block', 'transition': '1s' });
});
$('#botonDestinoCuatro').click(function(){
$('#datosPersonales').css({ 'display':'none', 'transition': '1s' });
$('#ubicacion').css({ 'display':'block', 'transition': '1s' });
$('#htmlProgreso').css({'width':'80%', 'transition':'3s'});
$('.porcentaje').replaceWith('<p style="color:white" class="porcentaje">80%</p>');
});
$('#botonAtrasCuatro').click(function(){
$('#datosPersonales').css({ 'display':'block', 'transition': '1s' });
$('#ubicacion').css({ 'display':'none', 'transition': '1s' });
});