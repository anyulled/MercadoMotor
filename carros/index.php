<?php

include_once ('../includes/constants.php');
session_start();

$db = new db();
$auto = new Auto();
// <editor-fold defaultstate="collapsed" desc="Carros y Marcas">
$mismarcas = $db->dame_query("select nombre, urlimagen, count(idCarro) as 'carros' from marcas inner join carros on carros.idMarca = marcas.id group by marcas.id;");
$miscarros = $db->dame_query("select idCarro,
imagenescarros.urlImagen as 'imagen',
transmisionvehiculo.transmisionvehiculo as 'transmision',
modelos.nombre as 'Modelo',
marcas.nombre as 'Marca',
precioVehiculo,
carros.anio, 
carros.vendido,
estado.Estado estado
     from carros
    inner join imagenescarros on carros.idCarro = imagenescarros.carro_id and imagenescarros.tipoimagen_idtipoimagen=1
    inner join transmisionvehiculo on transmisionvehiculo.idtransmisionvehiculo = carros.transmision
    inner join modelos on modelos.idmodelos = carros.idModelo
    inner join marcas on marcas.id = carros.idMarca
    inner join usuarios on carros.usuario_id = usuarios.idusuarios
    inner join estado on usuarios.Estado_idEstado = estado.idEstado
    where carros.status = 1
    order by idCarro desc limit 9");
// </editor-fold>

echo $twig->render('autos/index.html.twig', array(
    'tipoVehiculo'=>$auto->listar_tipo_vehiculos(),
    'marcas' => $auto->traer_marcas_nav(),
    'autosTeaser' => $auto->ultimas_publicaciones(),
    "mismarcas" => $mismarcas,
    "miscarros" => $miscarros
));
?>