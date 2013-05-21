<?php
include_once('../includes/db.php');
include_once('../includes/class.krumo.php');
include_once '../includes/constants.php';

$db = new db();
$mis_ads = $db->dame_query("select publicaciones.*, usuarios.login as 'usuario' from publicaciones inner join usuarios on publicaciones.usuario_id = usuarios.idusuarios;");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <meta http-equiv="Content-language" content="en" />
        <title> indice de anuncios :: mercadomotor.com.ve</title>
        <link href="../css/my_layout.css" rel="stylesheet" type="text/css" />
        <link href="../yaml/screen/forms.css" rel="stylesheet" type="text/css"/>
        <script src="../js/lib/jquery-1.3.js" type="text/javascript"></script>
        <script src="../js/lib/jquery.cycle.all.min.js" type="text/javascript"></script>
        <script src="../js/index.js" type="text/javascript"></script>
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
                            <div class="floatbox">
                                <h1 class="titulo">Publicidad</h1>
                                <?php if (count($mis_ads['data']) > 0): ?>
                                <table class="full">
                                    <thead>
                                        <tr>
                                            <th> id</th>
                                            <th> Titulo</th>
                                            <th> Url Destino</th>
                                            <th> Url Destino</th>
                                            <th> Impresiones</th>
                                            <th> Clicks</th>
                                            <th> Usuario</th>
                                            <th> Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <?php endif; ?>
                                </div>
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
            
        </div>
    </body>
</html>