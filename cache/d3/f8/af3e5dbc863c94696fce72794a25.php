<?php

/* carros/marcas.html.twig */
class __TwigTemplate_d3f8af3e5dbc863c94696fce72794a25 extends Twig_Template
{
    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        if ((twig_length_filter($this->env, $this->getAttribute((isset($context["marcas"]) ? $context["marcas"] : null), "data")) > 0)) {
            // line 2
            echo "<ul class=\"banners-list\">
    ";
            // line 3
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["marcas"]) ? $context["marcas"] : null), "data"));
            foreach ($context['_seq'] as $context["_key"] => $context["marca"]) {
                // line 4
                echo "        <li>
            <a title=\"";
                // line 5
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["marca"]) ? $context["marca"] : null), "nombre"), "html", null, true);
                echo "\" href=\"";
                echo twig_escape_filter($this->env, (((constant("ROOT") . "/autos/") . $this->getAttribute((isset($context["marca"]) ? $context["marca"] : null), "nombre")) . "#modelos"), "html", null, true);
                echo "\">
                <img alt=\"";
                // line 6
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["marca"]) ? $context["marca"] : null), "nombre"), "html", null, true);
                echo "\" align=\"middle\" src=\"";
                echo twig_escape_filter($this->env, (((constant("ROOT") . constant("IMAGES")) . constant("LOGOS")) . $this->getAttribute((isset($context["marca"]) ? $context["marca"] : null), "urlImagen")), "html", null, true);
                echo "\"/>
            </a>
        </li>
    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['marca'], $context['_parent'], $context['loop']);
            $context = array_merge($_parent, array_intersect_key($context, $_parent));
            // line 10
            echo "    </ul>
";
        } else {
            // line 12
            echo "    <p>No se encontraron resultados. Por favor intente nuevamente.</p>
";
        }
    }

    public function getTemplateName()
    {
        return "carros/marcas.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }
}
