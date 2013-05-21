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
    count(cv.idCarro) vistas
    from carros
        inner join imagenescarros on imagenescarros.carro_id = carros.idCarro and imagenescarros.tipoimagen_idtipoimagen = 1
        inner join marcas on carros.idMarca = marcas.id
        inner join modelos on carros.idModelo= modelos.idmodelos
        inner join transmisionvehiculo on transmisionvehiculo.idtransmisionvehiculo = carros.transmision
        inner join colores on colores.id = carros.color
        inner join usuarios on carros.usuario_id = usuarios.idusuarios
        inner join ciudad on ciudad.idciudad = usuarios.ciudad_idciudad
        inner join estado on estado.idEstado = usuarios.Estado_idEstado
        inner join carros_vistos cv on cv.idCarro = carros.idCarro 
            where carros.status = 1 and datediff(CURRENT_TIMESTAMP,cv.fecha)<=7
                group by cv.idCarro
                    order by 8 desc
        limit 10";
// </editor-fold>

$registros = $db->dame_query($query);

echo $twig->render('feed.xml.twig', array("registros" => $registros));
?>

