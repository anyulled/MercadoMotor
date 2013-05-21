<?php

/* carros/carro.html.twig */
class __TwigTemplate_05e39c99b91e4f523b763ba679d56bf4 extends Twig_Template
{
    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<div class=\"grid_3 carro";
        echo (($this->getAttribute((isset($context["auto"]) ? $context["auto"] : null), "vendido")) ? (" vendido") : (""));
        echo "\">
    <a class=\"pro_image_style3 pro_image_with_capt lightbox-image\" href=\"";
        // line 2
        echo twig_escape_filter($this->env, $this->env->getExtension('MiExtension')->url_carro($this->getAttribute((isset($context["auto"]) ? $context["auto"] : null), "Marca"), $this->getAttribute((isset($context["auto"]) ? $context["auto"] : null), "Modelo"), $this->getAttribute((isset($context["auto"]) ? $context["auto"] : null), "anio"), $this->getAttribute((isset($context["auto"]) ? $context["auto"] : null), "idCarro")), "html", null, true);
        echo "\">
        <img width=\"100%\" class=\"center\" alt=\"imagen auto\" src=\"";
        // line 3
        echo twig_escape_filter($this->env, ((constant("ROOT") . constant("IMAGES_CARROS")) . $this->getAttribute((isset($context["auto"]) ? $context["auto"] : null), "imagen")), "html", null, true);
        echo "\"/>
    </a>
    <div class=\"infoCarro\">
        <p>
            <b>";
        // line 7
        echo twig_escape_filter($this->env, ((twig_title_string_filter($this->env, $this->getAttribute((isset($context["auto"]) ? $context["auto"] : null), "Marca")) . " ") . twig_title_string_filter($this->env, $this->getAttribute((isset($context["auto"]) ? $context["auto"] : null), "Modelo"))), "html", null, true);
        echo "</b><br/>
            <b>Transmisión:</b> ";
        // line 8
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["auto"]) ? $context["auto"] : null), "transmision"), "html", null, true);
        echo "<br/>
            <b>Año:</b> ";
        // line 9
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["auto"]) ? $context["auto"] : null), "anio"), "html", null, true);
        echo "<br/>
            <b>Precio:</b> ";
        // line 10
        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, $this->getAttribute((isset($context["auto"]) ? $context["auto"] : null), "precioVehiculo"), 0, ",", "."), "html", null, true);
        echo " Bsf.<br/>
            <b>Estado:</b> ";
        // line 11
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["auto"]) ? $context["auto"] : null), "estado"), "html", null, true);
        echo "<br/>
        </p>
    </div>
</div>";
    }

    public function getTemplateName()
    {
        return "carros/carro.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }
}
