<?php

// <editor-fold defaultstate="collapsed" desc="init">
include_once 'includes/constants.php';
include_once 'includes/db.php';
include_once 'includes/paginacion.php';
$auto = new Auto();
$resultados = new paginacion();
// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="Query">
$query = "select
    carros.idCarro, carros.precioVehiculo,
    imagenescarros.urlImagen as 'imagen', carros.idMarca,
    marcas.nombre as 'Marca',
    modelos.nombre as 'Modelo',
    transmisionvehiculo.transmisionvehiculo 'transmision',
    carros.anio,
    estado.Estado 'estado', 
    carros.vendido
        from carros
            inner join imagenescarros on carros.idCarro = imagenescarros.carro_id and tipoimagen_idtipoimagen = 1
            inner join marcas on carros.idMarca = marcas.id
            inner join modelos on carros.idModelo = modelos.idmodelos
            inner join transmisionvehiculo on carros.transmision = transmisionvehiculo.idtransmisionvehiculo
            inner join usuarios on carros.usuario_id = usuarios.idusuarios
            inner join estado on usuarios.Estado_idEstado = estado.idEstado
    ";
// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="where">
$where = "";
$criterios = 0;
$operador = " = ";
$campos = array("idMarca", "idModelo", "preciomin", "preciomax", "anio_min", "anio_max", "estado");
if (isset($_GET['submit'])) {
    $parameters = $_GET;
}
if (isset($_POST['submit'])) {
    $parameters = $_POST;
}

if (isset($parameters) && is_array($parameters)) {
    natsort($parameters);
    while (list($key, $val) = each($parameters)) {
        if ($val != "" and in_array($key, $campos)) {
            if ($key == "preciomin") {
                $key = "precioVehiculo";
                $operador = " >= ";
            }
            if ($key == "preciomax") {
                $key = "precioVehiculo";
                $operador = " <= ";
            }
            if ($key == "anio_min") {
                $key = "anio";
                $operador = " >= ";
            }
            if ($key == "anio_max") {
                $key = "anio";
                $operador = " <= ";
            }
            if ($key == "estado") {
                $key = "Estado_idEstado";
            }
            $where .= ( ($criterios == 0) ? " where " : " and ") . $key . $operador . $val;
            $criterios++;
        }
    }
}
if ($criterios == 0) {
    $where .=" where carros.status =1";
} else {
    $where .=" and carros.status =1";
}
if (isset($_GET['order']) && isset($_GET['dir'])) {
    $where .=" order by {$_GET['order']} {$_GET['dir']}";
} else {
    $where .=" order by carros.idCarro desc";
}
// </editor-fold>
$resultados->paginar($query . $where, 12);
// <editor-fold defaultstate="collapsed" desc="data render">

$variables = array(
    'tipoVehiculo' => $auto->listar_tipo_vehiculos(),
    "marcas" => $auto->traer_marcas_nav(),
    "autosTeaser" => $auto->ultimas_publicaciones(),
    "resultados" => $resultados->registros,
    "paginacion" => $resultados->mostrar_paginado(0, 0, 100, 0, 1),
    "query" => $resultados->query
);

echo $twig->render('busqueda.html.twig', $variables );
// </editor-fold>
?>