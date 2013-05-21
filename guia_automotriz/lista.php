<?php
include_once('../includes/db.php');
include_once('../includes/class.krumo.php');
include_once '../includes/constants.php';
$db = new db();
$lista = $db->dame_query("select * from local");
// <editor-fold defaultstate="collapsed" desc="array">
//$lista = array(
//        0 => array(
//                version=>'sedan',
//                ciudad=>'Caracas',
//                precio=>'1000000',
//                nombre=>'fiesta',
//                marca=>'ford',
//                fecha=>'2006',
//                km=>'2000',
//                transmision=>'automática',
//                foto=>'1.jpg'
//        ),
//        1 => array(
//                version=>'sedan',
//                ciudad=>'Caracas',
//                precio=>'1000000',
//                nombre=>'fiesta',
//                marca=>'ford',
//                fecha=>'2006',
//                km=>'2000',
//                transmision=>'automática',
//                foto=>'1.jpg'
//        ),
//        2 => array(
//                version=>'sedan',
//                ciudad=>'Caracas',
//                precio=>'1000000',
//                nombre=>'fiesta',
//                marca=>'ford',
//                fecha=>'2006',
//                km=>'2000',
//                transmision=>'automática',
//                foto=>'1.jpg'
//        ),
//        3 => array(
//                version=>'sedan',
//                ciudad=>'Caracas',
//                precio=>'1000000',
//                nombre=>'fiesta',
//                marca=>'ford',
//                fecha=>'2006',
//                km=>'2000',
//                transmision=>'automática',
//                foto=>'1.jpg'
//        ),
//        4 => array(
//                version=>'sedan',
//                ciudad=>'Caracas',
//                precio=>'1000000',
//                nombre=>'fiesta',
//                marca=>'ford',
//                fecha=>'2006',
//                km=>'2000',
//                transmision=>'automática',
//                foto=>'1.jpg'
//        ),
//        5 => array(
//                version=>'sedan',
//                ciudad=>'Caracas',
//                precio=>'1000000',
//                nombre=>'fiesta',
//                marca=>'ford',
//                fecha=>'2006',
//                km=>'2000',
//                transmision=>'automática',
//                foto=>'1.jpg'
//        ),
//        5 => array(
//                version=>'sedan',
//                ciudad=>'Caracas',
//                precio=>'1000000',
//                nombre=>'fiesta',
//                marca=>'ford',
//                fecha=>'2006',
//                km=>'2000',
//                transmision=>'automática',
//                foto=>'1.jpg'
//        )
//);
// </editor-fold>
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <meta http-equiv="Content-language" content="en" />
        <title>Listado de servicios :: mercadomotor.com.ve </title>
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
                            <?php foreach ($lista as $auto) :?>
                            <div class="auto">
                                <img class="float_left" src="../images/<?php echo $auto['foto'] ?>" alt="auto"/>
                                <h3>Versión: <span><?php echo $auto['version']; ?></span></h3>
                                <p><?php echo $auto['ciudad']; ?></p>
                                <p><?php echo $auto['transmision']; ?> </p>
                                <p>Precio: <span><?php echo $auto['precio']; ?></span></p>
                                <p class="precio"><?php echo $auto['precio'] ?></p>
                                <img alt="info" src="" class="float_right" style="background: green;"/>
                            </div>
                            <?php endforeach;?>
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