<?php

include_once 'includes/constants.php';
$exito = false;
$db = new db();
$auto = new Auto();
if (isset($_POST['submit'])) {
    unset($_POST['submit']);
    $headers = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $headers .= 'From: mercadomotor Daemon <info@mercadomotor.com.ve>' . "\r\n";
    if (isset($_POST['email'])) {
        $headers .="Reply-To: {$_POST['email']}";
    }
    if (isset($_POST['mensaje'])) {
        $_POST['mensaje'] = strip_tags($_POST['mensaje']);
    }
    $html = "<h2>Datos de contacto</h2><div>";
    $html.="<p>Nombre:<span>{$_POST['nombre']}</span></p>";
    $html.="<p>Email:<span>{$_POST['email']}</span></p>";
    $html.="<p>Telefono:<span>{$_POST['telefono']}</span></p>";
    $html.="<p>Mensaje:<span>{$_POST['mensaje']}</span></p>";
    $html.="</div>";
    $exito = mail("info@mercadomotor.com.ve", "mercadomotor.com.ve: Contacto", $html, $headers);
}
echo $twig->render("contacto.html.twig", array(
    'tipoVehiculo' => $auto->listar_tipo_vehiculos(),
    "marcas" => $auto->traer_marcas_nav(),
    "autosTeaser" => $auto->ultimas_publicaciones(),
    "exito" => $exito));
?>