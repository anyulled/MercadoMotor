<?php
// <editor-fold defaultstate="collapsed" desc="includes">
include_once '../includes/db.php';
include '../includes/class.krumo.php';
include_once '../includes/constants.php';
include_once '../includes/usuario.php';
include_once '../includes/Concesionario.php';
// </editor-fold>

$db = new db();
$usuario = new usuario();
$usuario->confirmar_miembro();
$concesionarios_usuario=null;
// <editor-fold defaultstate="collapsed" desc="Registrar Concesionario">
if (isset($_POST['enviar'])) {
    $conc = new Concesionario();
    $data = array("concesionario" => $_POST, "carros" => $_POST['carros'], "imagen" => $_FILES);
    unset($data['concesionario']['carros'], $data['concesionario']['enviar']);
//    krumo::dump($data);
    try {
        $resultado = false;
        $resultado = $conc->registrar($data);
//        krumo::dump($resultado);
    } catch (Exception $exc) {
        echo "<code>" . $exc->getTraceAsString() . "</code>";
        die("Error insertando el registro");
    }

}
// </editor-fold>

// <editor-fold defaultstate="collapsed" desc="Query Carros del usuario">
$concesionarios_usuario = $db->dame_query("select idCarro as id, modelos.nombre as modelo, marcas.nombre as marca, imagenescarros.urlImagen from carros
inner join modelos on carros.idModelo = modelos.idmodelos
inner join marcas on carros.idmarca = marcas.id
inner join imagenescarros on imagenescarros.carro_id = carros.idCarro and tipoimagen_idtipoimagen =1
where usuario_id=" . $_SESSION['usuario']['idusuarios']);
// </editor-fold>

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <meta http-equiv="Content-language" content="en" />
        <title>Registrar Concesionario :: mercadomotor.com.ve </title>
        <link href="../css/my_layout.css" rel="stylesheet" type="text/css" />
        <link href="../yaml/screen/forms.css" rel="stylesheet" type="text/css"/>
        <script src="../js/lib/jquery-1.3.js" type="text/javascript"></script>
        <script type="text/javascript" src="../js/lib/jquery-validate/jquery.validate.min.js"></script>
        <script type="text/javascript" src="../js/lib/jquery-validate/localization/messages_es.js"></script>
        <script src="../js/lib/jquery.cycle.all.pack.js" type="text/javascript"></script>
        <script src="../js/index.js" type="text/javascript"></script>
        <!--[if lte IE 7]>
                <link href="../css/patches/patch_my_layout.css" rel="stylesheet" type="text/css" />
                <![endif]-->
        <style media="all" type="text/css">
            #nav{
                height: 40px;
}
            #col2 {
                width: 100%;
                padding: 0;
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
        <script type="text/javascript">
            $(document).ready(function(){
                $.validator.addMethod("alphanumeric", function(value, element) {
                    return this.optional(element) || /^[a-z0-9\-]+$/i.test(value);
                }, "Este campo debe tener solo letras numeros y guiones.");
                //                            $("#registrar").validate();
                $("#registrar").validate({});
            });
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
                        <?php include_once '../templates/marcas.php'; ?>
                    </div>
                </div>
                <div id="teaser" class="hideme">
                    <?php include_once '../templates/teaser3.php'; ?>
                </div>
                <div id="main">
                    <div id="col1" class="hideme">
                        <div id="col1_content" class="clearfix">
                            <?php //include_once '../templates/fom1.php'; ?>
                        </div>
                    </div>
                    <div id="col2">
                        <div id="col2_content" class="clearfix">
                            <div class="floatbox">
                            <?php if(isset($_POST['enviar']) && $resultado):?>
                                <div class="info">
                                    <p>Registro Agregado con éxito</p>
                                </div>
                                <center><a href="/usuarios/">Volver al menú</a> </center>
                            <?php  else :?>
                            <form id="registrar" action="registrar.php" method="post" class="yform columnar" method="post" enctype="multipart/form-data">
                                <fieldset>
                                    <legend>Datos de la Empresa</legend>
                                    <div class="subcolumns">
                                        <div class="c50l">
                                            <div class="type-select">
                                                <label for="nombre">Nombre <sup>*</sup> </label>
                                                <input type="text" name="nombre" class="required alphanumeric"/>
                                            </div>
                                            <div class="type-select">
                                                <label for="email">Email</label>
                                                <input type="text" name="email" class="required email"/>
                                            </div>
                                        </div>
                                        <div class="c50r">
                                            <div class="type-select">
                                                <label for="logoEmpresa">Logo de la Empresa<sup>*</sup> </label>
                                                <input type="file" name="logoEmpresa" class="required" />
                                            </div>
                                            <div class="floatbox">
                                                <p>Si coloca un email podrá recibir y responder preguntas que le sean realizadas sobre los servicios que ofrece</p>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                                <fieldset>
                                    <legend>Productos y Servicios</legend>
                                    <div class="type-text full">
                                        <label for="productos_y_servicios">Puede realizar una descripcion completa de los productos que ofrece la empresa a publicar</label>
                                        <textarea name="productos_y_servicios" cols="3" rows="3" class="required"></textarea>
                                    </div>
                                </fieldset>
                                <fieldset>
                                    <legend>Contáctanos</legend>
                                    <div class="type-text full">
                                        <label for="contacto">Puede anotar toda la información que dispone para que los visitantes se puedan poner en contacto con la empresa como teléfono, email, etc.</label>
                                        <textarea class="required" name="contacto" cols="3" rows="3" id="DescripcionContacto"></textarea>
                                    </div>
                                </fieldset>
                                <fieldset>
                                    <legend>Dirección </legend>
                                    <div class="subcolumns">
                                        <div class="c50l">
                                            <div class="type-select">
                                                <label for="Estado_idEstado">Estado <sup>*</sup> </label>
                                                <select id="estado" name="Estado_idEstado" class="required">
                                                </select>
                                            </div>
                                        </div>
                                        <div class="c50r">
                                            <div class="type-select">
                                                <label for="ciudad_idciudad">Ciudad <sup>*</sup></label>
                                                <select id="ciudad" name="ciudad_idciudad" class="required">
                                                </select>
                                            </div>
                                        </div>
                                        <div class="type-text full" style="clear:both;">
                                            <label for="direccion">Dirección <sup>*</sup></label>
                                            <textarea cols="3" rows="3"  name="direccion" class="required"></textarea>
                                        </div>
                                    </div>
                                </fieldset>
                                <fieldset>
                                    <legend>Agregar Vehículos</legend>
                                    <div class="floatbox">
                                        <?php if(count($concesionarios_usuario['data'])>0) :?>
                                        <div>
                                            <a href="#nogo" class="seleccionarTodos"> Seleccionar todos</a> |
                                            <a href="#nogo" class="deseleccionarTodos"> Deseleccionar todos </a>
                                        </div>
                                        <div class="subcolumns">
                                            <?php foreach($concesionarios_usuario['data'] as $carro): ?>
                                            <div class="c25l">
                                                <img src="<?php echo ROOT.IMAGES.CARROS.$carro['urlImagen']; ?>" alt="<?php echo $carro['modelo']." ".$carro['marca'] ?>" width="100%" style="max-width:95% ;max-height: 138px;"/>
                                                <label for="carros[]">
                                                <input name="carros[]" type="checkbox" value="<?php echo $carro['id']; ?>"/>
                                                <?php echo $carro['modelo']." ".$carro['marca'] ?>
                                                </label>
                                            </div>
                                            <?php endforeach;?>
                                            </div>
                                        <?php else:?>
                                        <p>No tiene autos registrados en el sistema.</p>
                                        <?php endif;?>
                                    </div>
                                    <div class="type-button">
                                        <p align="right">
                                            <input type="reset" name="vistaprevia" value="Borrar"/>
                                            <input type="submit" name="enviar" value="Enviar"/>
                                        </p>
                                    </div>
                                </fieldset>
                            </form>
                            <?php endif; ?>
                            </div>
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
                        <p class="center">mercadomotor.com.ve &copy; <?php echo date('Y') ;?></p>
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