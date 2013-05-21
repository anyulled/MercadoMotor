<?php

/* layout/base.html.twig */
class __TwigTemplate_32f587af81f049e4fa9b081f27acec1a extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->blocks = array(
            'titulo' => array($this, 'block_titulo'),
            'includes' => array($this, 'block_includes'),
            'content' => array($this, 'block_content'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<html>
<html lang=\"en\">
    <head>
        <title>";
        // line 4
        $this->displayBlock('titulo', $context, $blocks);
        echo twig_escape_filter($this->env, constant("TITULO"), "html", null, true);
        echo "</title>
        <meta http-equiv=\"Content-type\" content=\"text/html; charset=utf-8\" />
        <meta http-equiv=\"Content-language\" content=\"es\" />
        <meta http-equiv=\"X-UA-Compatible\" content=\"chrome=1\"/>
        <meta name=\"description\" content=\"MercadoMotor\">
        <meta name=\"keywords\" content=\"mercado motor\">
        <meta name=\"author\" content=\"Anyul Rivas\">
        <link rel=\"stylesheet\" href=\"";
        // line 11
        echo twig_escape_filter($this->env, constant("ROOT"), "html", null, true);
        echo "/css/style.css\">
        <link rel=\"stylesheet\" href=\"";
        // line 12
        echo twig_escape_filter($this->env, constant("ROOT"), "html", null, true);
        echo "/css/custom.css\">
        <script src=\"http://code.jquery.com/jquery-1.9.1.min.js\"></script>
        <script src=\"";
        // line 14
        echo twig_escape_filter($this->env, constant("ROOT"), "html", null, true);
        echo "/js/script.js\"></script>
        <!--[if lt IE 8]>
           <div style=' clear: both; text-align:center; position: relative;'>
             <a href=\"http://windows.microsoft.com/en-US/internet-explorer/products/ie/home?ocid=ie6_countdown_bannercode\">
               <img src=\"http://storage.ie6countdown.com/assets/100/images/banners/warning_bar_0000_us.jpg\" border=\"0\" height=\"42\" width=\"820\" alt=\"You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today.\" />
            </a>
          </div>
        <![endif]-->
        <!--[if lt IE 9]>
                <script src=\"js/html5.js\"></script>
                <link rel=\"stylesheet\" href=\"css/ie.css\"> 
        <![endif]-->
        ";
        // line 26
        $this->displayBlock('includes', $context, $blocks);
        // line 27
        echo "    </head>
    <body>
        <!-- Header -->
        <header>
            <div class=\"header-bg\" style=\"padding: 0;\">
                <div class=\"inner\">
                    ";
        // line 33
        $this->env->loadTemplate("misc/header.html.twig")->display($context);
        // line 34
        echo "                    <nav>
                    ";
        // line 35
        $this->env->loadTemplate("misc/nav.html.twig")->display($context);
        // line 36
        echo "                    </nav>
                        <div class=\"clear\"></div>
                    </div>
                </div>
            </header>
            <!-- Content -->
            <div class=\"top-content\">
                <div class=\"container_12\">
                    ";
        // line 44
        $this->env->loadTemplate("carros/marcas.html.twig")->display($context);
        // line 45
        echo "                </div>
                </div>
                <section id=\"content\">
                    <div class=\"container_12\">
                        <article class=\"a1\">
                            ";
        // line 50
        $this->env->loadTemplate("formularios/buscar_carro.html.twig")->display($context);
        // line 51
        echo "                        </article>
                        <div class=\"hr-border-1\"></div>
                        ";
        // line 53
        $this->displayBlock('content', $context, $blocks);
        // line 55
        echo "                    </div>
                </section>
                <!-- Footer -->
                <footer>
                    <div class=\"inner\">
                        <div class=\"fright\">
                            MercadoMotor &copy; ";
        // line 61
        echo twig_escape_filter($this->env, twig_date_format_filter($this->env, (isset($context["now"]) ? $context["now"] : null), "Y"), "html", null, true);
        echo " Todos los derechos reservados.
                        </div>
                    </div>
                </footer>
                <script type=\"text/javascript\">
                  var _gaq = _gaq || [];
                  _gaq.push(['_setAccount', 'pendiente']);
                  _gaq.push(['_trackPageview']);
                  (function() {
                    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
                    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
                    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
                  })();
                    </script>
                </body>
</html>";
    }

    // line 4
    public function block_titulo($context, array $blocks = array())
    {
        echo "";
    }

    // line 26
    public function block_includes($context, array $blocks = array())
    {
        echo "";
    }

    // line 53
    public function block_content($context, array $blocks = array())
    {
        // line 54
        echo "                        ";
    }

    public function getTemplateName()
    {
        return "layout/base.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }
}
