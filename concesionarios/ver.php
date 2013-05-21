<?php
// <editor-fold defaultstate="collapsed" desc="inicialización">
include_once('../includes/class.krumo.php');
include_once '../includes/constants.php';
include_once '../includes/Concesionario.php';
// </editor-fold>


// <editor-fold defaultstate="collapsed" desc="Datos concesionario">
$concesionario = new Concesionario();
$registro_concesionario = null;
$mi_concesionario=null;
if(isset($_GET['id'])){
    $registro_concesionario = $concesionario->ver($_GET['id']);
    $mi_concesionario = $registro_concesionario['data'][0];
}
//// </editor-fold>
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <meta http-equiv="Content-language" content="en" />
        <title>Ver Concesionario :: mercadomotor.com.ve </title>
        <link href="../css/my_layout.css" rel="stylesheet" type="text/css" />
        <link href="../yaml/screen/forms.css" rel="stylesheet" type="text/css"/>
        <link href="../fancybox/jquery.fancybox-1.3.1.css" rel="stylesheet" media="screen" type="text/css"/>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
        <script src="../js/jcarousellite_1.0.1.min.js" type="text/javascript "></script>
        <script src="../js/lib/jquery.cycle.all.min.js" type="text/javascript"></script>
        <script src="../fancybox/jquery.fancybox-1.3.1.pack.js" type="text/javascript"></script>
        <script src="../js/previewCarro.js" type="text/javascript"></script>
        <!--[if lte IE 7]>
        <link href="../css/patches/patch_my_layout.css" rel="stylesheet" type="text/css" />
        <![endif]-->
        <script src="../js/index.js" type="text/javascript"></script>
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
                            <?php krumo::dump($registro_concesionario); ?>
                            <?php if(sizeof($registro_concesionario['data'])>0):?>
                            <div class="floatbox">
                                <h1 class="titulo"><?php echo $mi_concesionario['nombre']; ?> </h1>
                                <div class="subcolumns">
                                    <?php foreach ($mi_concesionario['carros'] as $mi_carro) :?>
                                    <div class="c33l carro">
                                        <a class="fancybox" href="../carros/preview.php?id=<?php echo $mi_carro['idCarro']; ?>" title="<?php echo ucfirst($mi_carro['marca'])." ".ucfirst(strtolower($mi_carro['modelo']))." ".$mi_carro['anio']; ?>">
                                        <h5><?php echo ucfirst($mi_carro['marca'])." ".ucfirst(strtolower($mi_carro['modelo']))." ".$mi_carro['anio']; ?></h5>
                                        <img style="max-width: 100%;" src="<?php echo  ROOT . IMAGES . "carros/" . $mi_carro['imagen'] ?>" alt="Carro" />
                                        <p>Precio: <?php echo number_format($mi_carro['precioVehiculo'],0,',','.'); ?> Bsf.</p>
                                        </a>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <?php else: ?>
                            <div class="floatbox">
                                <div class="warning">
                                    <p class="message">
                                        <img src="<?php echo ROOT . IMAGES ?>error.png" alt="error" hspace="2" align="top"/>
                                        Hubo un error al conectar con la base de datos. Por favor intente de nuevo
                                    </p>
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
                    <div class="center"><p class="center">mercadomotor.com.ve &copy; <?php echo date('Y'); ?></p>
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