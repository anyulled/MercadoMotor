<?php
// <editor-fold defaultstate="collapsed" desc="init">
include_once '../includes/constants.php';
include_once '../includes/class.krumo.php';
include_once '../includes/db.php';
$db = new db();
$registro = null;
$guia = null;
$servicios = null;
$marca = null;
$marcas = null;
// </editor-fold>

// <editor-fold defaultstate="collapsed" desc="Queries">
if (misc::comprobar_tipo($_GET['id'])) {
    if (isset($_GET['id'])) {
        $guia = $db->dame_query("select local.*, estado.Estado, ciudad.ciudad from `local` inner join estado on estado.idEstado = local.estado_id
inner join ciudad on ciudad.idciudad = local.ciudad_id where idlocal = " . $_GET['id']);
        $servicios = $db->dame_query("select servicio.servicio from local_has_servicio inner join  servicio on local_has_servicio.idservicio = servicio.idservicio where idlocal =" . $_GET['id']);
        $marcas = $db->dame_query("select marcas.nombre,marcas.urlImagen from local_has_marcas inner join marcas on marcas.id = local_has_marcas.idmarca where idlocal = " . $_GET['id']);
        if ($guia['suceed'] && count($guia['data']) > 0) {
            $registro = $guia['data'][0];
        }
    }
}
else{
    trigger_error("Query invalido");
    die("Error grave, comuniquese con el administrador del sistema");
}
// </editor-fold>
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="../css/my_layout.css" rel="stylesheet" type="text/css" />
        <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/themes/south-street/jquery-ui.css" rel="stylesheet" media="screen" type="text/css"/>
        <style type="text/css" media="all">
            .page_margins{
                max-height: 100%;
                max-width: 100%;
}
            .ui-accordion .ui-accordion-content{
                padding:0.3em;
            }
            .ui-state-default, .ui-widget-content .ui-state-default, .ui-widget-header .ui-state-default{
                background: #A1D815!important;
                background-image:-webkit-gradient(  linear, left bottom, left top,  color-stop(0, rgb(165,218,22)),  color-stop(0.5, rgb(148,211,19)),  color-stop(0.51, rgb(148,211,19)),  color-stop(1, rgb(156,217,54)));
                background-image:-moz-linear-gradient(center bottom,  rgb(165,218,22) 0%,  rgb(148,211,19) 50%,  rgb(148,211,19) 51%,  rgb(156,217,54) 100%);
                color:white!important;
                font-weight: bold;
            }
            .ui-state-default a, .ui-widget-content .ui-state-default a, .ui-widget-header .ui-state-default a{
                color:white!important;
            }
        </style>
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.0/jquery.min.js"></script>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.5/jquery-ui.min.js"></script>
        <script src="../js/lib/jquery.cycle.all.min.js" type="text/javascript"></script>
        <title>Ver Local <?php echo $registro['nombre'] ?> :: mercadomotor.com.ve </title>
        <script type="text/javascript" language="javascript">
            $(document).ready(function(){
                if($(".cycle").length > 0){
                    $(".cycle").cycle({
                        prev:"#prev",
                        next:"#next",
                        height:'400px',
                        random:false,
                        fit:'true',
                        containerResize:false,
                        pause:true
                    });
                }
                if($(".accordion").length > 0){
                    $(".accordion").accordion({autoHeight:false});
                }
                if(document.location.href!=top.location.href){
                    $("body").css({
                        "background-image":"none",
                        "background-color":"white"});
                }
            });
        </script>
    </head>
    <body>
        <div class="page_margins" style="border:none;padding: 0;margin:0; width:100%; height:50em; overflow:hidden;">
            <div class="page" style="margin: 0;padding: 0;">
                <div id="col2" class="mainCol">
                    <div id="col2_content" style="padding: 0;">
                        <?php if (count($guia['data']) > 0): ?>
                            <div class="floatbox">
                                <h2 class="titulo">
                                    <?php echo ucfirst(strtolower($registro['nombre'])); ?>
                                </h2>
                                    <img height="100" src="<?php echo ROOT . IMAGES . LOCALES . $registro['logoempresa'] ?>" alt="<?php echo $registro['nombre']; ?>"/>
                                <hr/>
                                <div class="accordion" style="clear: both;">
                                    <h3><a href="#">Productos y Servicios</a></h3>
                                    <div>
                                        <p><?php echo $registro['descripcion']; ?></p>
                                        <ul>
                                        <?php foreach ($servicios['data'] as $servicio): ?>
                                            <li><?php echo $servicio['servicio']; ?></li>
                                        <?php endforeach; ?>
                                        </ul>
                                    </div>
                                    <h3><a href="#">Ubícanos</a></h3>
                                    <div>
                                        <p><?php echo $registro['direccion'] ?></p>
                                        <p>&raquo; <b>Ciudad:</b> <span><?php echo $registro['ciudad'] ?></span> &raquo; <b>Estado:</b> <span><?php echo $registro['Estado'] ?></span> </p>
                                    </div>
                                    <h3><a href="#">Contáctanos</a></h3>
                                    <div>
                                        <p><?php echo $registro['contacto']; ?></p>
                                        <p><a href="mailto:<?php echo $registro['email']; ?>">Email</a></p>
                                    </div>
                                    <h3><a href="#">Nuestras Marcas</a></h3>
                                    <div>
                                    <?php foreach ($marcas['data'] as $marca): ?>
                                        <div class="float_left">
                                            <img align="middle" src="<?php echo ROOT . IMAGES . "logos marcas/" . $marca['urlImagen']; ?>" alt="<?php echo $marca['nombre']; ?>"/>
                                            <!--<span><b><?php echo ucfirst($marca['nombre']); ?></b></span>-->
                                        </div>
                                    <?php endforeach; ?>
                                    </div>
                                </div>
                                <div class="clearBoth">
                                    &nbsp;
                                </div>
                            </div>
                        <?php else: ?>
                            <div class="floatbox" style="width:800px; height:600px; overflow:hidden;">
                                <div class="note">
                                    <p class="message">
                                        <img src="<?php echo ROOT . IMAGES ?>error.png" alt="error" hspace="2" align="top"/>
                                        Hubo un error al conectar con la base de datos. Por favor intente de nuevo
                                    </p>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="floatbox" style="clear: both">&nbsp;</div>
            </div>
        </div>
    </body>
</html>