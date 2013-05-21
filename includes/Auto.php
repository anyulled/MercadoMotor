<?php

/**
 * Clase para la gestión de autos en el portal.
 *
 * @author anyul
 */
class Auto {

    private $db;
    private $imagen;
    public $errores = array();

    public function __construct() {
        set_error_handler("Misc::error_handler");
        $this->db = new db();
    }

    public function __destruct() {
        restore_error_handler();
    }

    function ingresarAuto($data) {
        // <editor-fold defaultstate="collapsed" desc="Data">
        $datos = array();
        $datos['idMarca'] = $data['auto']['marca'];
        $datos['idModelo'] = $data['auto']['modelo'];
        $datos['anio'] = $data['auto']['fecha'];
        $datos['transmision'] = $data['auto']['transmision'];
        $datos['km'] = $data['auto']['recorrido'];
        $datos['tipoVehiculo'] = $data['auto']['tipovehiculo'];
//        $datos['modeloVehiculo'] = $data['auto']['modeloVehiculo'];
        $datos['version'] = $data['auto']['version'];
        $datos['color'] = $data['auto']['color'];
        $datos['placa'] = $data['auto']['placa'];
        $datos['motor'] = $data['auto']['motor'];
        $datos['cilindros'] = $data['auto']['cilindros'];
        $datos['traccion'] = $data['auto']['traccion'];
        $datos['vidriosAhumados'] = $data['auto']['vidrios'];
        $datos['tapizado'] = $data['auto']['tapizado'];
        $datos['airbag'] = $data['auto']['airbag'];
        $datos['frenosAbs'] = $data['auto']['frenosabs'];
        $datos['aireAcondicionado'] = $data['auto']['aireacondicionado'];
        $datos['estereo'] = $data['auto']['estereo'];
        $datos['direccionVehiculo'] = $data['auto']['direccion'];
        $datos['precioVehiculo'] = $data['auto']['precio'];
        $datos['negociable'] = $data['auto']['negociable'];
        $datos['status'] = 0;
        $datos['comentario'] = htmlentities($data['auto']['caracteristicas'], ENT_QUOTES, "UTF-8");
        $datos['usuario_id'] = $data['user']['idusuarios'];
        //// </editor-fold>

        try {
            $resultado = $this->db->insert("carros", $datos);

            $carroId = $resultado['insert_id'];
            if ($carroId > 0) {
                foreach ($data['images'] as $indice => $tempImagen) {
                    $num = substr($indice, strlen($indice) - 1, 1);
                    if ($tempImagen['error'] == 0) {
                        // <editor-fold defaultstate="collapsed" desc="mover imagen e insertar en DB">
                        $nombre_imagen = 'carro-' . $resultado['insert_id'] . "-" . $num . ".jpg";
                        // <editor-fold defaultstate="collapsed" desc="mover y redimensionar imagen">
                        $exito = $this->mover_imagen($tempImagen, $nombre_imagen);
                        if ($exito) {
                            // </editor-fold>
                            // <editor-fold defaultstate="collapsed" desc="Insertar Imagenes">
                            $this->insertar_imagen_bd($num, $nombre_imagen, $carroId);
                        }
                        // </editor-fold>
                    } elseif ($tempImagen['error'] != 4) {
                        trigger_error("Error al cargar la foto. " . var_export($tempImagen, 1), E_USER_ERROR);
                        $mensaje_error = Misc::error_carga_imagen($tempImagen['error']);
                        array_push($this->errores, "No se pudo cargar la foto " . $num . ": " . $mensaje_error);
                    }
                    $num++;
                    // </editor-fold>
                }
            } else {
                throw new Exception("No se pudo cargar el vehiculo");
            }
        } catch (Exception $exc) {
            // <editor-fold defaultstate="collapsed" desc="manejo d excepcion">
            foreach ($data['images'] as $value) {
                $filename = '../images/carros/' . basename($value['name']);
                if (is_file($filename)) {
                    unset($filename);
                }
            }
            // </editor-fold>
            $resultado['suceed'] = false;
            $resultado['errores'] = "No se pudo cargar el vehiculo";
            trigger_error("Error al registrar vehiculo:" . $exc->getMessage() . "\n" . var_export($datos, 1) . "Resultado:" . var_export($resultado, 1), E_USER_ERROR);
        }
        return $resultado;
    }

    function borrarAuto($id) {
        $result = $this->db->delete("carros", array('idCarro' => $id));
        return $result;
    }

    function actualizarAuto($data, $imagen, $id) {
        $datos = array();
        // <editor-fold defaultstate="collapsed" desc="Datos">
        $datos['idMarca'] = $data['auto']['marca'];
        $datos['idModelo'] = $data['auto']['modelo'];
        $datos['anio'] = $data['auto']['fecha'];
        $datos['transmision'] = $data['auto']['transmision'];
        $datos['km'] = $data['auto']['recorrido'];
        $datos['tipoVehiculo'] = $data['auto']['tipovehiculo'];
        $datos['version'] = $data['auto']['version'];
        $datos['color'] = $data['auto']['color'];
        $datos['placa'] = $data['auto']['placa'];
        $datos['motor'] = $data['auto']['motor'];
        $datos['cilindros'] = $data['auto']['cilindros'];
        $datos['traccion'] = $data['auto']['traccion'];
        $datos['vidriosAhumados'] = $data['auto']['vidrios'];
        $datos['tapizado'] = $data['auto']['tapizado'];
        $datos['airbag'] = $data['auto']['airbag'];
        $datos['frenosAbs'] = $data['auto']['frenosabs'];
        $datos['aireAcondicionado'] = $data['auto']['aireacondicionado'];
        $datos['estereo'] = $data['auto']['estereo'];
        $datos['direccionVehiculo'] = $data['auto']['direccion'];
        $datos['precioVehiculo'] = $data['auto']['precio'];
        $datos['negociable'] = $data['auto']['negociable'];
        $datos['comentario'] = htmlentities($data['auto']['caracteristicas']);
        $datos['vendido'] = $data['auto']['vendido'];
//        $datos['usuario_id'] = $data['user']['idusuarios'];
        //// </editor-fold>
        try {
            $result = $this->db->update("carros", $datos, array("idCarro" => $id));
            if (!$result['suceed']) {
                throw new Exception("Error de actualizacion en BD.");
            }
            foreach ($imagen as $indice => $update_imagen) {
                $num = substr($indice, strlen($indice) - 1, 1);
                //si se carga una imagen y no contiene errores

                if ($update_imagen['error'] == UPLOAD_ERR_OK) {
                    $nombre_imagen = 'carro-' . $id . "-" . $num . ".jpg";
                    $exito = $this->mover_imagen($update_imagen, $nombre_imagen);
                    if ($exito) {
                        $this->insertar_imagen_bd($num, $nombre_imagen, $id);
                    }
                } elseif ($update_imagen['error'] == UPLOAD_ERR_NO_FILE) {
                    //do nothing
                } else {
                    $mensaje_error = Misc::error_carga_imagen($update_imagen['error']);
                    trigger_error($mensaje_error . var_export($update_imagen, 1));
                }
                $num++;
            }
            return $result['suceed'];
        } catch (Exception $exc) {
            trigger_error($exc->getMessage() . var_export($result, 1), E_USER_ERROR);
            return false;
        }
    }

    function mostrarAuto() {
        
    }

    function listarAutos() {
        
    }

    /**
     * cambia el status de un auto en la bd
     * @param Integer $id el id del auto
     * @param Integer $status el estatus nuevo del registro
     * @return mixed el arreglo con los datos de la operacion 
     */
    function activarAuto($id, $status) {
        $result = $this->db->update("carros", array('status' => $status), array('idCarro' => $id));
        return $result;
    }

    function vendido($id, $status) {
        $result = $this->db->update("carros", array('vendido' => $status), array('idCarro' => $id));
        return $result;
    }

    /**
     * Elimina una imagen de un auto en la base de datos
     * @param Integer $id_imagen el id de la imagen
     * @return mixed arreglo con los resultados de la operacion 
     */
    function eliminar_imagen($id_imagen) {
        $result = $this->db->delete("imagenescarros", array("idImagenesCarros" => $id_imagen));
        return $result;
    }

    /**
     * mueve una imagen cargada de la carpeta temporal y le asigna el logo del sitio web
     * @param mixed $imagen arreglo con los datos de la imagen cargada
     * @param String $nombre_imagen el nombre deseado para la imagen
     */
    private function mover_imagen($imagen, $nombre_imagen) {
        $this->imagen = new SimpleImage();
        $exito = move_uploaded_file($imagen['tmp_name'], '../images/carros/' . $nombre_imagen);
        if ($exito) {
            $filename = '../images/carros/' . $nombre_imagen;
            $watermark = "../images/logo.gif";
            $destino = $filename;
            chmod($filename, 0744);
            $this->imagen->load($filename);
            $this->imagen->resize(533, 400);
            $this->imagen->save($filename);
            $this->imagen->merge($filename, $watermark, $destino);
        } else {
            $mensaje_error = Misc::error_carga_imagen($update_imagen['error']);
            trigger_error("No se pudo mover la imagen. " . $mensaje_error);
        }
        return $exito;
    }

    /**
     * insertar imagen de carro en la base de datos
     * @param Integer $num
     * @param String $nombre_imagen
     * @param Integer $id 
     */
    private function insertar_imagen_bd($num, $nombre_imagen, $id) {
        $datosimagen['titulo'] = "mercadomotor.com";
        $datosimagen['tipoimagen_idtipoimagen'] = ($num == 1) ? 1 : 2;
        $datosimagen['urlImagen'] = $nombre_imagen;
        $datosimagen['carro_id'] = $id;

        $result = $this->db->insert("imagenescarros", $datosimagen);
        if (!$result['suceed']) {
            trigger_error("No se pudo guardar la imagen - Detalle:" . var_export($result, 1), E_USER_ERROR);
        }
    }

    function traer_marcas_nav() {
        return $this->db->dame_query("select distinct nombre, urlImagen from marcas where id in(10, 11, 17, 18, 25, 29, 31, 42, 55)");
    }

    function ultimas_publicaciones($limit = 4) {
        $carros = $this->db->dame_query("
        select
            idCarro,
            precioVehiculo as 'precio',
            precioVehiculo,
            anio,
            marcas.nombre as 'marca',
            modelos.nombre as 'modelo',
            transmisionvehiculo.transmisionvehiculo as 'transmision', 
            imagenescarros.urlImagen as 'imagen',
            estado.Estado as 'estado',
            carros.comentario
            from carros
                inner join modelos on carros.idModelo = modelos.idmodelos
                inner join marcas on carros.idMarca = marcas.id
                inner join imagenescarros on imagenescarros.carro_id = carros.idCarro and imagenescarros.tipoimagen_idtipoimagen=1
                inner join transmisionvehiculo on carros.transmision = transmisionvehiculo.idtransmisionvehiculo
                inner join usuarios on carros.usuario_id = usuarios.idusuarios
                inner join estado on usuarios.Estado_idEstado = estado.idEstado
                where carros.status=1 and vendido=0
            order by idCarro desc limit $limit");
        shuffle($carros['data']);
        return $carros;
    }

    function listar_tipo_vehiculos() {
        return $this->db->dame_query("select * from tipovehiculo");
    }

}

?>
