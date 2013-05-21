var active = true;
var url = "http://" + document.location.host + "/includes/Json.php";
function verificarDominio() {
    /* VERIFICACION DE DOMINIO */
    if (document.location.host === "mercadomotor.com.ve" || document.location.host === "www.mercadomotor.com.ve") {
        url = "http://" + document.location.host + "/includes/Json.php";
    }
    else
    {
        url = "http://" + document.location.host + "/MercadoMotor/includes/Json.php";
    }

}
function llenarEstados(select) {
    $(select + " option").remove();
    $("<option value=''> - Seleccione </option>").appendTo(select);
    $.getJSON(url, {
        query: "estado"
    }, function(data) {
        if (data.suceed) {
            for (var elemento in data.data) {
                if (typeof data.data[elemento] === "object") {
                    $("<option value='" + data.data[elemento].idEstado + "'>" + data.data[elemento].Estado + "</option>").appendTo(select);
                }
            }
        }
    });
}
function llenarCiudades(idEstado, select) {
    $(select + " option").remove();
    $("<option value=''> - Seleccione </option>").appendTo(select);
    $.getJSON(url, {
        query: "ciudad",
        where: "Estado_idEstado",
        campo: idEstado
    }, function(data) {
        if (data.suceed) {
            for (var elemento in data.data) {
                if (typeof data.data[elemento] === "object") {
                    $("<option value='" + data.data[elemento].idciudad + "'>" + data.data[elemento].ciudad + "</option>").appendTo(select);
                }
            }
        }
    });
}
function llenarMarcas(select) {
    $(select + " option").remove();
    $("<option value=''> - Seleccione</option>").appendTo(select);
    $.getJSON(url, {
        query: "marcas"
    }, function(data) {
        if (data.suceed) {
            for (var elemento in data.data) {
                if (typeof data.data[elemento] === "object") {
                    $("<option value='" + data.data[elemento].id + "'>" + data.data[elemento].nombre + "</option>").appendTo(select);
                }
            }
        }
    });
}
function llenarModelos(idMarca, select) {
    $(select + " option").remove();
    $("<option value=''> - Seleccione </option>").appendTo(select);
    $.getJSON(url, {
        query: "modelos",
        where: "idmarcas",
        campo: idMarca
    }, function(data) {
        if (data.suceed) {
            for (var elemento in data.data) {
                if (typeof data.data[elemento] === "object") {
                    $("<option value='" + data.data[elemento].idmodelos + "'>" + data.data[elemento].nombre + "</option>").appendTo(select);
                }
            }
        }
    });
}
function twitterCallback2(twitters) {
    var statusHTML = [];
    for (var i = 0; i < twitters.length; i++) {
        var username = twitters[i].user.screen_name;
        var status = twitters[i].text.replace(/((https?|s?ftp|ssh)\:\/\/[^"\s\<\>]*[^.,;'">\:\s\<\>\)\]\!])/g, function(url) {
            return '<a href="' + url + '">' + url + '</a>';
        }).replace(/\B@([_a-z0-9]+)/ig, function(reply) {
            return  reply.charAt(0) + '<a href="http://twitter.com/' + reply.substring(1) + '">' + reply.substring(1) + '</a>';
        });
        statusHTML.push('<li><span>' + status + '</span> <a style="font-size:85%" href="http://twitter.com/' + username + '/statuses/' + twitters[i].id_str + '">' + relative_time(twitters[i].created_at) + '</a></li>');
    }
    if (document.getElementById('twitter_update_list') !== null)
        document.getElementById('twitter_update_list').innerHTML = statusHTML.join('');
}
function relative_time(time_value) {
    var values = time_value.split(" ");
    time_value = values[1] + " " + values[2] + ", " + values[5] + " " + values[3];
    var parsed_date = Date.parse(time_value);
    var relative_to = (arguments.length > 1) ? arguments[1] : new Date();
    var delta = parseInt((relative_to.getTime() - parsed_date) / 1000);
    delta = delta + (relative_to.getTimezoneOffset() * 60);

    if (delta < 60) {
        return 'Hace menos de un minuto';
    } else if (delta < 120) {
        return 'hace un minuto';
    } else if (delta < (3600)) {
        return "Hace " + (parseInt(delta / 60)).toString() + ' minutos';
    } else if (delta < (7200)) {
        return 'Hace una hora';
    } else if (delta < (86400)) {
        return 'Hace ' + (parseInt(delta / 3600)).toString() + ' horas';
    } else if (delta < (172800)) {
        return 'Hace un día';
    } else {
        return "Hace " + (parseInt(delta / 86400)).toString() + ' días';
    }
}
function activar_desactivar() {
    $("a.seleccionarTodos").click(function() {
        $(this).parent("div").next("div.subcolumns").find("input:checkbox").attr("checked", true);
        return false;
    });
    $("a.deseleccionarTodos").click(function() {
        $(this).parent("div").next("div.subcolumns").find("input:checkbox").attr("checked", false);
        return false;
    });
}
function llenar_marcas_estados() {
    /* LLENAR ESTADOS Y MARCAS */
    llenarEstados("#estado");
    llenarMarcas("#marcas");
    $("#estado").change(function() {
        llenarCiudades($(this).val(), "#ciudad");
    });
    $("#marcas").change(function() {
        llenarModelos($(this).val(), "#modelos");
    });
}
function teaser_cycle() {
    /* TEASER */
    if ($("#cycle").length > 0) {
        $("#cycle").cycle({
            fx: 'scrollHorz',
            random: 1,
            delay: 5000,
            pauseOnPagerHover: true,
            randomizeEffects: true,
            timeout: 5000,
            pause: 1,
            pager: '.otrosmodelos ul',
            pagerClick: function(zeroBasedSlideIndex, slideElement) {
                $("#cycle .oferta .otrosmodelos ul li a").removeClass('activeSlide');
                $("#cycle .oferta .otrosmodelos ul li:eq(" + zeroBasedSlideIndex + ") a").addClass("activeSlide");
            },
            updateActivePagerLink: function(pager, currSlideIndex) {
                if (active) {
                    $("#cycle .oferta " + pager + " li a").removeClass('activeSlide');
                    $("#cycle .oferta .otrosmodelos ul li:eq(" + currSlideIndex + ") a").addClass("activeSlide");
                }
            },
            pagerAnchorBuilder: function(index, DOMelement) {
                return '<li><a>' + $(DOMelement).find("h1").text() + '</a></li>';
            }
        });
        $("#cycle .oferta .imagenes a:has(img)").click(function() {
            foto = $(this).find("img");
            target = $("#cycle .oferta:visible p img");
            target.fadeOut(function() {
                target.attr("src", foto.attr("src"));
                target.fadeIn();
            });
            return false;
        });

        $("#cycle .oferta").hover(function() {
            active = false;
        }, function() {
            active = true;
        });
    }
}
function noticias_cycle() {
    if ($("#col2_content .floatbox").length > 0) {
        $("#col2_content .floatbox").cycle({
            slideExpr: ".Noticia",
            height: 150,
            fx: 'scrollVert',
            speed: 500,
            timeout: 5000,
            pause: 1,
            pager: '#nav_news',
            pagerAnchorBuilder: function(index) {
                return "<a href=''>" + index + "</a>";
            }
        });
    }
}
function twitter() {
    //Twitter
    var twitterJsonUrl = "https://twitter.com/statuses/user_timeline/mercadomotor.json?callback=?";
    var parameters = {
        callback: "twitterCallback2",
        count: 10
    };
    $.ajax({
        url: twitterJsonUrl,
        dataType: 'jsonp',
        data: parameters,
        mimeType: "application/json",
        success: function(data) {
            twitterCallback2(data);
        },
        error: function(jqXHR, textStatus, errorThrown) {
            alert("Error: " + textStatus + errorThrown);
        }
    });
}
function carrousel() {
    /* CAROUSEL */
    if ($(".carousel").length > 0) {
        $(".carousel").jCarouselLite({
            btnNext: ".next",
            btnPrev: ".prev",
            visible: 9,
            scroll: 4
        });
    }
}
function eventosGlobales() {
    /* Configuración Global para peticiones ajax y envío de formularios*/
    $("body").ajaxStart(function() {
        setTimeout(function() {
            $.fancybox('<h3>Cargando...</h3>', {
                modal: true,
                centerOnScroll: true,
                transitionIn: 'none'
            });
        }, 500);
    });
    $("body").ajaxSuccess(function() {
        setTimeout(function() {
            $.fancybox.close();
        }, 500);
    });
    $("body").ajaxError(function() {
        setTimeout(function() {
            $.fancybox.close();
        }, 250);
    });
    $("form").bind("submit", function() {
        $.fancybox('<h4>Procesando, por favor espere...</h4>', {
            modal: true,
            centerOnScroll: true,
            transitionIn: 'none'
        });
        setTimeout(function() {
            $.fancybox.close();
        }, 250);
    });
}
function previewMarcas() {
    if ($("a#otras_marcas").length > 0) {
        $("a#otras_marcas").fancybox({
            type: 'iframe',
            modal: false,
            centerOnScroll: true,
            scrolling: 'no',
            autoScale: true
        });
    }
}
function tabs() {
    if ($("#tabs").length > 0) {
        $("#tabs").tabs();
    }
    if ($("#tabs-carros").length > 0) {
        $("#tabs-carros").tabs();
    }
    if ($(".tab").length > 0) {
        $(".tab").tabs();
    }
}
function imagenesnoticias() {
    if ($(".Noticia").length > 0) {
        $(".Noticia img").hide().load(function() {
            $(this).fadeIn('slow');
        });
    }
}
function validarFormulario() {
    if ($("#buscarCarro").length > 0) {
        $("#buscarCarro").validate({
            rules: {
                fecha_max: {
                    min: $("#fecha_min").val()
                },
                fecha_min: {
                    max: $("#fecha_max").val()
                }
            }
        });
    }
}
$(document).ready(function() {
    eventosGlobales();
    verificarDominio();
    llenar_marcas_estados();
    activar_desactivar();
    previewMarcas();
    tabs();
    imagenesnoticias();
    validarFormulario();
});
