<?php
// <editor-fold defaultstate="collapsed" desc="init">
include_once('../includes/db.php');
include_once('../includes/class.krumo.php');
include_once '../includes/constants.php';
include_once '../includes/usuario.php';
// </editor-fold>

$db = new db();
$usuario = new usuario();
$usuario->confirmar_miembro();

if (isset($_GET['logout']) && $_GET['logout'] == true) {
    $usuario->log_Out();
}
echo $twig->render('usuarios/inicio.html.twig', array(
    "sesion"=>$_SESSION,
    "usuario"=>$_SESSION['usuario']
));
?>