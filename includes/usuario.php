<?php

include_once 'db.php';
include_once 'Auto.php';

/**
 * Description of usuario
 *
 * @author anyul
 */
class usuario {

    public $nombre = '';
    public $apellido = '';
    public $login;
    private $db = null;

    public function __construct() {
        set_error_handler("Misc::error_handler");
        $this->db = new db();
    }

    public function __destruct() {
        restore_error_handler();
    }

    public function crearUsuario($data) {
        $resultado = $this->db->insert('usuarios', array(
            'nombre' => $data['nombre'],
            'apellido' => $data['apellido'],
            'cedularif' => $data['numeroid'],
            'telefono1' => $data['telefono'],
            'telefono2' => $data['telefono2'],
            'Estado_idEstado' => $data['estado'],
            'ciudad_idciudad' => $data['ciudad'],
            'direccion' => $data['direccion'],
            'login' => htmlentities($data['usuario']),
            'status' => 1,
            'password' => $data['password']));
        if ($resultado['suceed'] == 'true') {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function editarUsuario($params, $condicion) {
        $result = $this->db->update('usuarios', $params, $condicion);
        if ($result['suceed'] == 'true') {
            return true;
        } else {
            return false;
        }
    }

    public function eliminarUsuario($id) {
        $result = $this->db->delete('usuarios', array('idusuarios' => $id));
        return $result;
    }

    /**
     * funcion que retorna una matriz de datos de un usuario determinado
     * @param int $id id del usuario
     * @return array arreglo de datos
     */
    public function mostrarUsuario($id) {
        $result = $this->db->select('*', 'usuarios', array('id' => $id));
        if ($result['suceed'] == 'true') {
            return $result['data'];
        } else {
            return array('data' => array('nombre' => 'n/a'));
        }
    }

    /**
     * funcion que retorna un arreglo de usuarios
     * @return Array
     */
    public function listarUsuarios() {
        $usuarios = $this->db->select('*', 'usuarios');
        if ($usuarios['suceed'] == 'true') {
            return $usuarios['data'];
        } else {
            return array('data' => array('nombre' => 'n/a'));
        }
    }

    public function login($usuario, $password) {
        try {
            $result = $this->db->select('*', 'usuarios', array('login' => $usuario, 'password' => $password, 'status' => 1));
            if ($result['suceed'] == 'true' && count($result['data']) > 0) {
                session_start();
                $_SESSION['usuario'] = $result['data'][0];
                $_SESSION['status'] = 'logueado';
                header("location: usuarios/");
                return $result['suceed'];
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public function confirmar_miembro() {
        session_start();
        if (!isset($_SESSION['status']) || $_SESSION['status'] != 'logueado' || !isset($_SESSION['usuario'])) {
            $this->log_Out();
        }
    }

    /**
     * Cerrar sesion del sistema
     */
    public function log_Out() {
        $_SESSION = array();
        session_destroy();
        header("location: " . ROOT . "/login.php");
    }

}

?>