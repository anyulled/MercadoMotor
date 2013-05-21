<?php

// <editor-fold defaultstate="collapsed" desc="init">
include_once '../includes/constants.php';
$db = new db();
$noticia = new noticia();
$accion = isset($_REQUEST['accion']) ? $_REQUEST['accion'] : "listar";
// </editor-fold>

switch ($accion) {
    case "editar":
        // <editor-fold defaultstate="collapsed" desc="editar">
        $registro = $noticia->ver($_GET['id']);
        echo $twig->render('noticia/formulario.html.twig', array(
            "dato" => $registro['noticia'],
            "imagenes" => $registro['imagenes'],
            "accion" => $accion));
        // </editor-fold>
        break;
    case "crear":
        // <editor-fold defaultstate="collapsed" desc="crear">
        echo $twig->render('noticia/formulario.html.twig', array("dato" => array(), "accion" => $accion));
        // </editor-fold>
        break;
    case "eliminar":
        // <editor-fold defaultstate="collapsed" desc="eliminar">
        $noticia->eliminar($_GET['id']);
        paginar_noticias($twig, "Eliminar", "NOticia borrada con exito");
        break;
    // </editor-fold>
    case "guardar":
        // <editor-fold defaultstate="collapsed" desc="guardar">
        unset($_POST['accion'], $_POST['enviar']);
        foreach ($_POST as $key => $value) {
            if (strstr($key, "foto_id")) {
                unset($_POST[$key]);
            }
        }
        $_POST['texto'] = str_replace("'", "\'", $_POST['texto']);
        if (isset($_POST['id'])) {
            $resultado = $noticia->editar($_POST, $_FILES, $_POST['id']);
            $mensaje = " Noticia creada con exito";
        } else {
            $url = str_replace(" ", "-", $_POST['titulo']);
            $_POST['url'] = $url;
            $resultado = $noticia->crear($_POST, $_FILES);
            $mensaje = " Noticia modificada con exito";
        }
    // </editor-fold>
    case "listar":
    default:
        paginar_noticias($twig, "Listar", null);
        break;
}

function paginar_noticias($twig, $accion, $mensaje) {
    // <editor-fold defaultstate="collapsed" desc="listado de noticias">
    $pag = new paginacion();
    $pag->paginar("select * from noticia",20);
    $variables = array("noticias" => $pag->registros);
    $variables['accion'] = $accion;
    $variables['paginado'] = $pag->mostrar_paginado(0,0,"100%",0,1);
    if (isset($mensaje))
        $variables['mensaje'] = $mensaje;
    if (isset($resultado))
        $variables['resultado'] = $resultado;
    echo $twig->render('noticia/paginado.html.twig', $variables);
    // </editor-fold>
}

?>
