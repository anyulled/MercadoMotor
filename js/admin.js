if(document.location.host=="mercadomotor.com.ve"){
    url ="http://"+document.location.host+  "/includes/Json.php";
}
else
{
    url ="http://"+document.location.host+  "/mercadomotor/includes/Json.php";
}
function llenarEstados(select){
    $.getJSON(url, {
        query: "estado"
    }, function(data){
        if(data && data.suceed){
            $(select + " option").remove();
            $("<option value=''> - Seleccione </option>").appendTo(select);
            for(var elemento in data.data){
                $("<option value='"+ data.data[elemento].idEstado + "'>"+ data.data[elemento].Estado +"</option>").appendTo(select);
            }
        }
    });
}
function llenarCiudades(idEstado, select){
    $.getJSON(url, {
        query: "ciudad",
        where:"Estado_idEstado",
        campo:idEstado
    }, function(data){
        if(data && data.suceed){
            $(select + " option").remove();
            $("<option value=''> - Seleccione </option>").appendTo(select);
            for(var elemento in data.data){
                $("<option value='"+ data.data[elemento].idciudad + "'>" + data.data[elemento].ciudad + "</option>").appendTo(select);
            }
        }
    });
}
function llenarMarcas(select){
    $.getJSON(url, {
        query: "marcas"
    }, function(data){
        if(data && data.suceed){
            $(select + " option").remove();
            $("<option value=''> - Seleccione</option>").appendTo(select);
            for(var elemento in data.data){
                $("<option value='"+ data.data[elemento].id + "'>"+ data.data[elemento].nombre +"</option>").appendTo(select);
            }
        }
    });
}
function llenarModelos(idMarca, select){
    $.getJSON(url, {
        query: "modelos",
        where:"idmarcas",
        campo:idMarca
    }, function(data){
        if(data && data.suceed){
            $(select + " option").remove();
            $("<option value=''> - Seleccione </option>").appendTo(select);
            for(var elemento in data.data){
                $("<option value='"+ data.data[elemento].idmodelos + "'>" + data.data[elemento].nombre + "</option>").appendTo(select);
            }
        }
    });
}

var active = true;
$(document).ready(function(){
    $("#estado").change(function(){
        llenarCiudades($(this).val(), "#ciudad")
    });
    $("#marcas").change(function(){
        llenarModelos($(this).val(), "#modelos")
    });
});