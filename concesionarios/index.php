<?php
// <editor-fold defaultstate="collapsed" desc="inicializacion">
include_once('../includes/db.php');
include_once('../includes/class.krumo.php');
include_once '../includes/constants.php';
include_once '../includes/paginacion.php';
$db = new db();
$concesionarios = new paginacion();
$concesionarios->paginar("select * from concesionarios
    inner join estado on Estado_idEstado = estado.idEstado
    inner join ciudad on ciudad_idciudad = ciudad.idciudad");
//</editor-fold>
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <meta http-equiv="Content-language" content="en" />
        <title>Índice de Concesionarios :: mercadomotor.com.ve </title>
        <link rel="icon" HREF="<?php echo ROOT ?>favicon.ico"/>
        <link href="../yaml/screen/forms.css" rel="stylesheet" type="text/css"/>
        <link href="../fancybox/jquery.fancybox-1.3.1.css" rel="stylesheet" media="screen" type="text/css"/>
        <link href="../css/jquery-ui-1.8.16.custom.css" rel="stylesheet" media="screen" type="text/css"/>
        <link href="../css/my_layout.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="../js/lib/jquery-1.4.2.min.js"></script>
        <script type="text/javascript" src="../js/jquery-ui-1.8.16.custom.min.js"></script>
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
                    <div id="col2">
                        <div id="col2_content" class="clearfix">
                            <div class="floatbox">
                                <?php include_once '../templates/buscar_carro.php'; ?>
                            </div>
                            <img src="<?php echo ROOT . IMAGES; ?>construccion.jpg" width="100%"/>
                            <?php /* ?>
                              <div class="floatbox">
                              <h1 class="titulo">Concesionarios</h1>
                              <div class="floatbox">
                              <?php if(count($concesionarios->registros)>0): ?>
                              <?php foreach ($concesionarios->registros as $concesionario):?>
                              <div class="c33l">
                              <img src="<?php echo IMAGES.CONCESIONARIOS.$concesionario['logo'];?>" class="float_right" alt="logo"/>
                              <p><a href="ver.php?id=<?php echo $concesionario['idconcesionarios']; ?>"><?php echo $concesionario['nombre'];  ?></a></p>
                              <p><?php echo $concesionario['ciudad'];  ?>, Estado <?php echo $concesionario['Estado'];  ?></p>
                              </div>
                              <?php endforeach; ?>
                              <?php else: ?>
                              <p class="info">No se encontraron registros</p>
                              <?php endif;?>
                              </div>
                              <div class="floatbox">
                              <?php $concesionarios->mostrar_paginado(); ?>
                              </div>
                              </div>
                              <?php */ ?>
                        </div>
                    </div>


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