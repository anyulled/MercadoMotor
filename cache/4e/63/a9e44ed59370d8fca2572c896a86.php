<?php

/* quienes_somos.html.twig */
class __TwigTemplate_4e63a9e44ed59370d8fca2572c896a86 extends Twig_Template
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
        echo "Quienes Somos";
    }

    // line 4
    public function block_content($context, array $blocks = array())
    {
        // line 5
        echo "<div>
    <h1>Reseña Institucional</h1>
    <img src=\"";
        // line 7
        echo twig_escape_filter($this->env, ((constant("ROOT") . constant("IMAGES")) . "imagen248g.jpg"), "html", null, true);
        echo "\" class=\"img-indent-1\" />
    <p>
        <b>mercadomotor.com.ve</b>, es una página que ha sido fundada en Febrero del 2011 de la empresa <b>BUSCO CARRO JMC 3000 C.A</b>, somos creadores de la página Web mercadomotor.com.ve. Para lograr su popularidad, comenzó una búsqueda de potenciales clientes en el mes de Diciembre de 2010 en donde realizó sus primeras apariciones en las redes sociales principalmente en Facebook, Twitter y YouTube. Es una labor que requiere de una cierta estructura y planificación.
    </p>
    <p>mercadomotor.com.ve es una página Web de Venezuela específicamente en el área de Caracas, ofrecemos servicios para publicaciones relacionadas con el sector automotriz. Trabajamos como plataforma de comercio electrónico, en donde se realiza la compra y venta de automóviles nuevos y usados, clasificados hasta cinco fotos por vehículo, anuncios  de concesionarios de vehículos nuevos y usados, anuncios de Talleres o de locales relacionados con servicios para vehículos.
    </p>
    <p>Facilitando la búsqueda de potenciales clientes la empresa comienza en  el mes de Diciembre de 2010 a realizar sus primeras apariciones en las redes sociales de Facebook con el grupo llamado <a href=\"http://www.facebook.com/mercadomotor\" target=\"_blank\">“mercadomotor Venezuela”</a> y en Twitter con la cuenta <a href=\"http://www.twitter.com/mercadomotor\">@mercadomotor</a>. mercadomotor.com.ve, es un sitio web para la venta de vehículos mediante la publicación de avisos con fotos, con servicio de fotografía a domicilio y publicación por tiempo ilimitado.
    </p>
    <p>Nos dedicamos al manejo de redes sociales, comunicación del cliente, plataforma publicitaria, de forma profesional y con un notable éxito. Estamos perfectamente cualificados y formados en las disciplinas, lo que garantiza la calidad de nuestro trabajo.
    </p>
    <h2>Misión</h2>
    <p>Conectar compradores y vendedores mediante avisos foto clasificados para lograr la negociación satisfactoria de sus vehículos. La venta directa de productos y servicios, así como la promoción, desarrollo y comercialización de espacios publicitarios mediante avisos clasificados; Ofrecer al cliente servicios de excelente calidad.</p>
    <h2>Visión</h2>
    <p>Ser reconocido como una de las mejores plataformas comerciales Latinoamericanas y establecer sucursales en otras ciudades del país, así como en el  exterior”.</p>
    <h2>Valores</h2>
    <ul>
        <li  style=\"list-style: circle\">Excelencia</li> 
        <li style=\"list-style: circle\">Compromiso</li>
        <li style=\"list-style: circle\">Honestidad</li> 
        <li style=\"list-style: circle\">Innovación</li>
        <li style=\"list-style: circle\">Trabajo en Equipo</li>
        <li style=\"list-style: circle\">Vocación de Servicio”. </li>
    </ul>
    <h2>Lema</h2>
    <p><i>\"Tu guía Automotriz\".</i></p>

</div>
";
    }

    public function getTemplateName()
    {
        return "quienes_somos.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }
}
