<?php

// <editor-fold defaultstate="collapsed" desc="init">
include_once '../includes/constants.php';

$db = new db();
$carro = null;
// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="Query">
$id = $_GET['id'];
if (isset($id) && Misc::comprobar_tipo($id)) {
    $query = "select 
        carros.idCarro,
        marcas.nombre as 'marca', 
        modelos.nombre as 'modelo', 
        transmisionvehiculo.transmisionvehiculo as 'transmision' , 
        carros.km, tipovehiculo.tipovehiculo as 'tipo', 
        carros.modeloVehiculo, 
        carros.version, 
        colores.nombre as 'color',
        carros.placa, 
        carros.airbag, 
        carros.motor, 
        carros.cilindros, 
        carros.vidriosAhumados, 
        carros.tapizado, 
        carros.frenosAbs, 
        carros.aireAcondicionado, 
        carros.estereo as 'sonido', 
        direccionvehiculo.direccionVehiculo,
        carros.precioVehiculo as 'precio', 
        carros.negociable, 
        carros.anio, 
        carros.usuario_id, 
        traccionvehiculo.traccionvehiculo as 'traccion', 
        carros.comentario, 
        carros.blindado,
        carros.vendido
        from carros
        inner join marcas on carros.idMarca = marcas.id
        inner join modelos on carros.idModelo = modelos.idmodelos
        inner join transmisionvehiculo on carros.transmision = transmisionvehiculo.idtransmisionvehiculo
        inner join tipovehiculo on carros.tipoVehiculo = tipovehiculo.idtipovehiculo
        inner join direccionvehiculo on carros.direccionVehiculo = direccionvehiculo.iddireccionVehiculo
        inner join colores on carros.color = colores.id
        inner join traccionvehiculo on carros.traccion = traccionvehiculo.idtraccionvehiculo";
    $where = " where carros.idCarro= {$_GET['id']}";
    $queryimagenes = "select urlImagen from imagenescarros";
    $whereimagenes = " where carro_id = {$_GET['id']}";
    $queryusuarios = "select telefono1, telefono2, direccion, estado.Estado, ciudad.ciudad 
        from usuarios
        inner join estado on usuarios.Estado_idEstado = estado.idEstado
        inner join ciudad on usuarios.ciudad_idciudad = ciudad.idciudad 
        inner join carros on usuarios.idusuarios = carros.usuario_id";
// <editor-fold defaultstate="collapsed" desc="Datos Carro">
    $carro = $db->dame_query($query . $where);
    if ($carro['suceed'] && count($carro['data']) > 0) {
        $images = $db->dame_query($queryimagenes . $whereimagenes);
        $whereusuarios = " where usuarios.idusuarios = {$carro['data'][0]['usuario_id']}";
        $usuario = $db->dame_query($queryusuarios . $whereusuarios);
        $carro['data'][0]['images'] = $images['data'];
    }
// </editor-fold>
} else {
    trigger_error("No se incuyó el id en la petición Get o no era un número válido." . var_export($_GET, 1), E_USER_ERROR);
    die("Error grave. por favor consulte con el administrador del sistema.");
}
// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="titulo de la página">
$tituloAuto = " ";
if ($carro['suceed'] && count($carro['data']) > 0) {
    $tituloAuto = ucfirst(strtolower($carro['data'][0]['marca'])) . " " . ucfirst(strtolower($carro['data'][0]['modelo'])) . " " . $carro['data'][0]['anio'] . " - " . number_format($carro['data'][0]['precio'], 0, ',', '.') . " Bsf.";
}
// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="mejora de formato">
if (count($carro['data']) > 0) {
    $datos_carro = $carro['data'][0];
    $db->insert("carros_vistos", array(
        "idCarro" => $_GET['id'],
        "ip" => $_SERVER['REMOTE_ADDR']
    ));
}
else{
    $datos_carro = array();
}
if (isset($usuario) && $usuario['suceed'] && isset($usuario['data'][0]) && count($usuario['data'] > 0)) {
    $datos_usuario = $usuario['data'][0];
} else {
    $datos_usuario = array();
}
// </editor-fold>
echo $twig->render("carros/preview.html.twig", array(
    "tituloAuto" => $tituloAuto,
    "datos_carro" => $datos_carro,
    "datos_usuario" => $datos_usuario
));
?>