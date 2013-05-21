<?php
// <editor-fold defaultstate="collapsed" desc="inicialización">
include_once('../includes/db.php');
include_once('../includes/class.krumo.php');
include_once '../includes/constants.php';


$db = new db();
$milocal = array();
$marcas = array();
// </editor-fold>

// <editor-fold defaultstate="collapsed" desc="Obteniendo Registro">
    $locales = array();
if (isset($_GET['id'])) {
    $locales = $db->dame_query("select * from local where idlocal =" . $_GET['id']);
    $marcas = $db->dame_query("select * from local_has_marcas inner join marcas on local_has_marcas.idmarca = marcas.id where idlocal = " . $_GET['id']);
        var_export($locales);
    if (isset($locales) && $locales['suceed'] && isset($locales['data'][0])) {
        $milocal = $locales['data'][0];
    }
}
// </editor-fold>

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <meta http-equiv="Content-language" content="en" />
        <title>ver Servicios :: mercadomotor.com.ve </title>
        <link rel="icon" HREF="<?php echo ROOT ?>favicon.ico"/>
        <link href="../css/my_layout.css" rel="stylesheet" type="text/css" />
        <link href="../yaml/screen/forms.css" rel="stylesheet" type="text/css"/>
        <link href="../fancybox/jquery.fancybox-1.3.1.css" rel="stylesheet" media="screen" type="text/css"/>
        <script type="text/javascript" src="../js/lib/jquery-1.4.2.min.js"></script>
        <script src="../js/lib/jquery.cycle.all.min.js" type="text/javascript"></script>
        <script src="../js/jcarousellite_1.0.1.min.js" type="text/javascript"></script>
        <script src="../fancybox/jquery.fancybox-1.3.1.pack.js" type="text/javascript"></script>
        <script src="../js/index.js" type="text/javascript"></script>
        <script src="../js/previewCarro.js" type="text/javascript" language="javascript"></script>
        <!--[if lte IE 7]>
        <link href="../css/patches/patch_my_layout.css" rel="stylesheet" type="text/css" />
        <![endif]-->
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
                    <div class="marcas">
                        <?php include_once '../templates/marcas.php'; ?>
                    </div>
                </div>
                <div id="teaser">
                    <?php include_once '../templates/teaser3.php'; ?>
                </div>
                <div id="main">
                    <div id="col1">
                        <div id="col1_content" class="clearfix">
                            <?php include_once '../templates/fom1.php'; ?>
                        </div>
                    </div>
                    <div id="col2">
                        <div id="col2_content" class="clearfix">
                            <?php if($locales['suceed'] && isset($milocal)&& count($milocal)>0): ?>
                            <div class="floatbox">
                                <h1 class="titulo"><span><?php echo ucfirst($milocal['nombre']); ?> </span><img class="float_right" src="<?php echo ROOT.IMAGES.LOCALES.$milocal['logoempresa'] ?>" alt="" height="32"/> </h1>
                                <div id="guia_automotriz">
                                    <div class="float_left">
aqui va la imagen
                                    </div>
                                    <div class="float_right">
                                        <ul>
                                            <li><a href=""><img src="" alt="<?php echo ucfirst($milocal['nombre']); ?>" /><?php echo ucfirst($milocal['nombre']); ?></a></li>
                                            <li><a href=""><img src="" alt="<?php echo ucfirst($milocal['nombre']); ?>" /><?php echo ucfirst($milocal['nombre']); ?></a></li>
                                            <li><a href=""><img src="" alt="<?php echo ucfirst($milocal['nombre']); ?>" /><?php echo ucfirst($milocal['nombre']); ?></a></li>
                                            <li><a href=""><img src="" alt="<?php echo ucfirst($milocal['nombre']); ?>" /><?php echo ucfirst($milocal['nombre']); ?></a></li>
                                        </ul>
                                    </div>
                                    <div class="floatbox info" style="clear:both;">
                                        <h2><?php echo ucfirst($milocal['nombre']); ?></h2>
                                        <p><?php echo ucfirst($milocal['descripcion']); ?></p>
                                    </div>
                                </div>
                                <h3 class="titulo">Nuestras Marcas</h3>
                                <div class="floatbox">
                                    <?php if(count($marcas['data'])): ?>
                                    <?php foreach ($marcas['data'] as $marca): ?>
                                    <div class="c25l">
                                        <img alt="<?php echo ucfirst($marca['nombre']); ?>"  src="<?php  echo ROOT.IMAGES.LOGOS.$marca['urlImagen']; ?>"/>
                                    </div>
                                    <?php endforeach; ?>
                                    <?php endif; ?>
                                </div>
                                <h3 class="titulo">Preguntas o comentarios</h3>
                                <div class="floatbox">
                                    <form class="yform">
                                        <fieldset>
                                            <legend>Ingrese sus datos para comunicarse con nosotros</legend>
                                            <div class="type-text">
                                                <input type="text" name="nombre" />
                                            </div>
                                            <div class="type-text">
                                                <textarea name="comentario" cols="3" rows="3"></textarea>
                                            </div>
                                            <div class="type-button">
                                                <input type="submit" value="Enviar" />
                                            </div>
                                        </fieldset>
                                    </form>
                                </div>
                            </div>
                            <?php else: ?>
                            <div class="floatbox">
                                <div class="error">
                                    <p>Baf... No se pudo conectar con la Base de datos. Intente de nuevo o comuníquese con el administrador.</p>
                                    <?php var_export($locales); ?>
                                    <?php var_dump($locales); ?>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div id="col3">
                        <div id="col3_content" class="clearfix">
                            <?php include_once '../templates/ads.php'; ?>
                        </div>
                        <!-- IE Column Clearing -->
                        <div id="ie_clearing"> &#160; </div>
                    </div>
                </div>
                <!-- begin: #footer -->
                <div id="footer">
                    <div class="center"><p class="center">mercadomotor.com.ve &copy; <?php echo date('Y') ;?></p>
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
