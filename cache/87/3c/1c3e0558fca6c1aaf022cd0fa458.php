<?php

/* autos/index.html.twig */
class __TwigTemplate_873c1c3e0558fca6c1aaf022cd0fa458 extends Twig_Template
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
        echo "Indice de autos";
    }

    // line 3
    public function block_content($context, array $blocks = array())
    {
        // line 4
        echo "<div class=\"floatbox\">
    <h1 class=\"titulo\">Autos</h1>
    <div class=\"container_12\">
        ";
        // line 7
        if ((twig_length_filter($this->env, $this->getAttribute((isset($context["marcas"]) ? $context["marcas"] : null), "data")) > 0)) {
            // line 8
            echo "            <h3>Seleccione una marca</h3>
            ";
            // line 9
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["mismarcas"]) ? $context["mismarcas"] : null), "data"));
            foreach ($context['_seq'] as $context["_key"] => $context["marca"]) {
                // line 10
                echo "            <div class=\"grid_2\">
                <div class=\"\">
                <a href=\"";
                // line 12
                echo twig_escape_filter($this->env, ((constant("ROOT") . "/autos/") . $this->getAttribute((isset($context["marca"]) ? $context["marca"] : null), "nombre")), "html", null, true);
                echo "\" title=\"";
                echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $this->getAttribute((isset($context["marca"]) ? $context["marca"] : null), "nombre")), "html", null, true);
                echo "\">
                    <center>
                        <img src=\"";
                // line 14
                echo twig_escape_filter($this->env, (((constant("ROOT") . constant("IMAGES")) . constant("LOGOS")) . $this->getAttribute((isset($context["marca"]) ? $context["marca"] : null), "urlimagen")), "html", null, true);
                echo "\" alt=\"";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["marca"]) ? $context["marca"] : null), "nombre"), "html", null, true);
                echo "\" align=\"middle\"/>
                    </center>
                    <span>";
                // line 16
                echo twig_escape_filter($this->env, ((($this->getAttribute((isset($context["marca"]) ? $context["marca"] : null), "nombre") . " (") . $this->getAttribute((isset($context["marca"]) ? $context["marca"] : null), "carros")) . ")"), "html", null, true);
                echo "</span>
                </a>
                </div>
            </div>
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['marca'], $context['_parent'], $context['loop']);
            $context = array_merge($_parent, array_intersect_key($context, $_parent));
            // line 21
            echo "        ";
        }
        // line 22
        echo "            <div class=\"clear\"></div>
        </div>
        <div class=\"hr-border-1\"></div>
        <div class=\"\">
            <h2 class=\"titulo\">Últimos Carros</h2>
                <div class=\"container_12\">
                ";
        // line 28
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["miscarros"]) ? $context["miscarros"] : null), "data"));
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
            echo "                    ";
            $this->env->loadTemplate("carros/carro.html.twig")->display($context);
            // line 30
            echo "                ";
            ++$context['loop']['index0'];
            ++$context['loop']['index'];
            $context['loop']['first'] = false;
            if (isset($context['loop']['length'])) {
                --$context['loop']['revindex0'];
                --$context['loop']['revindex'];
                $context['loop']['last'] = 0 === $context['loop']['revindex0'];
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['auto'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 31
        echo "                </div>
            </div>
        </div>
";
    }

    public function getTemplateName()
    {
        return "autos/index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }
}
