<?php
// <editor-fold defaultstate="collapsed" desc="includes">
include_once('../includes/db.php');
include_once('../includes/class.krumo.php');
include_once '../includes/constants.php';
include_once '../includes/usuario.php'; 
// </editor-fold>

// <editor-fold defaultstate="collapsed" desc="init">
$db = new db();
$usuario = new usuario();


$usuario->confirmar_miembro();
if (isset($_GET['logout'])) {
    $usuario->log_Out();
}


$db = new db(); 
// </editor-fold>

// <editor-fold defaultstate="collapsed" desc="Query">
$query = "select
    idCarro,
    tipovehiculo.tipovehiculo as 'tipo',
    marcas.nombre as 'marca',
    modelos.nombre as 'modelo',
    carros.anio as 'fecha',
    imagenescarros.urlImagen as 'imagen',
    precioVehiculo as 'precio',
    negociable,
    concat(usuarios.nombre, '  ', usuarios.apellido) as 'usuario',
    carros.status, carros.vendido
    from carros
        inner join tipovehiculo on tipovehiculo.idtipovehiculo = carros.tipoVehiculo
        inner join modelos on modelos.idmodelos = carros.idModelo
        inner join marcas on marcas.id = carros.idMarca
        inner join imagenescarros on imagenescarros.carro_id = carros.idCarro and imagenescarros.tipoimagen_idtipoimagen = 1
        inner join usuarios on carros.usuario_id = usuarios.idusuarios";
// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="paginacion">
if (isset($_GET['numero_pagina'])) {
    $numero_pagina = $_GET['numero_pagina'];
}
if (!(isset($numero_pagina))) {
    $numero_pagina = 1;
}

$data = $db->dame_query($query);

$filas = $data['stats']['affected_rows'];

$filas_pagina = 20;

$ultimo = ceil($filas / $filas_pagina);

if ($numero_pagina < 1) {
    $numero_pagina = 1;
} elseif ($numero_pagina > $ultimo) {
    $numero_pagina = $ultimo;
}
If (isset($_GET['order'])) {
    $query.=" order by " . $_GET['order'];
    if (isset($_GET['dir'])) {
        $query.=" " . $_GET['dir'];
    }
}else{
    $query.=" order by idCarro Desc";
}
$max = ' limit ' . ($numero_pagina - 1) * $filas_pagina . ',' . $filas_pagina;

//// </editor-fold>

$carros = $db->dame_query($query . $max);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <meta http-equiv="Content-language" content="en" />
        <title>Administración de carros :: mercadomotor.com.ve </title>
        <link href="../css/my_layout.css" rel="stylesheet" type="text/css" />
        <link href="../yaml/screen/forms.css" rel="stylesheet" type="text/css"/>
        <link href="../fancybox/jquery.fancybox-1.3.1.css" rel="stylesheet" media="screen" type="text/css"/>
        <script src="../js/lib/jquery-1.4.2.min.js" type="text/javascript" ></script>
        <script src="../js/lib/jquery.cycle.all.min.js" type="text/javascript"></script>
        <script src="../fancybox/jquery.fancybox-1.3.1.pack.js" type="text/javascript"></script>
        <!--[if lte IE 7]>
        <link href="../css/patches/patch_my_layout.css" rel="stylesheet" type="text/css" />
        <![endif]-->
        <script src="../js/index.js" type="text/javascript"></script>
        <script type="text/javascript">
            if(document.location.host=="mercadomotor.com.ve" || document.location.host=="www.mercadomotor.com.ve"){
                url ="http://"+document.location.host+  "/includes/Json.php";
            }
            else
            {
                url ="http://"+document.location.host+  "/mercadomotor.com/includes/Json.php";
            }
            $(document).ready(function(){
                $(".need_confirmation").click(function(){
                    var fila = $(this);
                    txtStatus = fila.find("span").text();
                    imagen = fila.find("img");
                    if(txtStatus=="Inactivo"){
                        mensaje = "¿Desea activar este registro?";
                        urlImagen ="http://"+document.location.host + "/mercadomotor.com/images/save.png";
                    }else
                    {
                        mensaje = "¿Desea desactivar este registro?";
                        urlImagen ="http://"+document.location.host + "/mercadomotor.com/images/delete.png";
                    }
                    datos = {
                        accion:"update_status",
                        status:(txtStatus=="Activo") ? "0": "1",
                        id: parseInt($(this).closest("td").find("em").text())
                    };
                    if(confirm(mensaje)){
                        $.getJSON(url, datos, function(data){
                            if(data.suceed){
                                fila.closest("td").css({border:"1px solid red"});
                                fila.find("span").text((txtStatus=="Activo") ? "Inactivo": "Activo");
                                imagen.attr("src",urlImagen);
                                alert("Operación terminada con éxito.");
                            }
                            else{
                                alert("hubo un problema al cambiar el status el registro, por favor intente de nuevo.");
                            }
                        })
                    }
                    return false;
                });
                $(".status").click(function(){
                var fila = $(this);
                    txtStatus = $(this).text().trim();
                    if(txtStatus=="Si"){
                        mensaje = "¿Desea actualizar este carro como no Vendido?";
                    }else
                    {
                        mensaje = "¿Desea actualizar este carro como Vendido?";
                    }
                    datos = {
                        accion:"vendido",
                        status:(txtStatus=="Si") ? "0": "1",
                        id: parseInt($(fila).parent().next("td").find("em").text())
                    };
                    if(confirm(mensaje)){
                        $.getJSON(url, datos, function(data){
                            if(data.suceed){
                                //fila.closest("td").css({border:"1px solid red"});
                                //fila.find("span").text((txtStatus=="Activo") ? "Inactivo": "Activo");
                                //imagen.attr("src",urlImagen);
                                fila.text((txtStatus=="Si"?"No":"Si"));
                                alert("Operación terminada con éxito.");
                            }
                            else{
                                alert("hubo un problema al cambiar el status del registro, por favor intente de nuevo.");
                            }
                        })
                    }
                    return false;
                });
            });
        </script>
        <style media="screen" type="text/css">
            a.adminCarro{
                position:relative;
            }
            a.adminCarro img{
                position: absolute;
                left:30px;
                max-width: 150px;
                display: none;
                background: white;
                padding: 3px;
                border: 1px solid black;
            }
            a.adminCarro:hover img{
                display: block;
            }
        </style>
        <script type="text/javascript">

            var _gaq = _gaq || [];
            _gaq.push(['_setAccount', 'UA-571063-14']);
            _gaq.push(['_trackPageview']);

            (function() {
                var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
                ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
                var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
            })();

        </script>
    </head>
    <body>
        <div class="page_margins">
            <!--<div id="border-top" class="hideme">
            <div id="edge-tl"></div>
            <div id="edge-tr"></div>
          </div>-->
            <div class="page">
                <div id="header">
                    <?php include_once '../templates/header.php'; ?>
                </div>
                <div id="nav">
                    <?php include_once '../templates/nav.php'; ?>
                </div>
                <div class="marcas">
                    <?php //include_once '../templates/marcas.php'; ?>
                </div>
                <div id="teaser">
                    <?php //include_once '../templates/teaser3.php'; ?>
                </div>
                <div id="main">
                    <div id="col1" class="hideme">
                        <div id="col1_content" class="clearfix">
                            <?php //include_once '../templates/fom1.php';    ?>
                        </div>
                    </div>
                    <div id="col2" class="mainCol">
                        <div id="col2_content" class="clearfix">
                            <?php if (sizeof($carros) > 0): ?>
                                <table class="full">
                                    <caption>
                                        <a href="../usuarios">
                                            <img alt="volver" hspace="3" align="top" src="../images/config.png"/>
                                            Volver al menú</a>
                                        <div class="float_right">
                                            <?php
                                            if ($numero_pagina == 1) {
                                                
                                            } else {
                                                ?>
                                                <a href='<?php echo $_SERVER['PHP_SELF'] ?>?numero_pagina=1'>
                                                    <img src="../images/first.png" alt="Anterior" align="top" hspace="2"/>
                                                    Primero</a>
                                                <?php $anterior = $numero_pagina - 1; ?>
                                                <a href='<?php echo$_SERVER['PHP_SELF'] ?>?numero_pagina=<?php echo $anterior; ?>'>
                                                    <img src="../images/previous.png" alt="Anterior" align="top" hspace="2"/>
                                                    Anterior</a>
                                            <?php } ?>
                                            <span>Página <?php echo $numero_pagina; ?> de <?php echo $ultimo; ?></span>
                                            <?php
                                            if ($numero_pagina == $ultimo) {
                                                
                                            } else {
                                                ?>
                                                <?php $proximo = $numero_pagina + 1; ?>
                                                <a href='<?php echo $_SERVER['PHP_SELF']; ?>?numero_pagina=<?php echo $proximo; ?>'>
                                                    <img src="../images/next.png" alt="Siguiente" align="top" hspace="2"/>
                                                    Siguiente</a>
                                                <a href='<?php echo $_SERVER['PHP_SELF']; ?>?numero_pagina=<?php echo $ultimo; ?>'>
                                                    <img src="../images/last.png" alt="Último" align="top" hspace="2"/>
                                                    Último</a>
                                            <?php } ?>
                                        </div>
                                    </caption>
                                    <thead>
                                        <tr>
                                            <th> <a href="<?php echo $_SERVER['PHP_SELF']; ?>?order=1&dir=<?php echo(isset($_GET['dir']) && $_GET['dir'] == 'DESC') ? 'ASC' : "DESC"; ?>"> id <img alt="Ordenar"  src="<?php echo ROOT . IMAGES . "toggle.gif" ?>" hspace="2" align="top"/></a></th>
                                            <th> <a href="<?php echo $_SERVER['PHP_SELF']; ?>?order=2&dir=<?php echo(isset($_GET['dir']) && $_GET['dir'] == 'DESC') ? 'ASC' : "DESC"; ?>">Tipo <img alt="Ordenar"  src="<?php echo ROOT . IMAGES . "toggle.gif" ?>" hspace="2" align="top"/></a></th>
                                            <th> <a href="<?php echo $_SERVER['PHP_SELF']; ?>?order=3&dir=<?php echo(isset($_GET['dir']) && $_GET['dir'] == 'DESC') ? 'ASC' : "DESC"; ?>">Marca <img alt="Ordenar"  src="<?php echo ROOT . IMAGES . "toggle.gif" ?>" hspace="2" align="top"/></a></th>
                                            <th> <a href="<?php echo $_SERVER['PHP_SELF']; ?>?order=4&dir=<?php echo(isset($_GET['dir']) && $_GET['dir'] == 'DESC') ? 'ASC' : "DESC"; ?>">Modelo <img alt="Ordenar"  src="<?php echo ROOT . IMAGES . "toggle.gif" ?>" hspace="2" align="top"/></a></th>
                                            <th> <a href="<?php echo $_SERVER['PHP_SELF']; ?>?order=5&dir=<?php echo(isset($_GET['dir']) && $_GET['dir'] == 'DESC') ? 'ASC' : "DESC"; ?>">Año <img alt="Ordenar"  src="<?php echo ROOT . IMAGES . "toggle.gif" ?>" hspace="2" align="top"/></a></th>
                                            <th> <a href="<?php echo $_SERVER['PHP_SELF']; ?>?order=7&dir=<?php echo(isset($_GET['dir']) && $_GET['dir'] == 'DESC') ? 'ASC' : "DESC"; ?>">Precio <img alt="Ordenar"  src="<?php echo ROOT . IMAGES . "toggle.gif" ?>" hspace="2" align="top"/></a></th>
                                            <th> <a href="<?php echo $_SERVER['PHP_SELF']; ?>?order=8&dir=<?php echo(isset($_GET['dir']) && $_GET['dir'] == 'DESC') ? 'ASC' : "DESC"; ?>">Negociable<img alt="Ordenar"  src="<?php echo ROOT . IMAGES . "toggle.gif" ?>" hspace="2" align="top"/></a></th>
                                            <th> <a href="<?php echo $_SERVER['PHP_SELF']; ?>?order=9&dir=<?php echo(isset($_GET['dir']) && $_GET['dir'] == 'DESC') ? 'ASC' : "DESC"; ?>">Usuario<img alt="Ordenar"  src="<?php echo ROOT . IMAGES . "toggle.gif" ?>" hspace="2" align="top"/></a></th>
                                            <th> <a href="<?php echo $_SERVER['PHP_SELF']; ?>?order=10&dir=<?php echo(isset($_GET['dir']) && $_GET['dir'] == 'DESC') ? 'ASC' : "DESC"; ?>">Vendido<img alt="Ordenar"  src="<?php echo ROOT . IMAGES . "toggle.gif" ?>" hspace="2" align="top"/></a></th>
                                            <th> Status </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (sizeof($carros['data']) > 0): ?>
                                            <?php foreach ($carros['data'] as $carro): ?>
                                                <tr>
                                                    <td>
                                                        <a class="adminCarro" name="link<?php echo $carro['idCarro']; ?>" href="#link<?php echo $carro['idCarro']; ?>"> <?php echo $carro['idCarro']; ?>
                                                            <img src="<?php echo ROOT . IMAGES . "carros/" . $carro['imagen']; ?>" alt="mercadomotor.com"/>
                                                        </a>
                                                    </td>
                                                    <td> <?php echo $carro['tipo']; ?> </td>
                                                    <td> <?php echo $carro['marca']; ?> </td>
                                                    <td> <?php echo $carro['modelo']; ?> </td>
                                                    <td> <?php echo $carro['fecha']; ?> </td>
                                                    <td> <?php echo number_format($carro['precio'], 0, ',', '.'); ?> </td>
                                                    <td> <?php echo ($carro['negociable'] == 1) ? "Si" : "No"; ?> </td>
                                                    <td> <?php echo ucwords($carro['usuario']); ?> </td>
                                                    <td><a class="status" href="#"> <?php echo ($carro['vendido']==1)?"Si":"No"; ?></a> </td>
                                                    <td align="right">
                                                        <?php if ($carro['status'] == 0): ?>
                                                            <em class="hideme"><?php echo $carro['idCarro']; ?></em>
                                                            <a class="need_confirmation" href="<?php echo $_SERVER['PHP_SELF'] . "#link" . $carro['idCarro']; ?>">
                                                                <span>Inactivo</span>
                                                                <img alt="activo" src="<?php echo ROOT . IMAGES . "delete.png"; ?>" hspace="2"/>
                                                            </a>
                                                        <?php else: ?>
                                                            <em class="hideme"><?php echo $carro['idCarro']; ?></em>
                                                            <a class="need_confirmation" href="<?php echo $_SERVER['PHP_SELF'] . "#link" . $carro['idCarro']; ?>">
                                                                <span>Activo</span>
                                                                <img alt="inactivo" src="<?php echo ROOT . IMAGES . "save.png"; ?>" hspace="2"/>
                                                            </a>
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td><div class="note">
                                                        <p class="message" align="center">
                                                            <img src="../images/info.png" align="top" hspace="2" alt="info"/>
                                                            No hay resultados que mostrar</p>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="10">
                                                <div class="float_right">
                                                    <?php
                                                    if ($numero_pagina == 1) {
                                                        
                                                    } else {
                                                        ?>
                                                        <a href='<?php echo $_SERVER['PHP_SELF'] ?>?numero_pagina=1'>
                                                            <img src="../images/first.png" alt="Anterior" align="top" hspace="2"/>
                                                            Primero</a>
                                                        <?php $anterior = $numero_pagina - 1; ?>
                                                        <a href='<?php echo$_SERVER['PHP_SELF'] ?>?numero_pagina=<?php echo $anterior; ?>'>
                                                            <img src="../images/previous.png" alt="Anterior" align="top" hspace="2"/>
                                                            Anterior</a>
                                                    <?php } ?>
                                                    <span>Página <?php echo $numero_pagina; ?> de <?php echo $ultimo; ?></span>
                                                    <?php
                                                    if ($numero_pagina == $ultimo) {
                                                        
                                                    } else {
                                                        ?>
                                                        <?php $proximo = $numero_pagina + 1; ?>
                                                        <a href='<?php echo $_SERVER['PHP_SELF']; ?>?numero_pagina=<?php echo $proximo; ?>'>
                                                            <img src="../images/next.png" alt="Siguiente" align="top" hspace="2"/>
                                                            Siguiente</a>
                                                        <a href='<?php echo $_SERVER['PHP_SELF']; ?>?numero_pagina=<?php echo $ultimo; ?>'>
                                                            <img src="../images/last.png" alt="Último" align="top" hspace="2"/>
                                                            Último</a>
                                                    <?php } ?>
                                                </div>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                                <div class="floatbox">
                                    <center>
                                        <a href="../usuarios">
                                            <img alt="volver" hspace="3" align="top" src="../images/config.png"/>
                                            Volver al menú</a>
                                    </center>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div id="col3" class="hideme">
                        <div id="col3_content" class="clearfix">
                            <?php //include_once '../templates/ads.php'; ?>
                        </div>
                        <!-- IE Column Clearing -->
                        <div id="ie_clearing"> &#160; </div>
                    </div>
                </div>
                <!-- begin: #footer -->
                <div id="footer">
                    <div class="center"><p class="center">mercadomotor.com.ve &copy; <?php echo date('Y'); ?>
                        </p>
                    </div>
                </div>
            </div>
            <!--<div id="border-bottom" class="hideme">
            <div id="edge-bl"></div>
            <div id="edge-br"></div>
          </div>-->
        </div>
    </body>
</html>