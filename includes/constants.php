    <?php

date_default_timezone_set("America/Caracas");

// <editor-fold defaultstate="collapsed" desc="iniciando variables">
$root = null;
$host = null;
$user = null;
$password = null;
$db = null;
$server_root = null;
$email_error = null;
$mostrar_error = null;
$debug = false;
// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="Comprobación de servidor">
if ($_SERVER['SERVER_NAME'] == "www.mercadomotor.com.ve" | $_SERVER['SERVER_NAME'] == "mercadomotor.com.ve") {
    $root = "http://" . $_SERVER['SERVER_NAME'];
    $host = "localhost";
    $db = "buscocar_mercadomotor";
    $user = "buscocar_web";
    $password = "Caracas2011";
    $server_root = $_SERVER['DOCUMENT_ROOT'] . "/";
    $mostrar_error = FALSE;
    $email_error = TRUE;
} else {
    $root = "http://" . $_SERVER['SERVER_NAME'] . "/MercadoMotor";
    $host = "localhost";
    $user = "root";
    $password = "root";
    $db = "mercadomotor";
    $server_root = $_SERVER['DOCUMENT_ROOT'] . "/MercadoMotor/";
    $email_error = FALSE;
    $mostrar_error = TRUE;
    $debug = true;
}
// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="definiendo constantes">
define("ROOT", $root);
define("HOST", $host);
define("USER", $user);
define("PASSWORD", $password);
define("DB", $db);
define("IMAGES", "/images/");
define("LOGOS", "nav/");
define("CARROS", "/carros/");
define("IMAGES_CARROS", "/images/carros/");
define("IMAGES_ADS", "/images/ads/");
define("CONCESIONARIOS", "/concesionarios/");
define("LOCALES", "locales/");
define("PREVIEW", ROOT . "/ver/");
define("ADS", "/ads/");
define("SERVER_ROOT", $server_root);
define("EMAIL_ERROR", $email_error);
define("EMAIL_CONTACTO", "anyulled@gmail.com");
define("EMAIL_TITULO", "MercadoMotor.com.ve :: error");
define("MOSTRAR_ERROR", $mostrar_error);
define("TITULO", " :: MercadoMotor.com.ve");
define("DEBUG", $debug);
//// </editor-fold>
//<editor-fold defaultstate="collapsed" desc="Twig">
include_once SERVER_ROOT . 'includes/twig/lib/Twig/Autoloader.php';
include_once SERVER_ROOT . 'includes/extensiones.php';
Twig_Autoloader::register();

$loader = new Twig_Loader_Filesystem(SERVER_ROOT . 'templates');
$twig = new Twig_Environment($loader, array(
    'debug' => true,
    'cache' => SERVER_ROOT . 'cache',
    "auto_reload" => true)
);
if (isset($_SESSION))
    $twig->addGlobal("session", $_SESSION);

$twig->addExtension(new extensiones());
$twig->addExtension(new Twig_Extension_Debug());

//</editor-fold>
//<editor-fold defaultstate="collapsed" desc="autoload">
function __autoload($clase) {
    include_once SERVER_ROOT . "includes/" . $clase . ".php";
}

spl_autoload_register("__autoload", false);
//</editor-fold>
//<editor-fold defaultstate="collapsed" desc="cerrar sesión">
if (isset($_GET['logout']) && $_GET['logout'] == 1) {
    $user_logout = new usuario();
    $user_logout->log_Out();
}
//</editor-fold>
?>