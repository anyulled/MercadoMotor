<?php

/* index.html.twig */
class __TwigTemplate_704adfc852ad4632791df663438052b4 extends Twig_Template
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
        echo "Inicio";
    }

    // line 4
    public function block_content($context, array $blocks = array())
    {
        // line 5
        $this->env->loadTemplate("misc/teaser2.html.twig")->display($context);
        // line 6
        $this->env->loadTemplate("misc/noticias2.html.twig")->display($context);
    }

    public function getTemplateName()
    {
        return "index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }
}
