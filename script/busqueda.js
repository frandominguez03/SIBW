function busqueda(valor) {
    $.ajax({
        data: {valor},
        url: 'busqueda.php',
        type: 'get',
        success: function(respuesta) {
            gestionarRespuesta(respuesta);
        }
    });
}

function gestionarRespuesta(respuesta) {
    var json = JSON.parse(respuesta);
    var contador = Object.keys(json).length;

    if(contador == 0) {
        $("resultadosBusqueda").html("");
        $("resultadosBusqueda").css('border', '0px');
        return;
    }
    
    var res = "";
    console.log(contador);
    for(i = 0; i < contador; ++i) {
        res += "<a href=\"/evento.php?ev=" + json[i]['id'] + "\">" + json[i]['nombre'] + "</a><br>";
    }
    
    $("#resultadosBusqueda").css("border", "1px solid #A5ACB2");
    $("#resultadosBusqueda").html(res);
}