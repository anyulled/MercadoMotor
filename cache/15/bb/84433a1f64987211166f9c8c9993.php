<?php

/* busqueda.html.twig */
class __TwigTemplate_15bb84433a1f64987211166f9c8c9993 extends Twig_Template
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
        echo " Resultados de búsqueda";
    }

    // line 4
    public function block_content($context, array $blocks = array())
    {
        // line 5
        echo "<h1 class=\"titulo\"><a name=\"resultado\"></a> Resultados:</h1>
<div class=\"float-right\"> 
        <b>Ordenar por</b> 
        <span> precio:</span>
        <a href=\"";
        // line 9
        echo $this->env->getExtension('MiExtension')->url_sortable("precioVehiculo", "asc");
        echo "\"> Asc</a> |
        <a href=\"";
        // line 10
        echo $this->env->getExtension('MiExtension')->url_sortable("precioVehiculo", "desc");
        echo "\"> Desc</a>
        <span> Año:</span>
        <a href=\"";
        // line 12
        echo $this->env->getExtension('MiExtension')->url_sortable("anio", "asc");
        echo "\"> Asc</a> |
        <a href=\"";
        // line 13
        echo $this->env->getExtension('MiExtension')->url_sortable("anio", "desc");
        echo "\"> Desc</a>
        <span> Fecha de Publicación</span>
        <a href=\"";
        // line 15
        echo $this->env->getExtension('MiExtension')->url_sortable("carros.FechaCreacion", "asc");
        echo "\"> Asc</a> |
        <a href=\"";
        // line 16
        echo $this->env->getExtension('MiExtension')->url_sortable("carros.FechaCreacion", "desc");
        echo "\"> Desc</a>
    </p>
</div>
";
        // line 19
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["resultados"]) ? $context["resultados"] : null));
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
            // line 20
            echo "    ";
            $this->env->loadTemplate("carros/carro.html.twig")->display($context);
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
            // line 22
            echo "<div class=\"pro_info pro_info_pro_info\"> 
    <p class=\"message\"> 
        <img src=\"images/info.png\" alt=\"Info\" align=\"top\" hspace=\"2\"/> Mo se encontraron datos que mostrar 
        ";
            // line 25
            if (constant("DEBUG")) {
                echo " 
        <pre> ";
                // line 26
                echo twig_var_dump($this->env, $context, (isset($context["query"]) ? $context["query"] : null));
                echo " </pre> 
        ";
            }
            // line 27
            echo " 
</p> 
</div> 
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['auto'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 31
        echo "<div class=\"paginacion\"> ";
        echo (isset($context["paginacion"]) ? $context["paginacion"] : null);
        echo " </div> 
";
    }

    public function getTemplateName()
    {
        return "busqueda.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }
}
