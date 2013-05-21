<?php

include_once 'db.php';
include_once 'simpleimage.php';

/**
 * Manejador de publicidad
 *
 * @author anyul
 */
class publicidad {

    private $db = null;
    private $simpleImage = null;

    public function __construct() {
        set_error_handler("Misc::error_handler");
        $this->db = new db();
    }

    public function __destruct() {
        restore_error_handler();
    }

    public function registrar($data, $imagen) {
        $this->simpleImage = new SimpleImage();
        foreach ($imagen as $ad_imagen) {
            if ($ad_imagen['error'] == 0 | $ad_imagen['error'] != 4) {
                $nombre_imagen = 'ad-' . urlencode(trim($data['titulo'])) . '.jpg';
                $exito = move_uploaded_file($ad_imagen['tmp_name'], '../images/ads/' . $nombre_imagen);
                if ($exito) {
                    $data['urlImagen'] = $nombre_imagen;
                }
            }
        }
        unset($data['enviar']);
        $result = $this->db->insert("publicaciones", $data);
        if ($result['suceed']) {
            return true;
        } else {
            return $result;
        }
    }

    public function mostrar_avisos($elementos) {
        $ads = $this->db->dame_query("select idpublicaciones, urlDestino, urlImagen, vecesVisto from publicaciones where tipopublicacion <> 3 and status = 1 order by rand() limit " . $elementos);

        foreach ($ads['data'] as $updateAd) {
            $this->db->update("publicaciones", array("vecesVisto" => intval($updateAd['vecesVisto']) + 1), array("idpublicaciones" => $updateAd['idpublicaciones']));
        }

        shuffle($ads['data']);
        return $ads;
    }

    public function actualizar($data) {
        $idpublicacion = $data['idpublicaciones'];
        if (isset($data['images'])) {
            $imagen = $data['images'];
            foreach ($imagen as $ad_imagen) {
                if ($ad_imagen['error'] == 0 | $ad_imagen['error'] != 4) {
                    $nombre_imagen = 'ad-' . urlencode(trim($data['titulo'])) . '.jpg';
                    $exito = move_uploaded_file($ad_imagen['tmp_name'], '../images/ads/' . $nombre_imagen);
                    if ($exito) {
                        $data['urlImagen'] = $nombre_imagen;
                    }
                }
            }
        }
        unset($data['idpublicaciones'], $data['enviar'], $data['images']);
        $result = $this->db->update("publicaciones", $data, array('idpublicaciones' => $idpublicacion));
        return $result;
    }

    public function mostrar_banner() {
        $result = $this->db->dame_query("select * from publicaciones where tipopublicacion = 3 and status=1 order by rand() limit 1");
        if ($result['suceed'] && count($result['data']) > 0) {
            $this->db->update("publicaciones", array("vecesVisto" => intval($result['data'][0]["vecesVisto"] + 1)), array("idpublicaciones" => $result['data'][0]['idpublicaciones']));
            return $result['data'][0];
        }
    }

    public function borrar_publicidad($id) {
        return $this->db->delete("publicaciones", array("idpublicaciones" => $id));
    }

}

?>
