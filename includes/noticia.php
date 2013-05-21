<?php

/**
 * Description of noticia
 *
 * @author Anyul Rivas
 */
class noticia extends db {

    function crear($datos, $imagenes) {
        $imagen = new SimpleImage();
        $result = $this->insert("noticia", $datos);
        if ($result['suceed']) {
            foreach ($imagenes as $indice => $noticia_imagen) {
                if ($noticia_imagen['error'] == 0) {
                    $nombre_imagen = "noticia-" . $result['insert_id'] . "-" . $indice . ".jpg";
                    $exito = Misc::mover_imagen($noticia_imagen['tmp_name'], $nombre_imagen);
                    if ($exito) {
                        $resultado = $this->insert("imagen_noticia", array(
                            "url" => $nombre_imagen,
                            "noticia_id" => $result['insert_id']));
                    }
                }
            }
        } else {
            return $result;
        }
        return $result;
    }

    function editar($datos, $imagenes, $id) {
        $result = $this->update("noticia", $datos, array("id" => $id));
        if ($result['suceed']) {
            foreach ($imagenes as $indice => $noticia_imagen) {
                if ($noticia_imagen['error'] == UPLOAD_ERR_OK) {
                    $nombre_imagen = "noticia-" . $id . "-" . $indice . ".jpg";
                    $exito = Misc::mover_imagen($noticia_imagen['tmp_name'], $nombre_imagen);
                    if ($exito) {
                        $resultado = $this->insert("imagen_noticia", array(
                            "url" => $nombre_imagen,
                            "noticia_id" => $id));
                    }
                }
            }
        }
        return $result;
    }

    function eliminar($id) {
        $this->delete("imagen_noticia", array("noticia_id" => $id));
        return $this->delete("noticia", array("id" => $id));
    }

    function ver($id) {
        $dato = array();
        $noticia_temp = $this->select("*", "noticia", array("id" => $id));
        $imagen_temp = $this->select("*", "imagen_noticia", array("noticia_id" => $id));
        if (!empty($noticia_temp['data'])) {
            $dato['noticia'] = $noticia_temp['data'][0];
            $dato['imagenes'] = $imagen_temp['data'];
        }
        return $dato;
    }

    function eliminar_imagen($id) {
        return $this->delete("imagen_noticia", array("id" => $id));
    }
 function listar($limite = 3){
     return $this->dame_query("select noticia.*, (select min(url) 
         from imagen_noticia where noticia_id = noticia.id) imagen 
         from noticia where status = 1 order by id desc LIMIT $limite");
 }
}

?>
