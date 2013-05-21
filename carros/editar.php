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
$error = new error();
$db = new db();
$usuario = new usuario();
$auto = new Auto();
$usuario->confirmar_miembro();
// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="Operaciones">
if (isset($_POST['enviar'])) {
    $data = array();
    if ($_POST['enviar'] == 'Enviar') {
        $data['auto'] = $_POST;
        $data['images'] = $_FILES;
        $data['user'] = $_SESSION['usuario'];
        $exito = $auto->ingresarAuto($data);
    } elseif ($_POST['enviar'] == 'Editar') {
        $data['auto'] = $_POST;
        $data['user'] = $_SESSION['usuario'];
        $exito = $auto->actualizarAuto($data, $_FILES, $_POST['id']);
    }
    $errores = $error->error;
}
//// </editor-fold>
if (isset($_GET['id']) && $_GET['id'] != null) {
// <editor-fold defaultstate="collapsed" desc="Obtener registro">
    $query = "select * from carros where idCarro=" . $_GET['id'];
    $queryimagenes = "select * from imagenescarros where carro_id=" . $_GET['id'];
    $result = $db->dame_query($query);
    $resultImagenes = $db->dame_query($queryimagenes);
// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="Select">
    if (isset($result) && $result['suceed']) {
        $tipoVehiculo = $db->dame_query("Select * from tipovehiculo");
        $traccionVehiculo = $db->dame_query("SELECT * FROM  `traccionvehiculo` ");
        $transmisionVehiculo = $db->dame_query("select * from transmisionvehiculo");
        $direccionVehiculo = $db->dame_query("select * from direccionvehiculo");
        $marcas = $db->dame_query("select * from marcas order by nombre");
        $modelos = $db->dame_query("select * from modelos where idmarcas=" . $result['data'][0]['idMarca'] . " order by nombre");
        $coloresVehiculo = $db->dame_query("select * from colores order by nombre");
    }
// </editor-fold>
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <meta http-equiv="Content-language" content="en" />
        <title>Editar  Auto :: mercadomotor.com.ve </title>
        <link href="../css/my_layout.css" rel="stylesheet" type="text/css" />
        <link href="../yaml/screen/forms.css" rel="stylesheet" type="text/css"/>
        <script src="../js/lib/jquery-1.3.js" type="text/javascript"></script>
        <script src="../js/lib/jquery.cycle.all.min.js" type="text/javascript"></script>
        <script src="../js/admin.js" type="text/javascript"></script>
        <script type="text/javascript" src="../js/lib/jquery-validate/jquery.validate.min.js"></script>
        <script type="text/javascript" src="../js/lib/jquery-validate/localization/messages_es.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                $(".eliminar_foto").click(function(){
                    link = $(this);
                    if(confirm("Realmente desea borrar esta foto?")){
                        url = "../includes/Json.php";
                        data = new Object();
                        data.accion='eliminar_imagen';
                        data.idImagenesCarros= $(this).next("input[type='hidden']").val();
                        $.getJSON(url, data, function(data){
                            console.log(data);
                            if(data.suceed){
                                console.log('eliminando link');
                                link.parents("div:eq(0)").find('input[type="file"]').removeAttr("disabled");
                                link.parent("p").next("img").remove().end().remove();
                            }
                        })
                    }
                    return false;
                });
                $.validator.addMethod("alphanumeric", function(value, element) {
                    return this.optional(element) || /^[a-z0-9\-]+$/i.test(value);
                }, "Este campo debe tener solo letras numeros y guiones.");
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
                            <?php if (isset($result) && sizeof($result['data'])): ?>
                                <form id="registrar" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="yform columnar" method="post" enctype="multipart/form-data">
                                    <input name="id" type="hidden" value="<?php echo $result['data'][0]['idCarro']; ?>"/>
                                    <?php
                                    if (isset($errores) && count($errores) > 0) {
                                        foreach ($errores as $error) {
                                            ?>
                                            <div class="error">
                                                <label>Error</label>
                                                <p class="message"> <?php echo $error; ?> </p>
                                            </div>
                                            <?php
                                        }
                                    }
                                    ?>
                                    <fieldset>
                                        <legend>Datos del Vehículo</legend>
                                        <div class="subcolumns">
                                            <div class="c50l">
                                                <div class="type-select">
                                                    <label for="tipovehiculo">Tipo de vehículo <sup>*</sup> </label>
                                                    <select name="tipovehiculo" class="required">
                                                        <option value="">--</option>
                                                        <?php foreach ($tipoVehiculo['data'] as $tipo) : ?>
                                                            <option value="<?php echo $tipo['idtipovehiculo']; ?>" <?php echo ($tipo['idtipovehiculo'] == $result['data'][0]['tipoVehiculo']) ? " selected='selected' " : ""; ?>><?php echo $tipo['tipovehiculo']; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                <div class="type-select">
                                                    <label for="marca">Marca<sup>*</sup> </label>
                                                    <select name="marca" id="marcas" class="required">
                                                        <?php foreach ($marcas['data'] as $marca): ?>
                                                            <option value="<?php echo $marca['id'] ?>" <?php echo ($marca['id'] == $result['data'][0]['idMarca']) ? " selected='selected' " : ""; ?>> <?php echo $marca['nombre'] ?> </option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                <div class="type-select">
                                                    <label for="modelo">Modelo <sup>*</sup></label>
                                                    <select name="modelo" id="modelos" class="required">
                                                        <?php foreach ($modelos['data'] as $modelo): ?>
                                                            <option value="<?php echo $modelo['idmodelos'] ?>" <?php echo ($modelo['idmodelos'] == $result['data'][0]['idModelo']) ? " selected='selected' " : ""; ?>> <?php echo $modelo['nombre']; ?> </option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                <div class="type-select">
                                                    <label for="fecha">Año<sup>*</sup> </label>
                                                    <select name="fecha" class="required">
                                                        <option value="" class="number"> -- </option>
                                                        <?php for ($i = date("Y") + 1; $i >= date("Y") - 100; $i--): ?>
                                                            <option <?php echo ($i == $result['data'][0]['anio']) ? " selected='selected' " : ""; ?>><?php echo $i; ?> </option>
                                                        <?php endfor; ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="c50r">
                                                <div class="type-text">
                                                    <label for="recorrido">Recorrido (Km) <sup>*</sup> </label>
                                                    <input type="text" name="recorrido" class="required number" value="<?php echo $result['data'][0]['km'] ?>"/>
                                                </div>
                                                <div class="type-text">
                                                    <label for="version">Versión</label>
                                                    <input type="text" name="version" value="<?php echo $result['data'][0]['version']; ?>"/>
                                                </div>
                                                <div class="type-select">
                                                    <label for="color">Color</label>
                                                    <select name="color" class="required">
                                                        <option value="">-- Seleccione</option>
                                                        <?php foreach ($coloresVehiculo['data'] as $color) : ?>
                                                            <option value="<?php echo $color['id']; ?>" <?php echo ($color['id'] == $result['data'][0]['color']) ? " selected='selected' " : ""; ?>><?php echo $color['nombre'] ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                <div class="type-text">
                                                    <label for="placa">Placa </label>
                                                    <input type="text" name="placa"value="<?php echo $result['data'][0]['placa'] ?>"/>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <fieldset>
                                        <legend>Motor</legend>
                                        <div class="subolumns">
                                            <div class="c50l">
                                                <div class="type-text">
                                                    <label for="motor">Motor <sup>*</sup> </label>
                                                    <input type="text" name="motor"  class="required" value="<?php echo $result['data'][0]['motor']; ?>"/>
                                                </div>
                                                <div class="type-select">
                                                    <label for="transmision">Transmisión <sup>*</sup> </label>
                                                    <select name="transmision"  class="required">
                                                        <option value=""> -- </option>
                                                        <?php foreach ($transmisionVehiculo['data'] as $transmision) : ?>
                                                            <option value="<?php echo $transmision['idtransmisionvehiculo']; ?>" <?php echo ($transmision['idtransmisionvehiculo'] == $result['data'][0]['transmision']) ? " selected='selected' " : ""; ?>><?php echo $transmision['transmisionvehiculo']; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="c50r">
                                                <div class="type-text">
                                                    <label for="cilindros">N° Cilindros</label>
                                                    <input type="text" name="cilindros" class="number" value="<?php echo $result['data'][0]['cilindros']; ?>"/>
                                                </div>
                                                <div class="type-text">
                                                    <label for="traccion">Tracción</label>
                                                    <select name="traccion">
                                                        <option value="">--</option>
                                                        <?php foreach ($traccionVehiculo['data'] as $traccion) : ?>
                                                            <option value="<?php echo $traccion['idtraccionvehiculo']; ?>" <?php echo ($traccion['idtraccionvehiculo'] == $result['data'][0]['traccion']) ? " selected='selected' " : ""; ?>><?php echo $traccion['traccionvehiculo']; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <fieldset>
                                        <legend>Accesorios</legend>
                                        <div class="subcolumns">
                                            <div class="c50l">
                                                <div class="type-select">
                                                    <label for="vidrios">Vidrios</label>
                                                    <select name="vidrios">
                                                        <option value="">-- Seleccione</option>
                                                        <option value="0" <?php echo ($result['data'][0]['vidriosAhumados'] == 0) ? " selected='selected' " : ""; ?>>Ahumados</option>
                                                        <option value="1" <?php echo ($result['data'][0]['vidriosAhumados'] == 1) ? " selected='selected' " : ""; ?>>Normales</option>
                                                    </select>
                                                </div>
                                                <div class="type-select">
                                                    <label for="tapizado">Tapizado</label>
                                                    <select name="tapizado">
                                                        <option value="">-- Seleccione</option>
                                                        <option value="1"<?php echo ($result['data'][0]['tapizado'] == 0) ? " selected='selected' " : ""; ?>>Cuero</option>
                                                        <option value="0"<?php echo ($result['data'][0]['tapizado'] == 1) ? " selected='selected' " : ""; ?>>Tela</option>
                                                    </select>
                                                </div>
                                                <div class="type-select">
                                                    <label for="airbag">Airbag</label>
                                                    <select name="airbag">
                                                        <option value="">-- Seleccione</option>
                                                        <option value="1"<?php echo ($result['data'][0]['airbag'] == 0) ? " selected='selected' " : ""; ?>>SI</option>
                                                        <option value="0"<?php echo ($result['data'][0]['airbag'] == 0) ? " selected='selected' " : ""; ?>>NO</option>
                                                    </select>
                                                </div>
                                                <div class="type-select">
                                                    <label for="frenosabs">Frenos ABS</label>
                                                    <select name="frenosabs">
                                                        <option value="">-- Seleccione</option>
                                                        <option value="1"<?php echo ($result['data'][0]['frenosAbs'] == 0) ? " selected='selected' " : ""; ?>>SI</option>
                                                        <option value="0"<?php echo ($result['data'][0]['frenosAbs'] == 0) ? " selected='selected' " : ""; ?>>NO</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="c50r">
                                                <div class="type-select">
                                                    <label for="direccion">Dirección <sup>*</sup> </label>
                                                    <select name="direccion" class="required">
                                                        <option value="">--</option>
                                                        <?php foreach ($direccionVehiculo['data'] as $direccion) : ?>
                                                            <option value="<?php echo $direccion['iddireccionVehiculo']; ?>"<?php echo ($result['data'][0]['direccionVehiculo'] == $direccion['iddireccionVehiculo']) ? " selected='selected' " : ""; ?>><?php echo $direccion['direccionVehiculo']; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                <div class="type-select">
                                                    <label for="aireacondicionado">Aire Acondicionado</label>
                                                    <select name="aireacondicionado">
                                                        <option value="">-- Seleccione</option>
                                                        <option value="1"<?php echo ($result['data'][0]['aireAcondicionado'] == 0) ? " selected='selected' " : ""; ?>>SI</option>
                                                        <option value="0"<?php echo ($result['data'][0]['aireAcondicionado'] == 1) ? " selected='selected' " : ""; ?>>NO</option>
                                                    </select>
                                                </div>
                                                <div class="type-select">
                                                    <label for="estereo">Estereo </label>
                                                    <select name="estereo">
                                                        <option value="">-- Seleccione</option>
                                                        <option value="1"<?php echo ($result['data'][0]['estereo'] == 0) ? " selected='selected' " : ""; ?>>SI</option>
                                                        <option value="0"<?php echo ($result['data'][0]['estereo'] == 1) ? " selected='selected' " : ""; ?>>NO</option>
                                                    </select>
                                                </div>
                                                <div class="type-select">
                                                    <label for="blindado">Blindado</label>
                                                    <select name="blindado">
                                                        <option value="">-- Seleccione</option>
                                                        <option value="1" <?php echo ($result['data'][0]['blindado'] == 0) ? " selected='selected' " : ""; ?>>SI</option>
                                                        <option value="0" <?php echo ($result['data'][0]['blindado'] == 0) ? " selected='selected' " : ""; ?>>NO</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <fieldset>
                                        <legend>Otras caracteristicas</legend>
                                        <div class="type-text">
                                            <label for="caracteristicas">Características</label>
                                            <textarea cols="3" rows="3" name="caracteristicas"><?php echo $result['data'][0]['comentario']; ?></textarea>
                                        </div>
                                    </fieldset>
                                    <fieldset>
                                        <legend>Precio</legend>
                                        <div class="sucolumns">
                                            <div class="c50l">
                                                <div class="type-text">
                                                    <label for="precio">Precio<sup>*</sup> </label>
                                                    <input type="text" name="precio" class="required number" value="<?php echo $result['data'][0]['precioVehiculo'] ?>"/>
                                                </div>
                                                <div class="type-select">
                                                    <label for="vendido">Vendido</label>
                                                    <select name="vendido" class="required">
                                                        <option value="1" <?php echo ($result['data'][0]['vendido'] == 1) ? "selected='selected'" : ""; ?>>Si</option>
                                                        <option value="0" <?php echo ($result['data'][0]['vendido'] == 0) ? "selected='selected'" : ""; ?>>No</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="c50r">
                                                <div class="type-select">
                                                    <label for="negociable">Negociable <sup>*</sup> </label>
                                                    <select name="negociable" class="required">
                                                        <option value="">-- Seleccione</option>
                                                        <option value="1"<?php echo ($result['data'][0]['negociable'] == 0) ? " selected='selected' " : ""; ?>>SI</option>
                                                        <option value="0"<?php echo ($result['data'][0]['negociable'] == 1) ? " selected='selected' " : ""; ?>>NO</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <fieldset>
                                        <legend>Fotos</legend>
                                        <div class="type-text">
                                            <p>Imágenes cargadas</p>
                                            <?php for ($i = 0; $i < 5; $i++): ?>
                                                <div class="c50l">
                                                    <?php if (isset($resultImagenes['data'][$i]['urlImagen'])): ?>
                                                        <p>
                                                            <a href="#" class="eliminar_foto">Reemplazar foto</a>
                                                            <input type="hidden" name="idImagenesCarros" value="<?php echo $resultImagenes['data'][$i]['idImagenesCarros']; ?>"/>
                                                        </p>
                                                        <img alt="Foto <?php echo $i + 1; ?>"  src="<?php echo ROOT . IMAGES . "carros/" . $resultImagenes['data'][$i]['urlImagen']; ?>" hspace="5" width="150"/>
                                                    <?php endif; ?>
                                                    <label for="foto<?php echo $i + 1; ?>">Foto <?php echo ($i == 0) ? ' Principal' : $i + 1; ?> <?php echo ($i == 0) ? '<sup>*</sup>"' : ''; ?> </label>
                                                    <input type="file" name="foto<?php echo $i + 1; ?>" <?php echo ($i == 0) ? 'class="required"' : ''; ?> <?php echo (isset($resultImagenes['data'][$i]['urlImagen'])) ? 'disabled="true"' : ''; ?>/>
                                                </div>
                                            <?php endfor; ?>
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
                                    <div class="note">
                                        <p class="message">
                                            <img alt="volver" hspace="3" align="top" src="../images/info.png"/>
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
                            <?php //include_once '../templates/ads.php';         ?>
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