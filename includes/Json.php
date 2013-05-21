<?php

require_once('db.php');
require_once 'Auto.php';
require_once 'Concesionario.php';
require_once 'publicidad.php';
require_once 'usuario.php';
require_once 'noticia.php';
set_error_handler("Misc::error_handler");
$db = new db();
$result = null;

if (isset($_GET['accion'])) {
    switch ($_GET['accion']) {
        case 'delete':
            if (isset($_GET['id']) && Misc::comprobar_tipo($_GET['id'])) {
                $auto = new auto();
                $result = $auto->borrarAuto($_GET['id']);
            }
            break;
        case 'delete_user':
            $usuario = new usuario();
            $result = $usuario->eliminarUsuario($_GET['id']);
            $db->delete('carros', array("usuario_id" => $_GET['id']));
            break;
        case 'update_status':
            $auto = new auto();
            $result = $auto->activarAuto($_GET['id'], $_GET['status']);
            break;
        case 'vendido':
            $auto = new auto();
            $result = $auto->vendido($_GET['id'], $_GET['status']);
            break;
        case 'eliminar_imagen':
            if (isset($_GET['idImagenesCarros'])) {
                $auto = new auto();
                $result = $auto->eliminar_imagen($_GET['idImagenesCarros']);
            }
            break;
        case 'eliminar_imagen_noticia':
            if (isset($_GET['id'])) {
                $noticia = new noticia();
                $result = $noticia->eliminar_imagen($_GET['id']);
            }
            break;
        case 'delete_ad':
            $ad = new publicidad();
            $result = $ad->borrar_publicidad($_GET['id']);
            break;
        case 'login_duplicado':
            $usuarios = $db->select("count(*) as usuarios", "usuarios", array("login" => "'" . $_GET['usuario'] . "'"));
            if (intval($usuarios['data'][0]['usuarios']) > 0) {
                $result = "El usuario <b>{$_GET['usuario']}</b> ya existe. Intente con otro nombre";
            } else {
                $result = true;
            }
            break;
        default:
            $result = array("suceed" => false, "info" => "query mal formado.");
            break;
    }
} elseif (isset($_GET['query'])) {
    $tablaspermitidas = array("estado", "ciudad", "modelos", "marcas");
    if (in_array($_GET['query'], $tablaspermitidas)) {
        $consulta = "select * from ";
        $consulta .= ( isset($_GET['query'])) ? $_GET['query'] : "estado";
        $consulta.= ( isset($_GET['where'])) ? " where " . $_GET['where'] . " = " . $_GET['campo'] : "";
        if ($_GET['query'] == "modelos" || $_GET['query'] == "marcas") {
            $consulta.= " order by nombre ASC";
        }
        $result = $db->dame_query($consulta);
    } else {
        trigger_error("Query incorrecto: " . var_export($_GET, 1));
        $result = array("suceed" => false, "info" => "Consulta no permitida.");
    }
} elseif (isset($_GET['concesionario'])) {
    switch ($_GET['concesionario']) {
        case "delete":
            $conc = new Concesionario();
            $conc->eliminar($_GET['id']);
            break;
        case "status":
            $conc = new Concesionario();
            $conc->actualizar(array(status => $_GET['stat']), $_GET['id']);
            break;
        default:
            $result = array("suceed" => false, "info" => "query mal formado.");
            break;
    }
} else {
    $result = array("suceed" => false, "info" => "query mal formado.");
}
echo json_encode($result);
?>