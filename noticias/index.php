<?php

include '../includes/constants.php';
$noticia = new noticia();
$auto = new Auto();
$pag = new paginacion();
$query = "select noticia.*, (select min(url) 
    from imagen_noticia where noticia_id = noticia.id) imagen 
    from noticia where status = 1 order by id desc";
$pag->paginar($query, 9);

$variables['tipoVehiculo'] = $auto->listar_tipo_vehiculos();
$variables['marcas'] = $auto->traer_marcas_nav();
$variables['autosTeaser'] = $auto->ultimas_publicaciones();
$variables['noticias'] = $pag->registros;
$variables['paginacion'] = $pag->mostrar_paginado(0, 0, 100, 0, 1);

echo $twig->render('noticia/listado.html.twig', $variables);
?>
