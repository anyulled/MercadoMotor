<?php

// <editor-fold defaultstate="collapsed" desc="inicializando variables">
include_once '../includes/constants.php';
$db = new db();
$auto = new Auto();
$miMarca = array();
$miMarca['data'][0]['nombre'] = " ";
$modelos = null;
$lista = null;
// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="marcas y modelos">
if (isset($_GET['nombre']) || isset($_GET['marca'])) {
    $miMarca = $db->dame_query("select id, nombre, urlimagen, banner from marcas where nombre ='" . $_GET['nombre'] . "'");
    if (isset($_GET['modelo']) && isset($miMarca['data'][0])) {
        $get_modelo = str_replace("-", " ", $_GET['modelo']);
        $miModelo = $db->dame_query("select idmodelos, nombre 
        from modelos 
            where nombre='$get_modelo' and idmarcas = {$miMarca['data'][0]['id']}");
    }
}
// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="Carros de la marca y modelo">
if (isset($miMarca) && $miMarca['suceed'] && count($miMarca['data']) > 0) {
    $query = "select idCarro,
    precioVehiculo, 
    modelos.nombre as 'Modelo', 
    marcas.nombre as 'Marca',
    anio, 
    transmisionvehiculo.transmisionvehiculo as 'transmision', 
    imagenescarros.urlImagen as 'imagen',
    carros.vendido,
    estado.Estado 'estado'
    from carros
    inner join usuarios on carros.usuario_id = usuarios.idusuarios
    inner join estado on usuarios.Estado_idEstado = estado.idEstado
    inner join modelos on carros.idModelo = modelos.idmodelos
    inner join marcas on marcas.id = carros.idMarca
    inner join transmisionvehiculo on carros.transmision = transmisionvehiculo.idtransmisionvehiculo
    inner join imagenescarros on carros.idCarro = imagenescarros.carro_id and imagenescarros.tipoimagen_idtipoimagen = 1";
    $where = " where carros.idMarca= " . $miMarca['data'][0]['id'] . " and carros.status=1";
    if (isset($miModelo)) {
        $where.= ( sizeof($miModelo['data']) > 0) ? " and carros.idModelo=" . $miModelo['data'][0]['idmodelos'] : "";
        $where.= " order by carros.FechaCreacion desc ";
        $lista = $db->dame_query($query . $where);
    } else {
        $lista = array();
    }

// <editor-fold defaultstate="collapsed" desc="modelos de la marca">
    $modelos = $db->dame_query("
    select distinct modelos.idmodelos, modelos.nombre
        from modelos
        inner join carros on carros.idModelo = modelos.idmodelos
        where idmarcas=" . $miMarca['data'][0]['id'] . " and carros.status=1 order by modelos.nombre");
    //</editor-fold>
}
// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="titulo de pagina">
if (isset($miMarca['data']) && isset($miMarca['data'][0])) {
    $nombre_pagina = $miMarca['data'][0]['nombre'];
    if (isset($miModelo['data']) && isset($miModelo['data'][0]['nombre'])) {
        $nombre_pagina .= " - " . $miModelo['data'][0]['nombre'];
    }
} else {
    $nombre_pagina = " ";
}
// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="data render">
echo $twig->render('autos/marca.html.twig', array(
    'tipoVehiculo' => $auto->listar_tipo_vehiculos(),
    'marcas' => $auto->traer_marcas_nav(),
    'autosTeaser' => $auto->ultimas_publicaciones(),
    "nombre_pagina" => $nombre_pagina,
    "miMarca" => $miMarca,
    "modelos" => $modelos,
    "lista" => $lista
));
// </editor-fold>
?>