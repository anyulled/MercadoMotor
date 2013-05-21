<?php

/* tarifas.html.twig */
class __TwigTemplate_8546a19d4ac779e283196214d7c9ed11 extends Twig_Template
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
        echo "Tarifas";
    }

    // line 4
    public function block_content($context, array $blocks = array())
    {
        // line 5
        echo "<div class=\"anuncio\">
    <h3>Publicación de Vehículos</h3>
    <p><b>Precio:</b> 180 Bsf</p>
    <p><b>Duración:</b> hasta que lo vendas</p>
    <p><b>Al ser activada tu publicación será vista en:</b></p>
    <ul>
        <li> Nuestra web www.mercadomotor.com.ve</li>
        <li> Nuestro facebook <a href=\"http://www.facebook.com/mercadomotor\"><img src=\"";
        // line 12
        echo twig_escape_filter($this->env, ((constant("ROOT") . constant("IMAGES")) . "facebook_logo.png"), "html", null, true);
        echo "\"/></a></li>
        <li> Nuestro Twitter <a href=\"http://www.twitter.com/mercadomotor\"><img src=\"";
        // line 13
        echo twig_escape_filter($this->env, ((constant("ROOT") . constant("IMAGES")) . "twitter_logo.jpg"), "html", null, true);
        echo "\"/></a></li>
    </ul>
    <p><b>Puedes modificar tu anuncio la veces que quieras</b></p>
    <b><a class=\"pro_btn\" class=\"publicar\" href=\"";
        // line 16
        echo twig_escape_filter($this->env, constant("ROOT"), "html", null, true);
        echo "/login.php\">Publicar</a></b>

</div>
";
    }

    public function getTemplateName()
    {
        return "tarifas.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }
}
