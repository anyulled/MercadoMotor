<?php
include_once('../includes/db.php');
include_once('../includes/class.krumo.php');
include_once '../includes/constants.php';

// <editor-fold defaultstate="collapsed" desc="Datos carro">
$db = new db();
$query = "select marcas.nombre as 'marca', modelos.nombre as 'modelo', transmisionvehiculo.transmisionvehiculo as 'transmision', carros.km, tipovehiculo.tipovehiculo as 'tipo', carros.modeloVehiculo, carros.version, carros.color,
carros.placa, carros.motor, carros.cilindros, carros.airbag, carros.vidriosAhumados, carros.tapizado, carros.frenosAbs, carros.aireAcondicionado, carros.estereo as 'sonido', direccionvehiculo.direccionVehiculo,
carros.precioVehiculo as 'precio', carros.negociable, carros.anio, carros.usuario_id, traccionvehiculo.traccionvehiculo as 'traccion'
from carros
    inner join marcas on carros.idMarca = marcas.id
    inner join modelos on carros.idModelo = modelos.idmodelos
    inner join transmisionvehiculo on carros.transmision = transmisionvehiculo.idtransmisionvehiculo
    inner join tipovehiculo on carros.tipoVehiculo = tipovehiculo.idtipovehiculo
    inner join direccionvehiculo on carros.direccionVehiculo = direccionvehiculo.iddireccionVehiculo
    inner join traccionvehiculo on carros.traccion = traccionvehiculo.idtraccionvehiculo";
$where = " where carros.idCarro=" . $_GET['id'] . " limit 1";
$queryimagenes = "select urlImagen from imagenescarros";
$whereimagenes = " where carro_id =" . $_GET['id'];
$queryusuarios = "select telefono1, telefono2 from usuarios inner join carros on usuarios.idusuarios = carros.usuario_id";
$carro = $db->dame_query($query . $where);
$images = $db->dame_query($queryimagenes . $whereimagenes);
if ($carro['suceed'] && count($carro['data']) > 0) {
    $whereusuarios = " where usuarios.idusuarios =" . $carro['data'][0]['usuario_id'];
    $usuario = $db->dame_query($queryusuarios . $whereusuarios);
    $carro['data']['images'] = $images['data'];
}
$tituloPagina = "";
if ($carro['suceed'] && count($carro['data']) > 0)
    $tituloPagina = ucfirst(strtolower($carro['data'][0]['marca'])) . " " . ucfirst(strtolower($carro['data'][0]['modelo']));
//</editor-fold>
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <meta http-equiv="Content-language" content="en" />
        <title><?php echo $tituloPagina; ?> :: mercadomotor.com.ve </title>
        <link href="../css/my_layout.css" rel="stylesheet" type="text/css" />
        <link href="../yaml/screen/forms.css" rel="stylesheet" type="text/css"/>
        <link href="../fancybox/jquery.fancybox-1.3.1.css" rel="stylesheet" media="screen" type="text/css"/>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
        <script src="../js/jcarousellite_1.0.1.min.js" type="text/javascript "></script>
        <script src="../js/lib/jquery.cycle.all.min.js" type="text/javascript"></script>
        <script src="../fancybox/jquery.fancybox-1.3.1.pack.js" type="text/javascript"></script>
        <script src="../js/index.js" type="text/javascript"></script>
        <!--[if lte IE 7]>
        <link href="../css/patches/patch_my_layout.css" rel="stylesheet" type="text/css" />
        <![endif]-->
        <script type="text/javascript">
            $(document).ready(function(){
                $("#imagenesCarro").cycle({
                    fx:'fade',
                    pager:'#thumbs',
                    height:"220px",
                    pagerAnchorBuilder : function(index, DOMelement){
                        console.dir(DOMelement);
                        return '<a href="#"><img src="' + $(DOMelement).find("img").attr("src") + '" width="46"/></a>';
                    }
                });
                $("#imagenesCarro .image").fancybox({
                    'transitionIn' : 'elastic',
                    'transitionOut' : 'fade',
                    'padding':0,
                    'speedIn' :	600,
                    'speedOut' : 200,
                    'cyclic':true,
                    'overlayShow' :false,
                    'titlePosition': 'over'
                });
            });
        </script>
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
                            <?php if (sizeof($carro['data']) > 1): ?>
                                <div class="floatbox">
                                    <h1 class="titulo"><?php echo ucfirst(strtolower($carro['data'][0]['marca'])) . " " . ucfirst(strtolower($carro['data'][0]['modelo'])) . " " . $carro['data'][0]['anio']; ?> </h1>
                                    <div  class="floatbox">
                                        <div class="c50l">
                                            <div id="imagenesCarro" style="background-color: black;">
                                                <?php foreach ($carro['data']['images'] as $imagen) : ?>
                                                    <a title="<?php echo $carro['data'][0]['marca'] . " " . $carro['data'][0]['modelo'] . " " . $carro['data'][0]['anio']; ?>" rel="gallery" class="image" href="<?php echo ROOT . IMAGES . "carros/" . $imagen['urlImagen'] ?>">
                                                        <img  src="<?php echo ROOT . IMAGES . "carros/" . $imagen['urlImagen'] ?>" alt="" width="100%"/>
                                                    </a>
                                                <?php endforeach; ?>
                                            </div>
                                            <div id="thumbs"></div>
                                        </div>
                                        <div class="c50r">
                                            <div>
                                                <table class="full">
                                                    <thead>
                                                        <tr>
                                                            <th align="center" colspan="2"> Especificaciones </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <th width="50%"> Modelo </th>
                                                            <td> <?php echo ucfirst(strtolower($carro['data'][0]['modelo'])); ?> </td>
                                                        </tr>
                                                        <tr>
                                                            <th> Marca </th>
                                                            <td> <?php echo ucfirst(strtolower($carro['data'][0]['marca'])); ?> </td>
                                                        </tr>
                                                        <tr>
                                                            <th> Año </th>
                                                            <td> <?php echo $carro['data'][0]['anio'] ?> </td>
                                                        </tr>
                                                        <tr>
                                                            <th> Transmisión </th>
                                                            <td> <?php echo $carro['data'][0]['transmision'] ?> </td>
                                                        </tr>
                                                        <tr>
                                                            <th>Kilometros</th>
                                                            <td><?php echo $carro['data'][0]['km'] ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Tipo de Vehículo</th>
                                                            <td><?php echo $carro['data'][0]['tipo'] ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Modelo del vehículo</th>
                                                            <td><?php echo $carro['data'][0]['modeloVehiculo'] ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Versión </th>
                                                            <td><?php echo $carro['data'][0]['version'] ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Color</th>
                                                            <td><?php echo $carro['data'][0]['color'] ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Placa</th>
                                                            <td><?php echo $carro['data'][0]['placa'] ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Motor</th>
                                                            <td><?php echo $carro['data'][0]['motor'] ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Cilindros</th>
                                                            <td><?php echo $carro['data'][0]['cilindros'] ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th> Tracción</th>
                                                            <td><?php echo $carro['data'][0]['traccion'] ?></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <table class="full">
                                        <thead>
                                            <tr>
                                                <th colspan="4" align="center"> Extras </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th>Vidrios Ahumados</th>
                                                <th>Tapizado</th>
                                                <th>Airbag</th>
                                                <th> Frenos ABS </th>
                                            </tr>
                                            <tr>
                                                <td><?php echo ($carro['data'][0]['vidriosAhumados'] == 1) ? ' Si ' : ' No '; ?></td>
                                                <td><?php echo ($carro['data'][0]['tapizado'] == 1) ? ' Tela ' : ' Cuero '; ?></td>
                                                <td><?php echo ($carro['data'][0]['airbag'] == 1) ? ' Si ' : ' No '; ?></td>
                                                <td><?php echo ($carro['data'][0]['frenosAbs'] == 1) ? ' Si ' : ' No '; ?></td>
                                            </tr>
                                            <tr>
                                                <th> Aire Acondicionado </th>
                                                <th> Estereo </th>
                                                <th> Dirección </th>
                                                <th> Negociable </th>
                                            </tr>
                                            <tr>
                                                <td><?php echo ($carro['data'][0]['aireAcondicionado'] == 1) ? ' Si ' : ' No '; ?></td>
                                                <td><?php echo ($carro['data'][0]['sonido'] == 1) ? ' Si ' : ' No '; ?></td>
                                                <td><?php echo ($carro['data'][0]['direccionVehiculo'] == 1) ? ' Si ' : ' No '; ?></td>
                                                <td><?php echo ($carro['data'][0]['negociable'] == 1) ? ' Si ' : ' No '; ?></td>
                                            </tr>
                                            <tr>
                                                <th colspan="4"> Precio </th>
                                            </tr>
                                            <tr>
                                                <td colspan="4" align="center"> <?php echo number_format($carro['data'][0]['precio'], 0, ',', '.'); ?> Bsf.</td>
                                            </tr>
                                            <tr>
                                                <th colspan="2" width="50%">Teléfono 1</th>
                                                <th colspan="2" width="50%">Teléfono 2</th>
                                            </tr>
                                            <tr>
                                                <td align="center" colspan="2"><?php echo $usuario['data'][0]['telefono1'] ?></td>
                                                <td align="center" colspan="2"><?php echo $usuario['data'][0]['telefono2'] ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="info">
                                        <p><b>BUSCO CARRO JMC 3000 C.A.</b> sólo se limita a la publicación y/o alojamiento de avisos clasificados en los términos contratados por el cliente aquí identificado y no será responsable por la información contenida en este aviso ya que ha sido suministrada y corroborada por el usuario contratante, ni por daños o perjuicios que pudiere sufrir el visitante por operaciones sobre anuncios publicados en el sitio.</p>
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