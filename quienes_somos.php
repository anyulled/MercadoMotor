<?php
include_once 'includes/constants.php';
$db = new db();
$auto = new Auto();
echo $twig->render("quienes_somos.html.twig",array(
    "marcas"=>$auto->traer_marcas_nav(),
    "autosTeaser"=>$auto->ultimas_publicaciones()
));
?>
