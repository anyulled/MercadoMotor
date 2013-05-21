<?php

/* misc/nav.html.twig */
class __TwigTemplate_568a33527922b374bf09ca0b1c9db029 extends Twig_Template
{
    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<ul class=\"sf-menu\">
    <li class=\"current\" ><a href=\"";
        // line 2
        echo twig_escape_filter($this->env, constant("ROOT"), "html", null, true);
        echo "/index.php\">Inicio</a></li>
    <li><a href=\"";
        // line 3
        echo twig_escape_filter($this->env, constant("ROOT"), "html", null, true);
        echo "/carros/\">Carros</a></li>
    <!--<li><a href=\"";
        // line 4
        echo twig_escape_filter($this->env, constant("ROOT"), "html", null, true);
        echo "/noticias\">Noticias</a></li>
    <li><a href=\"";
        // line 5
        echo twig_escape_filter($this->env, constant("ROOT"), "html", null, true);
        echo "/guia_automotriz/\">Guía Automotriz</a></li>
    <li><a href=\"";
        // line 6
        echo twig_escape_filter($this->env, constant("ROOT"), "html", null, true);
        echo "/concesionarios/\">Concesionarios</a></li>-->
    <li><a href=\"";
        // line 7
        echo twig_escape_filter($this->env, constant("ROOT"), "html", null, true);
        echo "/quienes_somos.php#col2_content\">Quienes Somos</a></li>
    <li><a href=\"";
        // line 8
        echo twig_escape_filter($this->env, constant("ROOT"), "html", null, true);
        echo "/login.php\">Registra tu anuncio</a></li>
    <li><a href=\"";
        // line 9
        echo twig_escape_filter($this->env, constant("ROOT"), "html", null, true);
        echo "/tarifas.php#col2_content\">Tarifas</a></li>
    <li><a href=\"";
        // line 10
        echo twig_escape_filter($this->env, constant("ROOT"), "html", null, true);
        echo "/contacto.php#col2_content\">Contacto</a></li>
</ul>";
    }

    public function getTemplateName()
    {
        return "misc/nav.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }
}
