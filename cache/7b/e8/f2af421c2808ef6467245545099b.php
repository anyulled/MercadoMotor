<?php

/* misc/teaser2.html.twig */
class __TwigTemplate_7be8f2af421c2808ef6467245545099b extends Twig_Template
{
    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<div id=\"tabs-carros\" class=\"pro_tabs-horz-top\" >
    <ul class=\"pro_tabs-nav\">
        <li><a href=\"#carros-1\"><strong>Ultimas Publicaciones</strong></a></li>
    </ul>
    <div class=\"pro_tab-content\" id=\"carros-1\">
        <div class=\"container_12\">
        ";
        // line 7
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["autosTeaser"]) ? $context["autosTeaser"] : null), "data"));
        foreach ($context['_seq'] as $context["_key"] => $context["registro"]) {
            // line 8
            echo "            <div class=\"grid_3\">
                <div class=\"pro_wrapper pro_pad_port\">
                    <a class=\"pro_image_style3\" href=\"";
            // line 10
            echo twig_escape_filter($this->env, $this->env->getExtension('MiExtension')->url_carro($this->getAttribute((isset($context["registro"]) ? $context["registro"] : null), "marca"), $this->getAttribute((isset($context["registro"]) ? $context["registro"] : null), "modelo"), $this->getAttribute((isset($context["registro"]) ? $context["registro"] : null), "anio"), $this->getAttribute((isset($context["registro"]) ? $context["registro"] : null), "idCarro")), "html", null, true);
            echo "\">
                        <img src=\"";
            // line 11
            echo twig_escape_filter($this->env, ((constant("ROOT") . constant("IMAGES_CARROS")) . $this->getAttribute((isset($context["registro"]) ? $context["registro"] : null), "imagen")), "html", null, true);
            echo "\" width=\"100%\"/>
                    </a>
                    <p>
                        <h3>
                            <a class=\"fancybox\" href=\"";
            // line 15
            echo twig_escape_filter($this->env, $this->env->getExtension('MiExtension')->url_carro($this->getAttribute((isset($context["registro"]) ? $context["registro"] : null), "marca"), $this->getAttribute((isset($context["registro"]) ? $context["registro"] : null), "modelo"), $this->getAttribute((isset($context["registro"]) ? $context["registro"] : null), "anio"), $this->getAttribute((isset($context["registro"]) ? $context["registro"] : null), "idCarro")), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, ((((twig_title_string_filter($this->env, $this->getAttribute((isset($context["registro"]) ? $context["registro"] : null), "marca")) . " ") . twig_title_string_filter($this->env, $this->getAttribute((isset($context["registro"]) ? $context["registro"] : null), "modelo"))) . " ") . $this->getAttribute((isset($context["registro"]) ? $context["registro"] : null), "anio")), "html", null, true);
            echo "</a>
                        </h3>
                        <span><b>";
            // line 17
            echo twig_escape_filter($this->env, twig_number_format_filter($this->env, $this->getAttribute((isset($context["registro"]) ? $context["registro"] : null), "precio"), 0, ",", "."), "html", null, true);
            echo " Bsf.</b></span>
                    </p>
                </div>
            </div>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['registro'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 22
        echo "            </div>
            <div class=\"clear\">&nbsp;</div>
        </div>
    </div>";
    }

    public function getTemplateName()
    {
        return "misc/teaser2.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }
}
