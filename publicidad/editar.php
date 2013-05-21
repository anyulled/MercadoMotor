<?php
// <editor-fold defaultstate="collapsed" desc="includes">
include_once ('../includes/db.php');
include_once ('../includes/class.krumo.php');
include_once ('../includes/constants.php');
include_once ('../includes/usuario.php');
include_once ('../includes/error.php');
include_once '../includes/publicidad.php';

$error = new error();
$db = new db();
$ad = new publicidad();
$usuario = new usuario();
$usuario->confirmar_miembro();
//// </editor-fold>


if (isset($_GET['id'])) {
    $registro = $db->dame_query("select * from publicaciones where idpublicaciones =" . $_GET['id']);
    $anuncio = $registro['data'][0];
}
// <editor-fold defaultstate="collapsed" desc="Select">
$tipospublicacion = $db->dame_query("select * from tipopublicacion");
//// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="Operaciones">
if (isset($_POST['enviar'])) {
    $data = $_POST;
    $data['images'] = $_FILES;
    $ad->actualizar($data);
    $errores = $error->error;
}
//// </editor-fold>
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <meta http-equiv="Content-language" content="en" />
        <title> Editar Anuncio :: mercadomotor.com.ve</title>
        <link href="../css/my_layout.css" rel="stylesheet" type="text/css" />
        <link href="../yaml/screen/forms.css" rel="stylesheet" type="text/css"/>
        <script src="../js/lib/jquery-1.3.js" type="text/javascript"></script>
        <script src="../js/lib/jquery.cycle.all.min.js" type="text/javascript"></script>
        <script type="text/javascript" src="../js/lib/jquery-validate/jquery.validate.min.js"></script>
        <script type="text/javascript" src="../js/lib/jquery-validate/localization/messages_es.js"></script>
        <script src="../js/index.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                $.validator.addMethod("alphanumeric", function(value, element) {
                    return this.optional(element) || /^[a-z0-9\-]+$/i.test(value);
                }, "Este campo debe tener solo letras numeros y guiones.");
                //                            $("#registrar").validate();
                $("#registrar").validate({
                    rules: {
                        placa:{
                            alphanumeric:true
                        },
                        foto1: {
                            required: true,
                            accept: "jpg|png"
                        },
                        foto2: {
                            accept: "jpg|png"
                        },
                        foto3: {
                            accept: "jpg|png"
                        },
                        foto4: {
                            accept: "jpg|png"
                        },
                        foto5: {
                            accept: "jpg|png"},
                        caracteristicas:{
                            maxlength: 500
                        }
                    }
                });
            });
        </script>
        <!--[if lte IE 7]>
        <link href="../css/patches/patch_my_layout.css" rel="stylesheet" type="text/css" />
        <![endif]-->
        <style media="all" type="text/css">
            #col2{width: 100%; padding: 0;}
            form.columnar div.type-text input[type="text"]{
                width: 66.8%;
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
            
            <div class="page">
                <div id="header">
                    <?php include_once '../templates/header.php'; ?>
                </div>
                <div id="nav">
                    <?php include_once '../templates/nav.php'; ?>
                    <div class="marcas">
                        <?php //include_once '../templates/marcas.php';  ?>
                    </div>
                </div>
                <div id="teaser">
                    <?php //include_once '../templates/teaser3.php';  ?>
                </div>
                <div id="main">
                    <div id="col1" class="hideme">
                        <div id="col1_content" class="clearfix">
                            <?php //include_once '../templates/fom1.php';   ?>
                        </div>
                    </div>
                    <div id="col2">
                        <div id="col2_content" class="clearfix">
                            <?php if (!isset($_POST['enviar']) | (isset($exito) && !$exito)): ?>
                                <form id="registrar" action="<? echo $_SERVER['PHP_SELF']; ?>" class="yform columnar" method="post" enctype="multipart/form-data">
                                    <input type="hidden" name="idpublicaciones" value="<?php echo $anuncio['idpublicaciones'] ?>"/>
                                    <input type="hidden" name="usuario_id" value="<?php echo $_SESSION['usuario']['idusuarios']; ?>"/>
                                    <?php
                                    if (isset($errores) && count($errores) > 0) {
                                        foreach ($errores as $error) {
                                            ?>
                                            <div class="error">
                                                <label>Error</label>
                                                <p class="message"> <?php echo $error; ?> </p>
                                            </div>
                                        <?php }
                                    } ?>
                                    <fieldset>
                                        <input type="hidden" name="usuario_id" value="<?php echo $_SESSION['usuario']['idusuarios']; ?>"/>
                                        <legend>Datos de la publicación</legend>
                                        <div class="subcolumns">
                                            <div class="c50l">
                                                <div class="type-text">
                                                    <label for="titulo">Titulo <sup>*</sup> </label>
                                                    <input type="text" name="titulo" class="required" value="<?php echo $anuncio['titulo']; ?>" />
                                                </div>
                                                <div class="type-text">
                                                    <label for="urlDestino">Url Destino <sup>*</sup> </label>
                                                    <input type="text" name="urlDestino" class="required" value="<?php echo $anuncio['urlDestino']; ?>"/>
                                                </div>
                                                <div class="type-text">
                                                    <label for="urlImagen">Url imagen <sup>*</sup> </label>
                                                    <input type="file" name="urlImagen"/>
                                                    <?php if($anuncio['urlImagen']!= '') :?>
                                                    <img src="<?php echo ROOT.IMAGES_ADS.$anuncio['urlImagen']; ?>" width="175" />
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <div class="c50r">
                                                <div class="type-select">
                                                    <label for="tipopublicacion">Tipo de anuncio <sup>*</sup> </label>
                                                    <select name="tipopublicacion" class="required">
                                                        <?php foreach ($tipospublicacion['data'] as $tipo): ?>
                                                            <option value="<?php echo $tipo['id'] ?>" <?php echo ($anuncio['tipopublicacion'] == $tipo['id']) ? " " : "selected"; ?>><?php echo $tipo['nombre'] ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                <div class="type-select">
                                                    <label for="status">Status</label>
                                                    <select name="status">
                                                        <option value="1" <?php echo ($anuncio['status'] == 1) ? " " : "selected='selected'"; ?>>Activo</option>
                                                        <option value="0" <?php echo ($anuncio['status'] == 0) ? " " : "selected='selected'"; ?>>Inactivo</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <fieldset>
                                        <legend>Acción</legend>
                                        <div class="type-button">
                                            <p align="right">
                                                <input type="reset" name="borrar" value="Resetear"/>
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
                                            <span>Registro editado con éxito.</span>
                                        </p>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <div class="floatbox">
                                <center>
                                    <img alt="volver" hspace="3" align="middle" src="../images/config.png"/>
                                    <a href="../usuarios">Volver al menú</a>
                                </center>
                            </div>
                        </div>
                    </div>
                    <div id="col3" class="hideme">
                        <div id="col3_content" class="clearfix">
                            <?php //include_once '../templates/ads.php';      ?>
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
                <!--<div id="border-bottom" class="hideme">
                <div id="edge-bl"></div>
                <div id="edge-br"></div>
              </div>-->
            </div>
        </div>
    </body>
</html>