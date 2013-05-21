<?php

// <editor-fold defaultstate="collapsed" desc="includes">
include_once 'includes/constants.php';

$db = new db();
$auto = new Auto();
$noticia = new noticia();
// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="data render">

echo $twig->render('index.html.twig', array(
    'tipoVehiculo'=>$auto->listar_tipo_vehiculos(),
    'marcas' => $auto->traer_marcas_nav(),
    'autosTeaser' => $auto->ultimas_publicaciones(),
    "feed" => $noticia->listar(3)));
// </editor-fold>
?>