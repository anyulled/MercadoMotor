<?php

include '../includes/constants.php';
$noticia = new noticia();
$auto = new Auto();
if (isset($_GET['id'])) {
    $dato = $noticia->ver($_GET['id']);
}
$variables['tipoVehiculo'] = $auto->listar_tipo_vehiculos();
$variables['marcas'] = $auto->traer_marcas_nav();
$variables['autosTeaser'] = $auto->ultimas_publicaciones();
if (!empty($dato['noticia'])) {
    $variables['noticia'] = $dato['noticia'];
    $variables['imagenes'] = $dato['imagenes'];
} else {
    $variables['mensaje'] = "No se pudo cargar la noticia";
}
echo $twig->render('noticia/noticia.html.twig', $variables);
?>
