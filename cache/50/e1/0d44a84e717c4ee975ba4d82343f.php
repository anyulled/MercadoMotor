<?php

/* autos/marca.html.twig */
class __TwigTemplate_50e10d44a84e717c4ee975ba4d82343f extends Twig_Template
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
        return "layout/base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
    }

    // line 2
    public function block_titulo($context, array $blocks = array())
    {
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, (isset($context["nombre_pagina"]) ? $context["nombre_pagina"] : null)), "html", null, true);
    }

    // line 3
    public function block_content($context, array $blocks = array())
    {
        // line 4
        if ((twig_length_filter($this->env, $this->getAttribute((isset($context["miMarca"]) ? $context["miMarca"] : null), "data")) > 0)) {
            // line 5
            echo "<div class=\"floatbox\">
    <h2 class=\"titulo\" id=\"modelos\"> ";
            // line 6
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["miMarca"]) ? $context["miMarca"] : null), "data"), 0, array(), "array"), "nombre"), "html", null, true);
            echo "</h2>
    <img class=\"img-indent-bot-1\" src=\"";
            // line 7
            echo twig_escape_filter($this->env, (((constant("ROOT") . constant("IMAGES")) . "Banners/") . $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["miMarca"]) ? $context["miMarca"] : null), "data"), 0, array(), "array"), "banner")), "html", null, true);
            echo "\" alt=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["miMarca"]) ? $context["miMarca"] : null), "data"), 0, array(), "array"), "nombre"), "html", null, true);
            echo "\"/>
</div>
";
        }
        // line 10
        echo "<div class=\"floatbox\">
    <div class=\"subcr\">
        ";
        // line 12
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["modelos"]) ? $context["modelos"] : null), "data"));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["modelo"]) {
            // line 13
            echo "        <div class=\"grid_3\">
            <a href=\"";
            // line 14
            echo twig_escape_filter($this->env, ((((constant("ROOT") . "/autos/") . twig_title_string_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["miMarca"]) ? $context["miMarca"] : null), "data"), 0, array(), "array"), "nombre"))) . "/") . twig_title_string_filter($this->env, strtr($this->getAttribute((isset($context["modelo"]) ? $context["modelo"] : null), "nombre"), " ", "-"))), "html", null, true);
            echo "#resultados\"><b>";
            echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->getAttribute((isset($context["modelo"]) ? $context["modelo"] : null), "nombre")), "html", null, true);
            echo "</b></a> &nbsp;
        </div>
        ";
            $context['_iterated'] = true;
        }
        if (!$context['_iterated']) {
            // line 17
            echo "        <div class=\"pro_info\">
            <p>No se encontraron modelos con registros para esta marca.</p>
        </div>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['modelo'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 21
        echo "            <div class=\"clear\"></div>
    </div>
</div>
<!-- Listado de Modelos -->

<!--  Listado de registros -->
<div class=\"floatbox\" id=\"resultados\">
    ";
        // line 28
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["lista"]) ? $context["lista"] : null), "data"));
        $context['_iterated'] = false;
        $context['loop'] = array(
          'parent' => $context['_parent'],
          'index0' => 0,
          'index'  => 1,
          'first'  => true,
        );
        if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof Countable)) {
            $length = count($context['_seq']);
            $context['loop']['revindex0'] = $length - 1;
            $context['loop']['revindex'] = $length;
            $context['loop']['length'] = $length;
            $context['loop']['last'] = 1 === $length;
        }
        foreach ($context['_seq'] as $context["_key"] => $context["auto"]) {
            // line 29
            echo "    ";
            $this->env->loadTemplate("carros/carro.html.twig")->display($context);
            // line 30
            echo "    ";
            $context['_iterated'] = true;
            ++$context['loop']['index0'];
            ++$context['loop']['index'];
            $context['loop']['first'] = false;
            if (isset($context['loop']['length'])) {
                --$context['loop']['revindex0'];
                --$context['loop']['revindex'];
                $context['loop']['last'] = 0 === $context['loop']['revindex0'];
            }
        }
        if (!$context['_iterated']) {
            // line 31
            echo "    <div class=\"floatbox info\">
        <p>Seleccione un modelo de esta marca.</p>
    </div>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['auto'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 35
        echo "</div>
";
    }

    public function getTemplateName()
    {
        return "autos/marca.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }
}
