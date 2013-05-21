<?php
// <editor-fold defaultstate="collapsed" desc="includes">
include_once ('../includes/db.php');
include_once ('../includes/class.krumo.php');
include_once ('../includes/constants.php');
include_once ('../includes/usuario.php');
include_once ('../includes/Auto.php');
include_once ('../includes/error.php');
// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="inicializacion">
ini_set("upload_max_filesize", "20M");
ini_set("post_max_size", "20M");
$error = new error();
$db = new db();
$usuario = new usuario();
$auto = new Auto();
$usuario->confirmar_miembro();
$exito = false;
$result = array();
// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="Operaciones">
if (isset($_POST['enviar']) && $_POST['enviar'] == 'Editar') {
    $data['usuario'] = $_POST;
    unset($data['usuario']['enviar']);
    $exito = $usuario->editarUsuario($data['usuario'], array('idusuarios' => $_POST['idusuarios']));
}
//// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="Obtener registro">
if (isset($_GET['id']) || isset($_SESSION['usuario']['idusuarios'])) {
    $id = intval((isset($_GET['id']) ? $_GET['id'] : $_SESSION['usuario']['idusuarios']));
    $query = "select * from usuarios where idusuarios=" . $id;
    $result = $db->dame_query($query);
}
// <editor-fold defaultstate="collapsed" desc="Select">
$tiposusuario = $db->dame_query("select * from tipousuario");
$estados = $db->dame_query("select * from estado");
if (isset($result['data']) && count($result['data']) > 0) {
    $ciudades = $db->dame_query("select * from ciudad where Estado_IdEstado=" . $result['data'][0]['Estado_idEstado']);
}
//// </editor-fold>
// </editor-fold>
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <meta http-equiv="Content-language" content="en" />
        <title>Editar Usuario :: mercadomotor.com.ve</title>
        <link href="../css/my_layout.css" rel="stylesheet" type="text/css" />
        <link href="../yaml/screen/forms.css" rel="stylesheet" type="text/css"/>
        <script src="../js/lib/jquery-1.3.js" type="text/javascript"></script>
        <script src="../js/lib/jquery.cycle.all.min.js" type="text/javascript"></script>
        <script src="../js/admin.js" type="text/javascript"></script>
        <script type="text/javascript" src="../js/lib/jquery-validate/jquery.validate.min.js"></script>
        <script type="text/javascript" src="../js/lib/jquery-validate/localization/messages_es.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                $.validator.addMethod("alphanumeric", function(value, element) {
                    return this.optional(element) || /^[a-z0-9\-]+$/i.test(value);
                }, "Este campo debe tener solo letras numeros y guiones.");
                $("#registrar").validate({
                    rules: {
                        nombre:{
                            alphanumeric:true
                        },
                        apellido: {
                            alphanumeric:true
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
                    <?php //include_once '../templates/teaser3.php'; ?>
                </div>
                <div id="main">
                    <div id="col1" class="hideme">
                        <div id="col1_content" class="clearfix">
                            <?php //include_once '../templates/fom1.php';   ?>
                        </div>
                    </div>
                    <div id="col2">
                        <div id="col2_content" class="clearfix">
                            <?php if ($exito): ?>
                                <div class="floatbox">
                                    <div class="note">
                                        <p class="message">
                                            <img alt="volver" hspace="3" align="top" src="../images/info.png"/>
                                            <span>Registro editado con éxito.</span>
                                        </p>
                                    </div>
                                </div>
                            <?php elseif (isset($result) && sizeof($result['data']) > 0): ?>
                                <form id="registrar" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="yform columnar" method="post" enctype="multipart/form-data">
                                    <input name="idusuarios" type="hidden" value="<?php echo $result['data'][0]['idusuarios']; ?>"/>
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
                                        <legend>Datos del Usuario</legend>
                                        <div class="subcolumns">
                                            <div class="c50l">
                                                <div class="type-text">
                                                    <label for="nombre">Nombre <sup>*</sup> </label>
                                                    <input type="text" class="required alphanumeric" name="nombre" value="<?php echo $result['data'][0]['nombre']; ?>"/>
                                                </div>
                                                <div class="type-text">
                                                    <label for="apellido"> Apellido <sup>*</sup></label>
                                                    <input type="text" class="required alphanumeric"  name="apellido" value="<?php echo $result['data'][0]['apellido']; ?>"/>
                                                </div>
                                                <div class="type-text">
                                                    <label for="login"> Login <sup>*</sup></label>
                                                    <input type="text" class="required alphanumeric" disabled="disabled" name="login" value="<?php echo $result['data'][0]['login']; ?>"/>
                                                </div>
                                                <div class="type-text">
                                                    <label for="password"> Password <sup>*</sup></label>
                                                    <input type="text" class="required"  name="password" value="<?php echo $result['data'][0]['password']; ?>"/>
                                                </div>
                                                <div class="type-text">
                                                    <label for="cedularif"> Cedula / Rif <sup>*</sup></label>
                                                    <input type="text" class="required number"  name="cedularif" value="<?php echo $result['data'][0]['cedularif']; ?>"/>
                                                </div>
                                                <div class="type-text">
                                                    <label for="direccion">Direccion</label>
                                                    <input type="text" name="direccion" value="<?php echo $result['data'][0]['direccion'] ?>"/>
                                                </div>
                                                <div class="type-text">
                                                    <label for="email">Email</label>
                                                    <input type="text" name="email" value="<?php echo $result['data'][0]['email'] ?>" class="required email"/>
                                                </div>
                                            </div>
                                            <div class="c50r">
                                                <div class="type-select">
                                                    <label for="estado">Estado <sup>*</sup> </label>
                                                    <select id="estado" name="Estado_idEstado" class="required" >
                                                        <?php foreach ($estados['data'] as $estado): ?>
                                                            <option value="<?php echo $estado['idEstado'] ?>" <?php echo ($estado['idEstado'] == $result['data'][0]['Estado_idEstado']) ? "selected='selected'" : ""; ?>  ><?php echo $estado['Estado']; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                <div class="type-select">
                                                    <label for="ciudad">Ciudad <sup>*</sup></label>
                                                    <select id="ciudad" name="ciudad_idciudad"  class="required" >
                                                        <?php foreach ($ciudades['data'] as $ciudad): ?>
                                                            <option value="<?php echo $ciudad['idciudad'] ?>" <?php echo ($ciudad['idciudad'] == $result['data'][0]['ciudad_idciudad']) ? "selected='selected'" : ""; ?>  ><?php echo $ciudad['ciudad']; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                <?php if ($_SESSION['usuario']['tipousuario'] == 1): ?>
                                                    <div class="type-select">
                                                        <label for="tipousuario">Tipo de Usuario</label>
                                                        <select name="tipousuario" class="required" <?php echo ($_SESSION['usuario']['tipousuario'] == 1) ? " disabled='true'" : ""; ?>>
                                                            <?php foreach ($tiposusuario['data'] as $tipousuario): ?>
                                                                <option value="<?php echo $tipousuario['id'] ?>" <?php echo ($tipousuario['id'] == $result['data'][0]['tipousuario']) ? "selected='selected'" : ""; ?>  ><?php echo $tipousuario['nombre'] ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                <?php endif; ?>
                                                <div class="type-select">
                                                    <label for="status">Status</label>
                                                    <select name="status" class="required" <?php echo ($_SESSION['usuario']['tipousuario'] == 1) ? " disabled='true'" : ""; ?>>
                                                        <option value="0" <?php echo ($result['data'][0]['status'] == 0) ? "selected='selected'" : ""; ?>>Inactivo</option>
                                                        <option value="1" <?php echo ($result['data'][0]['status'] == 1) ? "selected='selected'" : ""; ?>>Activo</option>
                                                    </select>
                                                </div>
                                                <div class="type-text">
                                                    <label for="telefono1"> Telefono<sup>*</sup></label>
                                                    <input type="text" class="required number"  name="telefono1" value="<?php echo $result['data'][0]['telefono1']; ?>"/>
                                                </div>
                                                <div class="type-text">
                                                    <label for="telefono2"> Telefono 2</label>
                                                    <input type="text" class="number" name="telefono2" value="<?php echo $result['data'][0]['telefono2']; ?>"/>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <fieldset>
                                        <legend>Acción</legend>
                                        <div class="type-button">
                                            <p align="right">
                                                <input type="reset" name="borrar" value="Resetear"/>
                                                <input type="submit" name="enviar" value="Editar"/>
                                            </p>
                                        </div>
                                    </fieldset>
                                </form>
                            <?php else: ?>                        
                                <div class="floatbox">
                                    <p class="info">No se pudo conectar con la base de datos, por favor intenta de nuevo o comunícate con el administrador del sistema</p>
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