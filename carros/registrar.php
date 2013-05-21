<?php

if (stristr($_SERVER['HTTP_USER_AGENT'], "blackberry")) {
    die("Lo sentimos. Temporalmente el registro de autos via moviles no esta soportado.");
}
// <editor-fold defaultstate="collapsed" desc="init">
include_once ('../includes/constants.php');

$pagina = 'autos/registrar.html.twig';
$variables = array();
$db = new db();
$usuario = new usuario();
$auto = new Auto();
$usuario->confirmar_miembro();
$variables['sesion'] = $_SESSION;
$variables['usuario'] = $_SESSION['usuario'];
//// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="Log Out">
if (isset($_GET['logout']) && $_GET['logout'] == true) {
    $usuario->log_Out();
}
// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="Select">
$variables['tipoVehiculo'] = $db->dame_query("Select * from tipovehiculo");
$variables['traccionVehiculo'] = $db->dame_query("SELECT * FROM  `traccionvehiculo` ");
$variables['transmisionVehiculo'] = $db->dame_query("select * from transmisionvehiculo");
$variables['direccionVehiculo'] = $db->dame_query("select * from direccionvehiculo");
$variables['coloresVehiculo'] = $db->dame_query("select * from colores");
//// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="Operaciones">
if (isset($_POST['enviar'])) {
    $data = array();
    $data['auto'] = $_POST;
    $data['images'] = $_FILES;
    $data['user'] = $_SESSION['usuario'];
    $exito = $auto->ingresarAuto($data);
    if ($exito['suceed']) {
        $pagina = "autos/confirmacion-registro.html.twig";
    }
}
//// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="twig">
echo $twig->render($pagina, $variables);
// </editor-fold>
?>