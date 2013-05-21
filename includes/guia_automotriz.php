<?php

include_once 'class.krumo.php';
include_once 'db.php';
include_once 'simpleimage.php';

/**
 * Gestión de guías automotrices para el portal mercadomotor.com.ve
 *
 * @author anyul
 */
class guia_automotriz {

    private $db;
    private $imagen;

    public function __construct() {
        set_error_handler("Misc::error_handler");
        $this->db = new db();
        $this->imagen = new SimpleImage();
    }

    public function registrarGuia($data, $imagen, $servicios, $marcas) {
        try {
            $result = array();
            $data['logoempresa']=$imagen['logoempresa']['name'];
            // <editor-fold defaultstate="collapsed" desc="Registrar guía">
            $result = $this->db->insert("local", $data);
            if(!$result['suceed']){
                throw new Exception("No se pudo registrar la guía");
            }
            //// </editor-fold>
            // <editor-fold defaultstate="collapsed" desc="Registrar marcas">
            if ($result['suceed'] == true && $result['insert_id'] != 0) {
                foreach ($marcas as $marca) {
                    $this->db->insert(
                            "local_has_marcas",
                            array(
                                "idlocal" => $result['insert_id'],
                                "idmarca" => $marca)
                    );
                }
            }
            //// </editor-fold>
            // <editor-fold defaultstate="collapsed" desc="Registrar servicios">
            if ($result['suceed'] == true && $result['insert_id'] != 0) {
                foreach ($servicios as $servicio) {
                    $this->db->insert("local_has_servicio", array(
                        "idlocal" => $result['insert_id'],
                        "idservicio" => $servicio['id']
                    ));
                }
            }
            //// </editor-fold>
            // <editor-fold defaultstate="collapsed" desc="Copiar y redimensionar imagenes">
            $exito = move_uploaded_file($imagen['logoempresa']['tmp_name'], '../images/locales/' . basename($imagen['logoempresa']['name']));
            if ($exito) {
                $filename = '../images/locales/' . basename($imagen['logoempresa']['name']);
                $this->imagen->load($filename);
                $this->imagen->resize(200, 150);
                chmod($filename, 0777);
            }
            //// </editor-fold>
        } catch (Exception $exc) {
            echo "No se pudo registrar la guía";
            print_r($result);
            echo $exc->getTraceAsString();
        }
        if ($result['suceed']) {
            return true;
        } else {
            return $result;
        }
    }

    public function actualizarGuia($data, $id) {
        $result = $this->db->update("local", $data, array("idlocal" => $id));
        if ($result['suceed']) {
            return true;
        } else {
            return false;
        }
    }

    public function eliminarGuia($id) {
        $result = $this->db->delete("local", Array("idlocal" => $id));
        if ($result['suceed']) {
            return true;
        } else {
            return false;
        }
    }

    public function  __destruct() {
        restore_error_handler();
    }
}

?>