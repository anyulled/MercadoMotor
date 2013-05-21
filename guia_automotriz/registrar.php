<?php
// <editor-fold defaultstate="collapsed" desc="includes">
include_once('../includes/db.php');
include_once('../includes/class.krumo.php');
include_once '../includes/constants.php';
include_once '../includes/usuario.php';
include_once '../includes/guia_automotriz.php';
$db = new db();
$usuario = new usuario();
$usuario->confirmar_miembro();
$guia = new guia_automotriz();
// </editor-fold>

$marcas = $db->select("*", "marcas");
$servicios = $db->dame_query("select * from servicio");

// <editor-fold defaultstate="collapsed" desc="Registrar guía">
if (isset($_POST['enviar'])) {
//    krumo::post();
//    krumo::dump($_FILES);
    $data = $_POST;
    unset($data['servicios']);
    unset($data['marcas']);
    unset($data['enviar']);
    $post_imagen = $_FILES;
    $post_servicios = $_POST['servicios'];
    $post_marcas = $_POST['marcas'];
    $exito = $guia->registrarGuia($data, $post_imagen, $post_servicios, $post_marcas);
}
// </editor-fold>
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <meta http-equiv="Content-language" content="en" />
        <title>Registrar Servicio :: mercadomotor.com.ve </title>
        <link href="../css/my_layout.css" rel="stylesheet" type="text/css" />
        <link href="../yaml/screen/forms.css" rel="stylesheet" type="text/css"/>
        <script src="../js/lib/jquery-1.3.js" type="text/javascript"></script>
        <script src="../js/lib/jquery.cycle.all.pack.js" type="text/javascript"></script>
        <script type="text/javascript" src="../js/lib/jquery-validate/jquery.validate.min.js"></script>
        <script type="text/javascript" src="../js/lib/jquery-validate/localization/messages_es.js"></script>
        <script src="../js/index.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                $.validator.addMethod("alphanumeric", function(value, element) {
                    return this.optional(element) || /^[a-z0-9\-]+$/i.test(value);
                }, "Este campo debe tener solo letras numeros y guiones.");
                //                            $("#registrar").validate();
                $("#registrar").validate({});
            });
        </script>
        <!--[if lte IE 7]>
        <link href="../css/patches/patch_my_layout.css" rel="stylesheet" type="text/css" />
        <![endif]-->
        <style media="all" type="text/css">
            #col2{width: 100%; padding: 0;}
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
                    <div class="marcas hideme">
                        <?php //include_once '../templates/marcas.php'; ?>
                    </div>
                </div>
                <div id="teaser" class="hideme">
                    <?php //include_once '../templates/teaser3.php'; ?>
                    </div>
                <div id="main">
                    <div id="col1" class="hideme">
                            <div id="col1_content" class="clearfix">
                            <?php //include_once '../templates/fom1.php'; ?>
                        </div>
                    </div>
                    <div id="col2">
                        <div id="col2_content" class="clearfix">
                            <?php if (!isset($_POST['enviar']) | (isset($exito) && !$exito)): ?>
                            <form enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="yform columnar" id="registrar" >
                                <fieldset>
                                    <input type="hidden" name="usuario_id" value="<?php echo $_SESSION['usuario']['idusuarios'] ?>"/>
                                    <legend>Datos de la Empresa</legend>
                                    <div class="subcolumns">
                                        <div class="c50l">
                                            <div class="type-text">
                                                <label for="nombre">Nombre<sup>*</sup></label>
                                                <input type="text" name="nombre" class="required"/>
                                            </div>
                                            <div class="type-text">
                                                <label for="email">Email</label>
                                                <input type="text" name="email"/>
                                            </div>
                                        </div>
                                        <div class="c50r">
                                            <div class="type-text">
                                                <label for="logoempresa">Logo de la Empresa<sup>*</sup> </label>
                                                <input type="file" name="logoempresa" class="required" />
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                                <fieldset>
                                    <legend>Productos y Servicios</legend>
                                    <div class="type-text">
                                        <label>Descripción<sup>*</sup> </label>
                                        <textarea name="descripcion" rows="3" cols="3" class="required" ></textarea>
                                    </div>
                                    <div>
                                        <a href="#" class="seleccionarTodos"> Seleccionar todos</a> |
                                        <a href="#" class="deseleccionarTodos"> Deseleccionar todos </a>
                                    </div>
                                    <div class="subcolumns">
                                        <?php if (count($servicios['data']) > 0): ?>
                                        <?php foreach ($servicios['data'] as $servicio): ?>
                                        <div class="c50l">
                                            <div class="type-check">
                                                <label for="servicios[]"><?php echo $servicio['servicio']; ?></label>
                                                <input type="checkbox" name="servicios[]" value="<?php echo $servicio['idservicio'] ?>"/>
                                            </div>
                                        </div>
                                        <?php endforeach; ?>
                                        <?php endif; ?>
                                    </div>
                                </fieldset>
                                <fieldset>
                                    <legend>Contacto</legend>
                                    <div class="type-text">
                                        <label>Información de contacto<sup>*</sup> </label>
                                        <textarea cols="3" rows="3" name="contacto" class="required" ></textarea>
                                    </div>
                                </fieldset>
                                <fieldset>
                                    <legend>Dirección</legend>
                                    <div class="subcolumns">
                                        <div class="c50l">
                                            <div class="type-select">
                                                <label for="estado">Estado<sup>*</sup> </label>
                                                <select name="estado_id" id="estado" class="required"></select>
                                            </div>
                                        </div>
                                        <div class="c50r">
                                            <div class="type-select">
                                                <label for="ciudad">Ciudad<sup>*</sup> </label>
                                                <select name="ciudad_id" id="ciudad" class="required"></select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="type-text">
                                                <label>Dirección <sup>*</sup> </label>
                                                <textarea name="direccion" rows="3" cols="3" class="required" ></textarea>
                                            </div>
                                </fieldset>
                                <fieldset>
                                    <legend>Marcas</legend>
                                    <div>
                                        <a href="#" class="seleccionarTodos"> Seleccionar todos</a> |
                                        <a href="#" class="deseleccionarTodos"> Deseleccionar todos </a>
                                    </div>
                                    <div class="subcolumns">            
                                        <div class="floatbox" id="marcas">
                                        <?php foreach ($marcas['data'] as $marca): ?>
                                            <div class="float_left">
                                                <label for="<?php echo $marca['nombre']; ?>">
                                                    <img height="20" src="<?php echo ROOT . IMAGES . LOGOS . $marca['urlImagen']; ?>" alt="<?php echo $marca['nombre']; ?>"/>
                                                </label>
                                                <input type="checkbox" name="marcas[]" value="<?php echo $marca['id']; ?>"/>
                                            </div>
                                        <?php endforeach; ?>
                                        </div>
                                    </div>
                                </fieldset>
                                <fieldset>
                                    <legend>Acción</legend>
                                    <div class="type-button">
                                        <p align="right">
                                            <input type="reset" name="reset" value="Reset"/>
                                            <input type="submit" name="enviar" value="Enviar"/>
                                        </p>
                                    </div>
                                </fieldset>
                            </form>
                            <?php else: ?>
                            <div class="floatbox">
                                <div class="note">
                                    <p class="message">
                                        <img alt="volver" hspace="3" align="middle" src="../images/info.png"/>
                                        <span>Registro agregado con éxito. Su local está a la espera de ser aprobado.</span>
                                    </p>
                                </div>
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
                    <div class="center">
                        <p class="center">mercadomotor.com.ve &copy; <?php echo date('Y'); ?></p>
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