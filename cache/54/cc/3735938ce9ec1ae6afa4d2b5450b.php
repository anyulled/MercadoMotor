<?php

/* formularios/buscar_carro.html.twig */
class __TwigTemplate_54cc3735938ce9ec1ae6afa4d2b5450b extends Twig_Template
{
    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        $context["ayer"] = (twig_date_format_filter($this->env, "now", "Y") - 100);
        // line 2
        echo "<div class=\"pro_tabs-horz-top\" id='tabs'>
    <ul class=\"pro_tabs-nav\">
        <li><a href=\"#tabs-1\">Carros Usados</a></li>
    </ul>
    <div id=\"tabs-1\" class=\"pro_tab-content\">
        <form id=\"pro_form1\" action=\"";
        // line 7
        echo twig_escape_filter($this->env, (constant("ROOT") . "/busqueda.php#resultados"), "html", null, true);
        echo "\" name=\"busqueda\" method=\"get\">
            <div class=\"container_12\">
                <div class=\"grid_4\">
                    <label for=\"marcas\">
                        <span class=\"pro_text-form\">Marca</span>
                        <select name=\"idMarca\" id=\"marcas\">
                            <option value=\"\">--</option>
                        </select>
                    </label>
                    <label for=\"fecha_min\">
                        <span class=\"pro_text-form\">Año</span>
                        <select name=\"anio_min\" id=\"fecha_min\" class=\"min\">
                            <option value=\"\"> -- </option>
                            ";
        // line 20
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable(range(twig_date_format_filter($this->env, "now", "Y"), (isset($context["ayer"]) ? $context["ayer"] : null)));
        foreach ($context['_seq'] as $context["_key"] => $context["fecha"]) {
            // line 21
            echo "                            <option>";
            echo twig_escape_filter($this->env, (isset($context["fecha"]) ? $context["fecha"] : null), "html", null, true);
            echo "</option>
                            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['fecha'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 23
        echo "                        </select>
                        a
                        <select name=\"anio_max\" id=\"fecha_max\" class=\"min\">
                            <option value=\"\"> -- </option>
                            ";
        // line 27
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable(range(twig_date_format_filter($this->env, "now", "Y"), (isset($context["ayer"]) ? $context["ayer"] : null)));
        foreach ($context['_seq'] as $context["_key"] => $context["fecha"]) {
            // line 28
            echo "                            <option>";
            echo twig_escape_filter($this->env, (isset($context["fecha"]) ? $context["fecha"] : null), "html", null, true);
            echo "</option>
                            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['fecha'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 30
        echo "                        </select>
                    </label>
                </div>
                <div class=\"grid_4\">
                    <label for=\"modelos\">
                        <span class=\"pro_text-form\">Modelo</span>
                        <select name=\"idModelo\" id=\"modelos\">
                            <option value=\"\">--</option>
                        </select>
                    </label>
                    <label for=\"precio\">
                        <span class=\"pro_text-form\">Precio</span>
                        <input class=\"digits min\" id=\"precio_min\" type=\"text\" name=\"preciomin\" value=\"\" maxlength=\"10\" size=\"10\"/>
                        <span> a </span>
                        <input class=\"digits min\" id=\"precio_max\" type=\"text\" name=\"preciomax\" value=\"\" maxlength=\"10\" size=\"10\"/>
                    </label>
                </div>
                <div class=\"grid_4\">
                    <label for=\"estado\">
                        <span class=\"pro_text-form\">Estado</span>
                        <select name=\"estado\" id=\"estado\">
                            <option value=\"null\">--</option>
                        </select>
                    </label>
                    <label for=\"tipo_vehiculo\">
                        <span class=\"pro_text-form\">Tipo</span>
                        <select name=\"tipo_vehiculo\" id=\"tipo_vehiculo\" class=\"required\">
                        ";
        // line 57
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["tipoVehiculo"]) ? $context["tipoVehiculo"] : null), "data"));
        foreach ($context['_seq'] as $context["_key"] => $context["tipo"]) {
            // line 58
            echo "                                <option value=\"";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["tipo"]) ? $context["tipo"] : null), "idtipovehiculo"), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["tipo"]) ? $context["tipo"] : null), "tipovehiculo"), "html", null, true);
            echo "</option>
                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['tipo'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 60
        echo "                            </select>
                        </label>
                    </div>
            </div>
            <div class=\"container_12\">
                <div class=\"grid_12 pro_btns\">
                    <input class=\"pro_btn pro_inf\" id=\"buscar_carro\" type=\"submit\" name=\"submit\" value=\"buscar\"/>
                </div>
            </div>
        </form>
            <div class=\"clear\"></div>
    </div>
</div>";
    }

    public function getTemplateName()
    {
        return "formularios/buscar_carro.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }
}
