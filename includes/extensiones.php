<?php

include_once 'twig/lib/Twig/ExtensionInterface.php';
include_once 'twig/lib/Twig/Extension.php';

class extensiones extends Twig_Extension {

    public function getName() {
        return 'MiExtension';
    }

    /**
     * Genera una url para previzualizar un registro a partir de sus datos
     * @param String $marca marca del vehiculo
     * @param String $modelo modelo del vehiculo
     * @param Integer $anio año del vehiculo
     * @param Integer $id id en base de datos
     * @return String url limpia del registro
     */
    public static function url_carro($marca, $modelo, $anio, $id) {
        return PREVIEW . misc::url_carro($marca, $modelo, $anio) . "/" . $id;
    }

    /**
     * Trunca un texto a una longitud determinada sin cortar las palabras y agrega puntos suspensivos
     * @param String $input texto a truncar
     * @param Integer $length longitud
     * @return String el texto truncado 
     */
    public static function trim_text($input, $length) {
        return misc::trim_text($input, $length);
    }

    //TODO esta funcion deberia moverse a la clase misc
    /**
     * Retorna la url de la primera imagen del contenido de una noticia de un feed RSS
     * @param String $contenido el contenido html de la noticia
     * @param String $titulo el titulo de la fuente. Se utiliza para comparar y enviar una determinada imagen
     * @return string el url de la image
     */
    public static function dame_imagen_noticia($contenido, $titulo) {
        // <editor-fold defaultstate="collapsed" desc="extraer imagenes">
        $text = html_entity_decode($contenido, ENT_QUOTES, 'UTF-8');
        $pattern = "/<img[^>]+\>/Ui";
        $matches = "";
        $imagen_articulo = "";
        $link = "http://mercadomotor.com.ve/images/Logo.jpg";
        preg_match_all($pattern, $text, $matches);
        // </editor-fold>
        // <editor-fold defaultstate="collapsed" desc="extraer link de imagen">
        if (count($matches) > 0) {
            $text = $matches[0];
            if (count($text) > 0) {
                $imagen_articulo = ($titulo == "Autonews") ? $text[1] : $text[0];
                $pattern = '/src=[\'"]?([^\'" >]+)[\'" >]/';
                preg_match($pattern, $imagen_articulo, $link);
                $link = $link[1];
            }
        }
        // </editor-fold>

        return $link;
    }

    public static function url_sortable($campo, $direccion) {
        return misc::url_sortable($campo, $direccion);
    }

    public function getFunctions() {
        return array(
            'url_sortable' => new Twig_Function_Method($this, 'url_sortable'),
            'url_carro' => new Twig_Function_Method($this, 'url_carro'),
            'trim_text' => new Twig_Function_Method($this, 'trim_text'),
            'dame_imagen_noticia' => new Twig_Function_Method($this, 'dame_imagen_noticia')
        );
    }

}
?>
