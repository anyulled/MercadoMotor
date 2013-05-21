<?php

// <editor-fold defaultstate="collapsed" desc="init">
include_once 'includes/constants.php';
$db = new db(true);
$auto = new Auto();
$mensaje = array();
$result = false;
// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="Registrar usuario">
if (isset($_POST['enviar'])) {
    $usuarioTemp = $db->select('*', 'usuarios', array('login' => $_POST['usuario'], 'password' => $_POST['password']));

    if ($usuarioTemp['suceed'] == 'false' && count($usuarioTemp['data']) == 0) {
        if ($_POST['password'] == $_POST['password2']) {
            $usuario = new usuario();
            $data = $_POST;
            $result = $usuario->crearUsuario($data);
        } else {
            array_push($mensaje, "Error al crear usuario");
        }
    } else {
        array_push($mensaje, "Este usuario ya existe");
    }
}// </editor-fold>
echo $twig->render("registrar.html.twig", array(
    "marcas"=>$auto->traer_marcas_nav(),
    "autosTeaser"=>$auto->ultimas_publicaciones(),
    "result" => $result,
    "mensaje" => $mensaje));
?>