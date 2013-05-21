<?php

// <editor-fold defaultstate="collapsed" desc="init">
include_once('../includes/db.php');
include_once '../includes/constants.php';
include_once '../includes/usuario.php';
include_once '../includes/paginacion.php';
$db = new db();
$usuario = new usuario();
$pag = new paginacion();
$pag->css_clase_lista = "pro_pages";
$pag->css_clase_anterior = "pro_btn pro_prev";
$pag->css_clase_pagina="pro_btn pro_page";
$pag->css_clase_siguiente="pro_btn pro_next";
// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="sesion">
$usuario->confirmar_miembro();
if (isset($_GET['logout'])) {
    $usuario->log_Out();
}
// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="Query">
$query = "select
    carros.idCarro, carros.precioVehiculo,
    imagenescarros.urlImagen as 'imagen',
    marcas.nombre as 'Marca',
    modelos.nombre as 'Modelo',
    transmisionvehiculo.transmisionvehiculo as 'transmision',
    direccionvehiculo.direccionVehiculo as 'direccion' ,
    traccionvehiculo.traccionvehiculo as 'traccion' ,
    tipovehiculo.tipovehiculo as 'tipo'
from carros
    inner join imagenescarros on carros.idCarro = imagenescarros.carro_id and tipoimagen_idtipoimagen = 1
    inner join marcas on carros.idMarca = marcas.id
    inner join modelos on carros.idModelo = modelos.idmodelos
    inner join transmisionvehiculo on carros.transmision = transmisionvehiculo.idtransmisionvehiculo
    inner join direccionvehiculo on carros.direccionVehiculo = direccionvehiculo.iddireccionVehiculo
    inner join traccionvehiculo on carros.traccion = traccionvehiculo.idtraccionvehiculo
    inner join tipovehiculo on carros.tipoVehiculo = tipovehiculo.idtipovehiculo";
if (isset($_SESSION['usuario']) && $_SESSION['usuario']['tipousuario'] == 1) {
    $query.="";
} else {
    $query.=" where usuario_id=" . $_SESSION['usuario']['idusuarios'];
}
// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="paginacion">
If (isset($_GET['order'])) {
    $query.=" order by " . $_GET['order'];
    if (isset($_GET['dir'])) {
        $query.=" " . $_GET['dir'];
    }
} else {
    $query.=" order by carros.idCarro desc";
}
$pag->paginar($query);
$carros = $pag->registros;
// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="twig">
echo $twig->render('carros/admin.html.twig', array(
    "carros" => $carros,
    "sesion" => $_SESSION,
    "usuario" => $_SESSION['usuario'],
    "paginado" => $pag->mostrar_paginado(),
    "paginado_lista" => $pag->mostrar_paginado_lista(),
    "dir" => (isset($_GET['dir']) ? $_GET['dir'] : "ASC")
));
// </editor-fold>
?>