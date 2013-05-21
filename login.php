<?php

include_once('includes/constants.php');
$db = new db();
$auto = new Auto();
$usuario = new usuario();

$ingresar = (isset($_POST['ingresar'])) ? $_POST['ingresar'] : true;
if (isset($_POST['ingresar'])) {
    $login = $usuario->login($_POST['usuario'], $_POST['password']);
}
echo $twig->render('login.html.twig', array(
    "ingresar" => $ingresar,
    "marcas" => $auto->traer_marcas_nav(),
    "autosTeaser" => $auto->ultimas_publicaciones()
));
?>