<?php

/* carros/preview.html.twig */
class __TwigTemplate_943523f45a97a467b716a50c6c022401 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->blocks = array(
            'titulo' => array($this, 'block_titulo'),
            'content' => array($this, 'block_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "simple.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
    }

    // line 2
    public function block_titulo($context, array $blocks = array())
    {
        // line 3
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, (isset($context["tituloAuto"]) ? $context["tituloAuto"] : null)), "html", null, true);
        echo "
";
    }

    // line 5
    public function block_content($context, array $blocks = array())
    {
        // line 6
        if ((twig_length_filter($this->env, (isset($context["datos_carro"]) ? $context["datos_carro"] : null)) > 0)) {
            // line 7
            echo "<div id=\"col2_content\">
    <div class=\"float_right\">";
            // line 8
            echo twig_escape_filter($this->env, ("Anuncio #" . $this->getAttribute((isset($context["datos_carro"]) ? $context["datos_carro"] : null), "idCarro")), "html", null, true);
            echo "</div>
    <h2 style=\"margin-top:3px; font-weight: bold;\">";
            // line 9
            echo twig_escape_filter($this->env, twig_title_string_filter($this->env, (isset($context["tituloAuto"]) ? $context["tituloAuto"] : null)), "html", null, true);
            echo "</h2>
    <div class=\"skin-slidedeck\">
        <dl id=\"slidedeck\" style=\"height: 400px;\" class=\"slidedeck\">
            <dt>Fotos</dt>
            <dd>
                <div id=\"cycle\" class=\"c75l\">
                    <a href=\"#\" id=\"prev\">&laquo;</a>
                    ";
            // line 16
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["datos_carro"]) ? $context["datos_carro"] : null), "images"));
            $context['_iterated'] = false;
            foreach ($context['_seq'] as $context["_key"] => $context["imagen"]) {
                // line 17
                echo "                    <img src=\"";
                echo twig_escape_filter($this->env, ((constant("ROOT") . constant("IMAGES_CARROS")) . $this->getAttribute((isset($context["imagen"]) ? $context["imagen"] : null), "urlImagen")), "html", null, true);
                echo "\"/>
                    ";
                $context['_iterated'] = true;
            }
            if (!$context['_iterated']) {
                // line 19
                echo "                    <p>No hay imágenes disponibles</p>
                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['imagen'], $context['_parent'], $context['loop']);
            $context = array_merge($_parent, array_intersect_key($context, $_parent));
            // line 21
            echo "                    <a href=\"#\" id=\"next\">&raquo;</a>
                </div>
                <div id=\"thumbs\" class=\"c25r\">
                    &nbsp;
                </div>
                <div id=\"share\" class=\"c25r\">
                    <br/>
                    <p style=\"font-weight: bold; text-align: center; white-space: nowrap;\">Comparte esta página</p>
                    <div class=\"addthis_toolbox addthis_default_style addthis_32x32_style\" style=\"padding:3px;\">
                        <a class=\"addthis_button_preferred_1\"></a>
                        <a class=\"addthis_button_preferred_3\"></a>
                        <a class=\"addthis_button_preferred_2\"></a>
                        <a class=\"addthis_button_preferred_4\"></a>
                        <a class=\"addthis_button_compact\"></a>
                        <a class=\"addthis_counter addthis_bubble_style\"></a>
                    </div>
                    <div>
                    ";
            // line 38
            if ($this->getAttribute((isset($context["datos_carro"]) ? $context["datos_carro"] : null), "vendido")) {
                // line 39
                echo "                            <img src=\"";
                echo twig_escape_filter($this->env, (constant("ROOT") . constant("IMAGES")), "html", null, true);
                echo "/vendido_big.png\" />
                    ";
            }
            // line 41
            echo "                    </div>
                    <script type=\"text/javascript\">var addthis_config = {\"data_track_clickback\":true};</script>
                    <script type=\"text/javascript\" src=\"http://s7.addthis.com/js/250/addthis_widget.js#pubid=ra-4e1b7acc2fb3ee4e\"></script>
                </div>
            </dd>
            <dt>Especificaciones</dt>
            <dd>
                <div>
                    <table class=\"full\">
                        <tbody>
                            <tr>
                                <th width=\"50%\"> Marca </th>
                                <td> ";
            // line 53
            echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->getAttribute((isset($context["datos_carro"]) ? $context["datos_carro"] : null), "marca")), "html", null, true);
            echo " </td>
                            </tr>
                            <tr>
                                <th> Modelo </th>
                                <td> ";
            // line 57
            echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->getAttribute((isset($context["datos_carro"]) ? $context["datos_carro"] : null), "modelo")), "html", null, true);
            echo " </td>
                            </tr>
                            <tr>
                                <th>Versión </th>
                                <td>";
            // line 61
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["datos_carro"]) ? $context["datos_carro"] : null), "version"), "html", null, true);
            echo " </td>
                            </tr>
                            <tr>
                                <th> Año </th>
                                <td> ";
            // line 65
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["datos_carro"]) ? $context["datos_carro"] : null), "anio"), "html", null, true);
            echo "  </td>
                            </tr>
                            <tr>
                                <th> Transmisión </th>
                                <td> ";
            // line 69
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["datos_carro"]) ? $context["datos_carro"] : null), "transmision"), "html", null, true);
            echo " </td>
                            </tr>
                            <tr>
                                <th>Kilometros</th>
                                <td>Contacte al vendedor</td>
                            </tr>
                            <tr>
                                <th>Tipo de Vehículo</th>
                                <td>";
            // line 77
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["datos_carro"]) ? $context["datos_carro"] : null), "tipo"), "html", null, true);
            echo " </td>
                            </tr>
                            <!--<tr>
                                <th>Modelo del vehículo</th>
                                <td><?php // echo \$datos_carro['modeloVehiculo'];         ?></td>
                            </tr>-->
                            <tr>
                                <th>Color</th>
                                <td>";
            // line 85
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["datos_carro"]) ? $context["datos_carro"] : null), "color"), "html", null, true);
            echo "</td>
                            </tr>
                            <!--<tr>
                                <th>Placa</th>
                                <td><?php // echo strtoupper(\$datos_carro['placa']);         ?></td>
                            </tr>-->
                            <tr>
                                <th>Motor</th>
                                <td>";
            // line 93
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["datos_carro"]) ? $context["datos_carro"] : null), "motor"), "html", null, true);
            echo "</td>
                            </tr>
                            <tr>
                                <th>Cilindros</th>
                                <td>";
            // line 97
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["datos_carro"]) ? $context["datos_carro"] : null), "cilindros"), "html", null, true);
            echo "</td>
                            </tr>
                            <tr>
                                <th> Tracción</th>
                                <td>";
            // line 101
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["datos_carro"]) ? $context["datos_carro"] : null), "traccion"), "html", null, true);
            echo "</td>
                            </tr>
                            <tr>
                                <th align=\"center\"> Precio </th>
                                <td align=\"center\">";
            // line 105
            echo twig_escape_filter($this->env, twig_number_format_filter($this->env, $this->getAttribute((isset($context["datos_carro"]) ? $context["datos_carro"] : null), "precio"), 0, ",", "."), "html", null, true);
            echo " Bsf.</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </dd>
            <dt>Extras</dt>
            <dd>
                <div>
                    <table class=\"full\">
                        <tbody>
                            <tr>
                                <th align=\"center\">Vidrios Ahumados</th>
                                <td>";
            // line 118
            echo ((($this->getAttribute((isset($context["datos_carro"]) ? $context["datos_carro"] : null), "vidriosAhumados") == 1)) ? (" Si ") : (" No "));
            echo "</td>
                            </tr>
                            <tr>
                                <th align=\"center\">Tapizado</th>
                                <td>";
            // line 122
            echo ((($this->getAttribute((isset($context["datos_carro"]) ? $context["datos_carro"] : null), "tapizado", array(), "array") == 1)) ? (" Cuero ") : (" Tela "));
            echo "</td>
                            </tr>
                            <tr>
                                <th align=\"center\">Airbag</th>
                                <td>";
            // line 126
            echo ((($this->getAttribute((isset($context["datos_carro"]) ? $context["datos_carro"] : null), "airbag") == 1)) ? (" Si ") : (" No "));
            echo "</td>
                            </tr>
                            <tr>
                                <th align=\"center\"> Frenos ABS </th>
                                <td>";
            // line 130
            echo ((($this->getAttribute((isset($context["datos_carro"]) ? $context["datos_carro"] : null), "frenosAbs") == 1)) ? (" Si ") : (" No "));
            echo "</td>
                            </tr>
                            <tr>
                                <th align=\"center\"> Aire Acondicionado </th>
                                <td>";
            // line 134
            echo ((($this->getAttribute((isset($context["datos_carro"]) ? $context["datos_carro"] : null), "aireAcondicionado") == 1)) ? (" Si ") : (" No "));
            echo "</td>
                            </tr>
                            <tr>
                                <th align=\"center\"> Sonido </th>
                                <td>";
            // line 138
            echo ((($this->getAttribute((isset($context["datos_carro"]) ? $context["datos_carro"] : null), "sonido") == 1)) ? ("Estero") : ("Normal"));
            echo "</td>
                            </tr>
                            <tr>
                                <th align=\"center\"> Blindado </th>
                                <td>";
            // line 142
            echo ((($this->getAttribute((isset($context["datos_carro"]) ? $context["datos_carro"] : null), "blindado") == 1)) ? ("Si") : ("No"));
            echo "</td>
                            </tr>
                            <tr>
                                <th align=\"center\"> Dirección </th>
                                <td>";
            // line 146
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["datos_carro"]) ? $context["datos_carro"] : null), "direccionVehiculo"), "html", null, true);
            echo "</td>
                            </tr>
                            <tr>
                                <th align=\"center\"> Negociable </th>
                                <td>";
            // line 150
            echo ((($this->getAttribute((isset($context["datos_carro"]) ? $context["datos_carro"] : null), "negociable") == 1)) ? (" Si ") : (" No "));
            echo "</td>
                            </tr>
                        </tbody>
                    </table>
                </div> 
            </dd>
            <dt>Contacta al vendedor</dt>
            <dd>
                <div>
                    <table class=\"full\">
                        <tr>
                            <th>Direcci&oacute;n</th>
                            <td>";
            // line 162
            echo twig_escape_filter($this->env, ((((twig_capitalize_string_filter($this->env, $this->getAttribute((isset($context["datos_usuario"]) ? $context["datos_usuario"] : null), "direccion")) . " - ") . twig_title_string_filter($this->env, $this->getAttribute((isset($context["datos_usuario"]) ? $context["datos_usuario"] : null), "ciudad"))) . ", ") . twig_title_string_filter($this->env, $this->getAttribute((isset($context["datos_usuario"]) ? $context["datos_usuario"] : null), "Estado"))), "html", null, true);
            echo "</td>
                        </tr>
                        <tr>
                            <th width=\"50%\"  align=\"center\">Teléfono 1</th>
                            <td align=\"center\">";
            // line 166
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["datos_usuario"]) ? $context["datos_usuario"] : null), "telefono1"), "html", null, true);
            echo "</td>
                        </tr>
                        <tr>
                            <th align=\"center\">Teléfono 2</th>
                            <td align=\"center\">";
            // line 170
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["datos_usuario"]) ? $context["datos_usuario"] : null), "telefono2"), "html", null, true);
            echo "</td>
                        </tr>

                    </table>
                </div>
            </dd>
            <dt>Informacion adicional</dt>
            <dd>
                <div class=\"info\">
                                            ";
            // line 179
            echo twig_escape_filter($this->env, twig_capitalize_string_filter($this->env, $this->getAttribute((isset($context["datos_carro"]) ? $context["datos_carro"] : null), "comentario")), "html", null, true);
            echo "
                    </div>
                    <div class=\"info\">
                        <p><b>BUSCO CARRO JMC 3000 C.A.</b> sólo se limita a la publicación y/o alojamiento de avisos clasificados en los términos contratados por el cliente aquí identificado y no será responsable por la información contenida en este aviso ya que ha sido suministrada y corroborada por el usuario contratante, ni por daños o perjuicios que pudiere sufrir el visitante por operaciones sobre anuncios publicados en el sitio.</p>
                    </div>
                </dd>
            </dl>
        </div>
</div>
";
        } else {
            // line 189
            echo "<div class=\"floatbox grande\">
    <div class=\"pro_info pro_info_pro_info\">
        <p class=\"message\">
            <img src=\"";
            // line 192
            echo twig_escape_filter($this->env, ((constant("ROOT") . constant("IMAGES")) . "error.png"), "html", null, true);
            echo "\" alt=\"error\" hspace=\"2\" align=\"top\"/>
            Hubo un error al conectar con la base de datos. Por favor intente de nuevo
        </p>
    </div>
</div>
";
        }
    }

    public function getTemplateName()
    {
        return "carros/preview.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }
}
