<?php
include_once '../includes/constants.php';
$db = new db();
$pag = new paginacion();
$pag->css_clase_lista = "pro_pages";
$pag->css_clase_anterior = "pro_btn pro_prev";
$pag->css_clase_pagina="pro_btn pro_page";
$pag->css_clase_siguiente="pro_btn pro_next";

// <editor-fold defaultstate="collapsed" desc="Query">
$query = "select
    idusuarios,
    usuarios.nombre,
    apellido,
    cedularif as 'Cedula',
    estado.Estado,
    ciudad.ciudad as 'Ciudad',
    tipousuario.nombre as 'tipousuario',
    usuarios.status
        from usuarios
            inner join tipousuario on usuarios.tipousuario = tipousuario.id
            inner join estado on estado.idEstado = usuarios.Estado_idEstado
            inner join ciudad on ciudad.idciudad = usuarios.ciudad_idciudad";
// </editor-fold>
// <editor-fold defaultstate="collapsed" desc="paginacion">
If (isset($_GET['order'])) {
    $query.=" order by " . $_GET['order'];
    if (isset($_GET['dir'])) {
        $query.=" " . $_GET['dir'];
    }
} else {
    $query.=" order by usuarios.idusuarios desc";
}
$pag->paginar($query);
$data['usuarios'] = $pag->registros;
$data['paginado_lista'] = $pag->mostrar_paginado_lista();
$data['dir'] = (isset($_GET['dir']) ? $_GET['dir'] : "ASC");
 echo $twig->render("usuarios/admin.html.twig", $data);

?>