<?php

// <editor-fold defaultstate="collapsed" desc="init">
include_once '../includes/constants.php';
$db = new db();//TODO separar clase misc de db
$usuario = new usuario();
$pag = new paginacion();
$pagina = "carros/pagar/inicio.html.twig";
$variables = array();
$accion = "";
// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="sesion">
$usuario->confirmar_miembro();
$variables['sesion'] = $_SESSION;
$variables['usuario'] = $_SESSION['usuario'];
if (isset($_GET['logout'])) {
    $usuario->log_Out();
}
// </editor-fold>

if (!isset($_GET['accion'])) {
    $accion = "";
} else {
    $accion = $_GET['accion'];
}
switch ($accion) {
    case "pagar":
        $pagina = "carros/pagar/formapago.html.twig";
        $variables['id'] = $_GET['id'];
        break;
    case "tdc":
        $pagina = "construccion.html.twig";
        $variables['id'] = $_GET['id'];
        break;
    case "transferencia":
        $pagina = "carros/pagar/eligebanco.html.twig";
        $variables['id'] = $_GET['id'];
        break;
    case "banco_activo":
        $pagina = "carros/pagar/banco_activo.html.twig";
        $variables['id'] = $_GET['id'];
        break;
    case "banesco":
        $pagina = "carros/pagar/banesco.html.twig";
        $variables['id'] = $_GET['id'];
        break;
    case "formulario":
        $pagina = "carros/pagar/formulario.html.twig";
        $variables['id'] = $_GET['id'];
        $variables['banco'] = $_GET['banco'];
        break;
    default:
        // <editor-fold defaultstate="collapsed" desc="consulta">
        $query = "select
    carros.idCarro, carros.precioVehiculo,
    imagenescarros.urlImagen as 'imagen',
    marcas.nombre as 'Marca',
    modelos.nombre as 'Modelo',
    transmisionvehiculo.transmisionvehiculo as 'transmision',
    direccionvehiculo.direccionVehiculo as 'direccion' ,
    traccionvehiculo.traccionvehiculo as 'traccion' ,
    tipovehiculo.tipovehiculo as 'tipo',
    pagado
from carros
    inner join imagenescarros on carros.idCarro = imagenescarros.carro_id and tipoimagen_idtipoimagen = 1
    inner join marcas on carros.idMarca = marcas.id
    inner join modelos on carros.idModelo = modelos.idmodelos
    inner join transmisionvehiculo on carros.transmision = transmisionvehiculo.idtransmisionvehiculo
    inner join direccionvehiculo on carros.direccionVehiculo = direccionvehiculo.iddireccionVehiculo
    inner join traccionvehiculo on carros.traccion = traccionvehiculo.idtraccionvehiculo
    inner join tipovehiculo on carros.tipoVehiculo = tipovehiculo.idtipovehiculo";
        $query .= " where usuario_id = " . $_SESSION['usuario']['idusuarios'];
// </editor-fold>
        // <editor-fold defaultstate="collapsed" desc="paginacion">
        If (isset($_GET['order'])) {
            $query.=" order by " . $_GET['order'];
            if (isset($_GET['dir'])) {
                $query.=" " . $_GET['dir'];
            }
        } else {
            $query.=" order by carros.idCarro desc";
        }
        $pag->paginar($query);
        $carros = $pag->registros;
// </editor-fold>
        $variables = array(
            "carros" => $carros,
            "sesion" => $_SESSION,
            "usuario" => $_SESSION['usuario'],
            "paginado" => $pag->mostrar_paginado(),
            "paginado_lista" => $pag->mostrar_paginado_lista(),
            "dir" => (isset($_GET['dir']) ? $_GET['dir'] : "ASC")
        );
        break;
}

if (isset($_POST['accion'])) {
    switch ($_POST['accion']) {
        case "pagar":
            $data = $_POST;
            // <editor-fold defaultstate="collapsed" desc="header">
            $headers = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            $headers .= 'From: mercadomotor Daemon <info@mercadomotor.com.ve>' . "\r\n";

            // </editor-fold>
            // <editor-fold defaultstate="collapsed" desc="mensaje">
            $html = "
        <h2>Informacion de transferencia para pago de vehiculo.</h2>
        <p>id: {$data['id']}</p>
        <p>banco: {$data['banco']}</p>
        <p>voucher: {$data['voucher']}</p>
        "; // </editor-fold>

            mail("jonathanbarcelosg2@gmail.com, anyulled@gmail.com", "informacion de pago de vehiculo", $html, $headers);
            $pagina = "carros/pagar/confirmacion.html.twig";
            break;
        default:
            break;
    }
}
// <editor-fold defaultstate="collapsed" desc="twig">
echo $twig->render($pagina, $variables);
// </editor-fold>
?>
