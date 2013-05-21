<?php
// <editor-fold defaultstate="collapsed" desc="init">
include_once '../includes/constants.php';
include_once '../includes/db.php';
include_once '../includes/class.krumo.php';


$db = new db();
$carro = null;
// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="Query">
$id = $_GET['id'];
if (isset($id) && Misc::comprobar_tipo($id)) {
    $query = "select marcas.nombre as 'marca', modelos.nombre as 'modelo', transmisionvehiculo.transmisionvehiculo as 'transmision' , carros.km, tipovehiculo.tipovehiculo as 'tipo', carros.modeloVehiculo, carros.version, colores.nombre as 'color',
carros.placa, carros.airbag, carros.motor, carros.cilindros, carros.vidriosAhumados, carros.tapizado, carros.frenosAbs, carros.aireAcondicionado, carros.estereo as 'sonido', direccionvehiculo.direccionVehiculo,
carros.precioVehiculo as 'precio', carros.negociable, carros.anio, carros.usuario_id, traccionvehiculo.traccionvehiculo as 'traccion', carros.comentario, carros.blindado
from carros
    inner join marcas on carros.idMarca = marcas.id
    inner join modelos on carros.idModelo = modelos.idmodelos
    inner join transmisionvehiculo on carros.transmision = transmisionvehiculo.idtransmisionvehiculo
    inner join tipovehiculo on carros.tipoVehiculo = tipovehiculo.idtipovehiculo
    inner join direccionvehiculo on carros.direccionVehiculo = direccionvehiculo.iddireccionVehiculo
    inner join colores on carros.color = colores.id
    inner join traccionvehiculo on carros.traccion = traccionvehiculo.idtraccionvehiculo";
    $where = " where carros.idCarro=" . $_GET['id'];
    $queryimagenes = "select urlImagen from imagenescarros";
    $whereimagenes = " where carro_id =" . $_GET['id'];
    $queryusuarios = "select telefono1, telefono2 from usuarios inner join carros on usuarios.idusuarios = carros.usuario_id";
// <editor-fold defaultstate="collapsed" desc="Datos Carro">
    $carro = $db->dame_query($query . $where);
    if ($carro['suceed'] && count($carro['data']) > 0) {
        $images = $db->dame_query($queryimagenes . $whereimagenes);
        $whereusuarios = " where usuarios.idusuarios =" . $carro['data'][0]['usuario_id'];
        $usuario = $db->dame_query($queryusuarios . $whereusuarios);
        $carro['data']['images'] = $images['data'];
    }
// </editor-fold>
}
else{
    trigger_error("No se incuyó el id en la petición Get o no era un número válido.".  var_export($_GET, 1), E_USER_ERROR);
    die("Error grave. por favor consulte con el administrador del sitema.");
}
// </editor-fold>
$tituloAuto = " ";
if($carro['suceed'] && count($carro['data'])>0){
    $tituloAuto = ucfirst(strtolower($carro['data'][0]['marca'])) . " " . ucfirst(strtolower($carro['data'][0]['modelo'])) . " " . $carro['data'][0]['anio']." - ".number_format($carro['data'][0]['precio'],0,',','.')." Bsf.";
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="../css/my_layout.css" rel="stylesheet" type="text/css" />
        <style type="text/css" media="all">
            .page{
                margin: 0;
                padding: 0;
}
            .page_margins{
                max-height: 100%;
                border:none;
                padding: 0;
                margin:0;
                width:850px;
                height:630px;
                overflow:hidden;
            }
            #col2_content{
                padding: 0;
            }
            .clearBoth{
                clear: both;
            }
            .marco{
                text-align: center;
                margin-left: 10px;
            }
            .grande{
                width:850px;
               height:630px;
               overflow:hidden;
            }
            .ui-accordion .ui-accordion-content{
                padding:0.3em;
            }
            .ui-state-default, .ui-widget-content .ui-state-default, .ui-widget-header .ui-state-default{
                /*background: #A1D815!important;*/
                background-image:-webkit-gradient(  linear, left bottom, left top,  color-stop(0, rgb(100,210,0)),  color-stop(0.5, rgb(118,215,0)),  color-stop(0.51, rgb(131,219,0)),  color-stop(1, rgb(171,231,0)));
        background-image:-moz-linear-gradient(center bottom,  rgb(100,210,0) 0%,  rgb(118,215,0) 50%,  rgb(131,219,0) 51%,  rgb(171,231,0) 100%);
                color:white!important;
                font-weight: bold;
            }
            .ui-state-default a, .ui-widget-content .ui-state-default a, .ui-widget-header .ui-state-default a{
                color:white!important;
            }
        </style>
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.0/jquery.min.js"></script>
        <script src="../js/lib/jquery.cycle.all.min.js" type="text/javascript"></script>
        <script type="text/javascript" language="javascript">
            $(document).ready(function(){
                if($(".cycle").length > 0){
                    $(".cycle").cycle({
                        prev:"#prev",
                        next:"#next",
                        height:'400px',
                        random:false,
                        fit:'true',
                        containerResize:false,
                        pause:true
                    });
                }
                if($(".accordion").length > 0){
                    $(".accordion").accordion({autoHeight:false});
                }
                if(document.location.href!=top.location.href){
                    $("body").css({
                        "background-image":"none",
                        "background-color":"white"});
//                    $(".page_margins").css({height:"60em"});
                }
            });
        </script>
        <title>Ver Auto <?php echo $tituloAuto; ?> :: mercadomotor.com.ve</title>
        <?php include '../templates/meta-tags.php'; ?>
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
                <div id="col2" class="mainCol">
                    <div id="col2_content">
                        <?php if ($carro['suceed'] == true && count($carro['data']) > 0): ?>
                            <div class="floatbox">
                                <h2 class="titulo">
                                        <div class="float_left" style="font-size: x-large;">
                                            <a id="prev" href="#" class="arrow">&lt;</a>
                                            <a id="next" href="#" class="arrow">&gt;</a>
                                        </div>
                                    <?php echo $tituloAuto; ?>
                                </h2>
                                <div class="c66l">
                                    <div class="cycle clearBoth marco" >
                                        <?php foreach ($carro['data']['images'] as $value): ?>
                                        <img alt="<?php $carro['data'][0]['modelo']; ?>" src="<?php echo ROOT . IMAGES_CARROS . $value['urlImagen'] ?>"/>
                                        <?php endforeach; ?>
                                    </div>
                                    <div class="info">
                                        <p><b>BUSCO CARRO JMC 3000 C.A.</b> sólo se limita a la publicación y/o alojamiento de avisos clasificados en los términos contratados por el cliente aquí identificado y no será responsable por la información contenida en este aviso ya que ha sido suministrada y corroborada por el usuario contratante, ni por daños o perjuicios que pudiere sufrir el visitante por operaciones sobre anuncios publicados en el sitio.</p>
                                    </div>
                                </div>
                                <div class="c33r">
                                    <div class="subc accordion">
                                    <h3><a href="#">Especificaciones</a></h3>
                                    <div>
                                        <table class="full">
                                            <tbody>
                                                <tr>
                                                    <th width="50%"> Modelo </th>
                                                    <td> <?php echo ucfirst(strtolower($carro['data'][0]['modelo'])); ?> </td>
                                                </tr>
                                                <tr>
                                                    <th>Versión </th>
                                                    <td><?php echo $carro['data'][0]['version']; ?></td>
                                                </tr>
                                                <tr>
                                                    <th> Marca </th>
                                                    <td> <?php echo ucfirst(strtolower($carro['data'][0]['marca'])); ?> </td>
                                                </tr>
                                                <tr>
                                                    <th> Año </th>
                                                    <td> <?php echo $carro['data'][0]['anio']; ?> </td>
                                                </tr>
                                                <tr>
                                                    <th> Transmisión </th>
                                                    <td> <?php echo $carro['data'][0]['transmision']; ?> </td>
                                                </tr>
                                                <tr>
                                                    <th>Kilometros</th>
                                                    <td><?php echo "Contacte al vendedor" /* $carro['data'][0]['km'] */; ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Tipo de Vehículo</th>
                                                    <td><?php echo $carro['data'][0]['tipo']; ?></td>
                                                </tr>
                                                <!--<tr>
                                                    <th>Modelo del vehículo</th>
                                                    <td><?php // echo $carro['data'][0]['modeloVehiculo']; ?></td>
                                                </tr>-->
                                                <tr>
                                                    <th>Color</th>
                                                    <td><?php echo $carro['data'][0]['color']; ?></td>
                                                </tr>
                                                <!--<tr>
                                                    <th>Placa</th>
                                                    <td><?php // echo strtoupper($carro['data'][0]['placa']); ?></td>
                                                </tr>-->
                                                <tr>
                                                    <th>Motor</th>
                                                    <td><?php echo $carro['data'][0]['motor']; ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Cilindros</th>
                                                    <td><?php echo $carro['data'][0]['cilindros']; ?></td>
                                                </tr>
                                                <tr>
                                                    <th> Tracción</th>
                                                    <td><?php echo $carro['data'][0]['traccion']; ?></td>
                                                </tr>
                                                <tr>
                                                    <th align="center"> Precio </th>
                                                    <td align="center"><?php echo number_format($carro['data'][0]['precio'],0,',','.'); ?> Bsf.</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <h3><a href="#">Extras</a></h3>
                                    <div>
                                        <table class="full">
                                            <tbody>
                                                <tr>
                                                    <th align="center">Vidrios Ahumados</th>
                                                    <td><?php echo ($carro['data'][0]['vidriosAhumados'] == 1) ? ' Si ' : ' No '; ?></td>
                                                </tr>
                                                <tr>
                                                    <th align="center">Tapizado</th>
                                                    <td><?php echo ($carro['data'][0]['tapizado'] == 1) ? ' Cuero ' : ' Tela '; ?></td>
                                                </tr>
                                                <tr>
                                                    <th align="center">Airbag</th>
                                                    <td><?php echo ($carro['data'][0]['airbag'] == 1) ? ' Si ' : ' No '; ?></td>
                                                </tr>
                                                <tr>
                                                    <th align="center"> Frenos ABS </th>
                                                    <td><?php echo ($carro['data'][0]['frenosAbs'] == 1) ? ' Si ' : ' No '; ?></td>
                                                </tr>
                                                <tr>
                                                    <th align="center"> Aire Acondicionado </th>
                                                    <td><?php echo ($carro['data'][0]['aireAcondicionado'] == 1) ? ' Si ' : ' No '; ?></td>
                                                </tr>
                                                <tr>
                                                    <th align="center"> Sonido </th>
                                                    <td><?php echo ($carro['data'][0]['sonido'] == 1) ? 'Estero' : 'Normal'; ?></td>
                                                </tr>
                                                <tr>
                                                    <th align="center"> Blindado </th>
                                                    <td><?php echo ($carro['data'][0]['blindado'] == 1) ? 'Si' : 'No'; ?></td>
                                                </tr>
                                                <tr>
                                                    <th align="center"> Dirección </th>
                                                    <td><?php echo $carro['data'][0]['direccionVehiculo']; ?></td>
                                                </tr>
                                                <tr>
                                                    <th align="center"> Negociable </th>
                                                    <td><?php echo ($carro['data'][0]['negociable'] == 1) ? ' Si ' : ' No '; ?></td>
                                                </tr>
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                    <h3><a href="#">Contacta al Vendedor</a> </h3>
                                    <div>
                                        <table class="full">
                                            <tr>
                                                <th width="50%"  align="center">Teléfono 1</th>
                                                <td align="center"><?php echo $usuario['data'][0]['telefono1'] ?></td>
                                            </tr>
                                            <tr>
                                                <th align="center">Teléfono 2</th>
                                                <td align="center"><?php echo $usuario['data'][0]['telefono2'] ?></td>
                                            </tr>

                                        </table>
                                    </div>
                                    <h3><a href="">Información adicional</a></h3>
                                    <div>
                                        <div class="info">
                                            <?php echo ucfirst(strtolower($carro['data'][0]['comentario'])); ?>
                                        </div>
                                    </div>
                                </div>
                                </div>
                                <div class="clearBoth">
                                &nbsp;
                            </div>
                            </div>
                    <?php else: ?>
                        <div class="floatbox grande">
                            <div class="note">
                                <p class="message">
                                    <img src="<?php echo ROOT . IMAGES ?>error.png" alt="error" hspace="2" align="top"/>
                                                    Hubo un error al conectar con la base de datos. Por favor intente de nuevo
                                                </p>
                                            </div>
                        </div>
                    <?php endif; ?>
                    </div>
                </div>
                <div class="floatbox clearBoth" >&nbsp;</div>
            </div>
        </div>
    </body>
</html>
