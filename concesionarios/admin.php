<?php
include_once('../includes/db.php');
include_once('../includes/class.krumo.php');
include_once '../includes/constants.php';
include_once '../includes/usuario.php';

$db = new db();
$usuario = new usuario();

$usuario->confirmar_miembro();
if (isset($_GET['logout'])) {
    $usuario->log_Out();
}

$db = new db();

// <editor-fold defaultstate="collapsed" desc="Query">
$query = "select
    idconcesionarios,
    concesionarios.nombre,
    concesionarios.email,
    contacto,
    concesionarios.direccion,
    estado.Estado,
    ciudad.ciudad,
    usuarios.login,
    (select count(*) from concesionarios_has_carros where concesionarios_idconcesionarios = concesionarios.idconcesionarios) as 'carros'
    from concesionarios
        inner join estado on concesionarios.Estado_idEstado = estado.idEstado
        inner join ciudad on concesionarios.ciudad_idciudad = ciudad.idciudad
        inner join usuarios on concesionarios.usuario_id = usuarios.idusuarios";
if (isset($_SESSION['usuario']) && $_SESSION['usuario']['tipousuario']==1) {
    $query.="";
}
else{
    $query.=" where usuario_id=" . $_SESSION['usuario']['idusuarios'];
}
// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="paginacion">
if (isset($_GET['numero_pagina'])) {
    $numero_pagina = $_GET['numero_pagina'];
}
if (!(isset($numero_pagina))) {
    $numero_pagina = 1;
}

//Here we count the number of results
//Edit $data to be your query
$data = $db->dame_query($query);

$filas = $data['stats']['affected_rows'];

//This is the number of results displayed per page
$filas_pagina = 20;

//This tells us the page number of our last page
$ultimo = ceil($filas / $filas_pagina);

//this makes sure the page number isn't below one, or more than our maximum pages
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
}
//This sets the range to display in our query
$max = ' limit ' . ($numero_pagina - 1) * ($filas_pagina<0?0:$filas_pagina) . ',' . $filas_pagina;

//// </editor-fold>

$concesionarios = $db->dame_query($query . $max);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <meta http-equiv="Content-language" content="en" />
        <title>Administración de Concesionarios :: mercadomotor.com.ve </title>
        <link href="../css/my_layout.css" rel="stylesheet" type="text/css" />
        <link href="../yaml/screen/forms.css" rel="stylesheet" type="text/css"/>
        <link href="../fancybox/jquery.fancybox-1.3.1.css" rel="stylesheet" media="screen" type="text/css"/>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
        <script src="../js/lib/jquery.cycle.all.min.js" type="text/javascript"></script>
        <script src="../fancybox/jquery.fancybox-1.3.1.pack.js" type="text/javascript"></script>
        <script src="../js/index.js" type="text/javascript"></script>
        <!--[if lte IE 7]>
        <link href="../css/patches/patch_my_layout.css" rel="stylesheet" type="text/css" />
        <![endif]-->
        <script type="text/javascript">
            if(document.location.host=="aonewebdesign.com"){
                url ="http://"+document.location.host+  "/anyulled/mercadomotor.com/includes/Json.php";
            }
            else
            {
                url ="http://"+document.location.host+  "/mercadomotor.com/includes/Json.php";
            }
            $(document).ready(function(){
                $(".need_confirmation").click(function(){
                    var fila = $(this);
                    datos = {
                        accion:"delete",
                        id: parseInt($(this).closest("tr").find("td:first-child a").text())
                    };
                    if(confirm("¿Esta seguro de borrar este registro")){
                        $.getJSON(url, datos, function(data){
                            if(data.suceed){
                                fila.closest("tr").remove();
                                alert("registro eliminado con éxito.");
                            }
                            else{
                                alert("hubo un problema al eliminar el registro, por favor intente de nuevo.");
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
                            <?php if (sizeof($concesionarios) > 0): ?>
                                <table class="full">
                                    <caption>
                                        <a href="registrar.php">
                                            <img alt="Nuevo Registro" align="top" src="../images/add.png" /><span> Nuevo Registro </span> </a>
                                        <a href="../usuarios">
                                            <img alt="volver" hspace="3" align="top" src="../images/config.png"/>
                                            Volver al menú</a>
                                        <div class="float_right">
                                        <?php
                                        if ($numero_pagina == 1) {

                                        } else {
                                        ?>
                                            <a href='<?php echo $_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING'].(strlen($_SERVER['QUERY_STRING'])>0?"&":""); ?>numero_pagina=1'>
                                                <img src="../images/first.png" alt="Anterior" align="top" hspace="2"/>
                                                Primero</a>
                                        <?php $anterior = $numero_pagina - 1; ?>
                                            <a href='<?php echo $_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING'].(strlen($_SERVER['QUERY_STRING'])>0?"&":""); ?>numero_pagina=<?php echo $anterior; ?>'>
                                                <img src="../images/previous.png" alt="Anterior" align="top" hspace="2"/>
                                                Anterior</a>
                                        <?php } ?>
                                        <span>Página <?php echo $numero_pagina; ?> de <?php echo $ultimo; ?></span>
                                        <?php
                                        if ($numero_pagina == $ultimo) {

                                        } else {
                                        ?>
                                        <?php $proximo = $numero_pagina + 1; ?>
                                            <a href='<?php echo $_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING'].(strlen($_SERVER['QUERY_STRING'])>0?"&":""); ?>numero_pagina=<?php echo $proximo; ?>'>
                                                <img src="../images/next.png" alt="Siguiente" align="top" hspace="2"/>
                                                Siguiente</a>
                                            <a href='<?php echo $_SERVER['PHP_SELF']."?".(strlen($_SERVER['QUERY_STRING'])>0?"&".$_SERVER['QUERY_STRING']:""); ?>numero_pagina=<?php echo $ultimo; ?>'>
                                                <img src="../images/last.png" alt="Último" align="top" hspace="2"/>
                                                Último</a>
                                        <?php } ?>
                                    </div>
                                </caption>
                                <thead>
                                    <tr>
                                        <th> <a href="<?php echo $_SERVER['PHP_SELF']; ?>?order=1&dir=<?php echo(isset($_GET['dir']) && $_GET['dir'] == 'DESC') ? 'ASC' : "DESC"; ?>"> id <img alt="Ordenar"  src="<?php echo ROOT . IMAGES . "toggle.gif" ?>" hspace="2" align="top"/></a></th>
                                        <th> <a href="<?php echo $_SERVER['PHP_SELF']; ?>?order=2&dir=<?php echo(isset($_GET['dir']) && $_GET['dir'] == 'DESC') ? 'ASC' : "DESC"; ?>">Nombre <img alt="Ordenar"  src="<?php echo ROOT . IMAGES . "toggle.gif" ?>" hspace="2" align="top"/></a></th>
                                        <th> <a href="<?php echo $_SERVER['PHP_SELF']; ?>?order=4&dir=<?php echo(isset($_GET['dir']) && $_GET['dir'] == 'DESC') ? 'ASC' : "DESC"; ?>">Email <img alt="Ordenar"  src="<?php echo ROOT . IMAGES . "toggle.gif" ?>" hspace="2" align="top"/></a></th>
                                        <th> <a href="<?php echo $_SERVER['PHP_SELF']; ?>?order=5&dir=<?php echo(isset($_GET['dir']) && $_GET['dir'] == 'DESC') ? 'ASC' : "DESC"; ?>">Contacto <img alt="Ordenar"  src="<?php echo ROOT . IMAGES . "toggle.gif" ?>" hspace="2" align="top"/></a></th>
                                        <th> <a href="<?php echo $_SERVER['PHP_SELF']; ?>?order=6&dir=<?php echo(isset($_GET['dir']) && $_GET['dir'] == 'DESC') ? 'ASC' : "DESC"; ?>">Estado <img alt="Ordenar"  src="<?php echo ROOT . IMAGES . "toggle.gif" ?>" hspace="2" align="top"/></a></th>
                                        <th> <a href="<?php echo $_SERVER['PHP_SELF']; ?>?order=7&dir=<?php echo(isset($_GET['dir']) && $_GET['dir'] == 'DESC') ? 'ASC' : "DESC"; ?>">Ciudad <img alt="Ordenar"  src="<?php echo ROOT . IMAGES . "toggle.gif" ?>" hspace="2" align="top"/></a></th>
                                        <th> <a href="<?php echo $_SERVER['PHP_SELF']; ?>?order=8&dir=<?php echo(isset($_GET['dir']) && $_GET['dir'] == 'DESC') ? 'ASC' : "DESC"; ?>">Carros <img alt="Ordenar"  src="<?php echo ROOT . IMAGES . "toggle.gif" ?>" hspace="2" align="top"/></a></th>
                                        <th> <a href="<?php echo $_SERVER['PHP_SELF']; ?>?order=9&dir=<?php echo(isset($_GET['dir']) && $_GET['dir'] == 'DESC') ? 'ASC' : "DESC"; ?>">Usuario <img alt="Ordenar"  src="<?php echo ROOT . IMAGES . "toggle.gif" ?>" hspace="2" align="top"/></a></th>
                                        <th> Acción </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if ($concesionarios['suceed']==true && sizeof($concesionarios['data']) > 0): ?>
                                    <?php foreach ($concesionarios['data'] as $concesionario): ?>
                                                <tr>
                                                    <td>
                                                        <a class="adminCarro" name="link<?php echo $concesionario['idconcesionarios']; ?>" href="#link<?php echo $concesionario['idconcesionarios']; ?>"> <?php echo $concesionario['idconcesionarios']; ?></a>
                                                    </td>
                                                    <td> <?php echo $concesionario['nombre']; ?> </td>
                                                    <td> <?php echo $concesionario['email']; ?> </td>
                                                    <td> <?php echo $concesionario['contacto']; ?> </td>
                                                    <td> <?php echo $concesionario['Estado']; ?> </td>
                                                    <td> <?php echo $concesionario['ciudad']; ?> </td>
                                                    <td> <?php echo $concesionario['carros']; ?> </td>
                                                    <td> <?php echo $concesionario['login']; ?> </td>
                                                    <td align="right">
                                                        <a href="editar.php?id=<?php echo $concesionario['idconcesionarios']; ?>"><img alt="Editar" align="absmiddle" src="../images/edit.png" /><span> Editar </span> </a>
                                                        <a href="#" class="need_confirmation"><img alt="Eliminar" align="absmiddle" src="../images/delete.png" /><span> Eliminar </span> </a>
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
                                                        <td colspan="9">
                                                            <a href="registrar.php"><img alt="Nuevo Registro" align="top" src="../images/add.png" /><span> Nuevo Registro </span> </a>
                                                            <div class="float_right">
                                                <?php
                                                    if ($numero_pagina == 1) {

                                                    } else {
                                                ?>
                                                        <a href='<?php echo $_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING'].(strlen($_SERVER['QUERY_STRING'])>0?"&":""); ?>numero_pagina=1'>
                                                            <img src="../images/first.png" alt="Anterior" align="top" hspace="2"/>
                                                            Primero</a>
                                                <?php $anterior = $numero_pagina - 1; ?>
                                                        <a href='<?php echo $_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING'].(strlen($_SERVER['QUERY_STRING'])>0?"&":""); ?>numero_pagina=<?php echo $anterior; ?>'>
                                                            <img src="../images/previous.png" alt="Anterior" align="top" hspace="2"/>
                                                            Anterior</a>
                                                <?php } ?>
                                                    <span>Página <?php echo $numero_pagina; ?> de <?php echo $ultimo; ?></span>
                                                <?php
                                                    if ($numero_pagina == $ultimo) {

                                                    } else {
                                                ?>
                                                <?php $proximo = $numero_pagina + 1; ?>
                                                    <a href='<?php echo $_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING'].(strlen($_SERVER['QUERY_STRING'])>0?"&":""); ?>numero_pagina=<?php echo $proximo; ?>'>
                                                            <img src="../images/next.png" alt="Siguiente" align="top" hspace="2"/>
                                                            Siguiente</a>
                                                    <a href='<?php echo $_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING'].(strlen($_SERVER['QUERY_STRING'])>0?"&":""); ?>numero_pagina=<?php echo $ultimo; ?>'>
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
                                            <div class="center"><p class="center">mercadomotor.com &copy; <?php echo date('Y'); ?>
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