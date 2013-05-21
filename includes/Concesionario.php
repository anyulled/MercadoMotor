<?php
require_once 'db.php';

/**
 * Gestión de concesionarios
 *
 * @author anyul
 */
class Concesionario {

    private $db = null;

    public function __construct() {
        $this->db = new db();
    }

    public function registrar($data) {
        // <editor-fold defaultstate="collapsed" desc="Agregar concesionario">
        $exito = $this->db->insert("concesionarios", $data['concesionario']);
        // </editor-fold>
        if ($exito['suceed']) {
            // <editor-fold defaultstate="collapsed" desc="cargar y redimensionar imagen">
            $mover_exito = move_uploaded_file($imagen['logoEmpresa']['tmp_name'], '../images/concesionarios/' . basename($imagen['logoempresa']['name']));
            if ($mover_exito) {
                $filename = '../images/concesionarios/' . basename($imagen['logoempresa']['name']);
                $this->imagen->load($filename);
                $this->imagen->resize(200, 150);
                chmod($filename, 0777);
            }
            // </editor-fold>
            // <editor-fold defaultstate="collapsed" desc="Asociando Carros">
            foreach ($data['carros'] as $carro) {
                $this->db->insert("concesionarios_has_carros", array(
                    "concesionarios_idconcesionarios" => $exito['insert_id'],
                    "carros_idCarro" => $carro));
            }
        }
        // </editor-fold>
        return $exito['suceed'];
    }

    public function eliminar($id) {

    }

    public function actualizar($data, $id) {

    }

    public function asignarCarros($idConcesionario, $carros) {
        
    }

    public function ver($id) {
        $registro = array();
        // <editor-fold defaultstate="collapsed" desc="query">
        $query = "select concesionarios.*, ciudad.ciudad, estado.Estado as 'estado'
            from concesionarios
            inner join estado on estado.idEstado = concesionarios.Estado_idEstado
            inner join ciudad on ciudad.idciudad = concesionarios.ciudad_idciudad
            where concesionarios.idconcesionarios =" . $id;
        // </editor-fold>
        $registro = $this->db->dame_query($query);
        if ($registro['suceed'] && count($registro['data']) > 0) {
            // <editor-fold defaultstate="collapsed" desc="Query Carros">
            $query_carros = "select carros.*, 
                imagenescarros.urlImagen as 'imagen',
                marcas.nombre as 'marca',
                modelos.nombre as 'modelo'
                from concesionarios_has_carros chc
             inner join carros on chc.carros_idCarro = carros.idCarro
             inner join imagenescarros on imagenescarros.carro_id = carros.idCarro and imagenescarros.tipoimagen_idtipoimagen = 1
             inner join modelos on carros.idModelo = modelos.idmodelos
             inner join marcas on carros.idMarca = marcas.id
             where chc.concesionarios_idconcesionarios = " . $id;
            // </editor-fold>
            $carros = $this->db->dame_query($query_carros);
            if ($carros['suceed'] && count($carros['data']) > 0)
                $registro['data'][0]['carros'] = $carros['data'];
        }
        return $registro;
    }

}

?>