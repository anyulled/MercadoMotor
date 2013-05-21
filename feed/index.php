<?php

require '../includes/constants.php';
$db = new db();
header("Content/Type: application/rss+xml; charset=UTF-8");

// <editor-fold defaultstate="collapsed" desc="query">
$query = "select idCarro id,
    marcas.nombre marca,
    modelos.nombre modelo,
    anio,
    precioVehiculo precio,
    imagenescarros.urlImagen url_imagen,
    carros.FechaCreacion fecha,
    colores.nombre color,
    transmisionvehiculo.transmisionvehiculo transmision,
    comentario,
    ifnull(km,0) km,
    estado.Estado estado,
    ciudad.ciudad ciudad
    from carros
        inner join imagenescarros on imagenescarros.carro_id = carros.idCarro and imagenescarros.tipoimagen_idtipoimagen = 1
        inner join marcas on carros.idMarca = marcas.id
        inner join transmisionvehiculo on transmisionvehiculo.idtransmisionvehiculo = carros.transmision
        inner join modelos on carros.idModelo= modelos.idmodelos
        inner join colores on colores.id = carros.color
        inner join usuarios on carros.usuario_id = usuarios.idusuarios
        inner join ciudad on ciudad.idciudad = usuarios.ciudad_idciudad
        inner join estado on estado.idEstado = usuarios.Estado_idEstado
            where carros.status = 1 
                order by idCarro desc
    limit 10";
// </editor-fold>

$registros = $db->dame_query($query);
$feed = array();
foreach ($registros['data'] as $carro) {
    $imagenes_db = $db->dame_query("select urlImagen url from imagenescarros where carro_id =" . $carro['id']);
    if ($imagenes_db['suceed'] && count($imagenes_db['data']) > 0) {
        $carro['imagenes'] = $imagenes_db['data'];
        array_push($feed, $carro);
    }
}

echo $twig->render('feed.xml.twig', array("registros" => $feed));
?>
