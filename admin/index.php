<?php
include_once('../includes/db.php');
include_once('../includes/class.krumo.php');
include_once '../includes/constants.php';
//include_once('../includes/fixture.php');

$db = new db();
$usuario = new usuario();
$usuario->confirmar_miembro();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <meta http-equiv="Content-language" content="en" />
        <title>Admin :: mercadomotor.com.ve </title>
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
                            <?php if (!isset($_SESSION)): ?>
                                <form method="post" action="" name="login" class="yform columnar">
                                    <input type="hidden" name="sesion" value="true"/>
                                    <fieldset>
                                        <legend>Iniciar Sesión Administrador</legend>
                                        <div class="type-text"><label for="usuario"></label><input type="text" name="usuario" /> </div>
                                        <div class="type-text"><label for="password"></label><input type="password" name="password" /> </div>
                                        <div class="type-button"><input type="submit" value="Iniciar Sesión"/> </div>
                                    </fieldset>
                                </form>
                            <?php endif; ?>
                            <?php if (isset($_SESSION)) : ?>
                                <p>Bienvenido, <?php echo $_SESSION['usuario']; ?></p>
                                <a href="adminUsuarios.php">Administrar usuarios</a>
                                <br/>
<?php else: ?>
                                <p>No ha iniciado sesión</p>
                            <?php endif; ?>
                            <a href="index.php?sesion=false">Cerrar sesión</a>
                        </div>
                    </div>
                    <div id="col3">
                        <div id="col3_content" class="clearfix">
<?php //include_once '../templates/ads.php';  ?>
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