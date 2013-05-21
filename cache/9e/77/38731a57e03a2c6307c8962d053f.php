<?php

/* simple.html.twig */
class __TwigTemplate_9e7738731a57e03a2c6307c8962d053f extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->blocks = array(
            'titulo' => array($this, 'block_titulo'),
            'content' => array($this, 'block_content'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<html>
    <head>
        <meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\"/>
        <title>";
        // line 4
        $this->displayBlock('titulo', $context, $blocks);
        echo "</title>
        <link href=\"";
        // line 5
        echo twig_escape_filter($this->env, constant("ROOT"), "html", null, true);
        echo "/css/my_layout.css\" rel=\"stylesheet\" type=\"text/css\" />
        <link href=\"";
        // line 6
        echo twig_escape_filter($this->env, constant("ROOT"), "html", null, true);
        echo "/css/slidedeck.skin.css\" type=\"text/css\" rel=\"stylesheet\"/>
        <script type=\"text/javascript\" src=\"";
        // line 7
        echo twig_escape_filter($this->env, constant("ROOT"), "html", null, true);
        echo "/js/lib/jquery-1.4.2.min.js\"></script>
        <script type=\"text/javascript\" src=\"";
        // line 8
        echo twig_escape_filter($this->env, constant("ROOT"), "html", null, true);
        echo "/js/lib/slidedeck.jquery.lite.js\"></script>
        <script type=\"text/javascript\" src=\"";
        // line 9
        echo twig_escape_filter($this->env, constant("ROOT"), "html", null, true);
        echo "/js/jquery.cycle.all.min.js\"></script>
        <script type=\"text/javascript\">
            \$(document).ready(function(){
                \$(\".yform\").remove();
                if(document.location.href!=top.location.href){
                    \$(\"#header\").remove();
                    \$(\".page_margins\").css({
                        margin:0,
                        \"border-radius\":0,
                        \"-moz-border-radius\":0,
                        \"-webkit-border-radius\":0
                    });
                }else{
                    \$(\"#header\").show();
                }
                \$(\"#slidedeck\").slidedeck({
                    index:false
                });
                if(\$(\"#cycle img\").length > 1){
                    \$(\"#cycle\").cycle({
                        pager:\"#thumbs\",
                        slideExpr:\"img\",
                        fit:true,
                        width:515,
                        height:386.25,
                        prev:\"#prev\",
                        next:\"#next\",
                        pause:true,
                        pauseOnPagerHover:true,
                        pagerAnchorBuilder:function(index, DOMelement){
                            var imagen = \$(\"<img/>\",
                            {
                                \"class\":\"image_thumb\",
                                src:DOMelement.src,
                                width:\"54\",
                                height:\"42\",
                                alt:index
                            });
                            return imagen;
                        }
                    });
                } else{
                    \$(\"#next, #prev\").hide();
                    \$(\"#cycle\").css({\"background-color\":\"transparent\"});
                }
            });
            </script>
        <script type=\"text/javascript\">
            var _gaq = _gaq || [];
            _gaq.push(['_setAccount', 'UA-571063-14']);
            _gaq.push(['_trackPageview']);

            (function() {
                var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
                ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
                var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
            })();
        </script>
        <style type=\"text/css\" media=\"all\">
            #col2{
                float: left;
            }
            #header{display: none;}
            .image_thumb{
                width: 54px;
                height: 42px;
                float: left;
                margin: 5px;
                border: 1px solid black;
                padding: 1px;
            }
            #prev, #next{
                background: rgba(220,220,220,0.30);
                color: rgba(10,10,10,0.5);
                font-size: 30px;
                font-weight: bold;
                z-index: 50000;
                position: absolute;
                top:50%;
                padding: 5px 10px 10px;
                text-decoration: none;
                box-shadow: 0 1px 1px rgba(0,0,0, 0.60);
            }
            #prev{
                left:0; 
                border-radius:0 5px 5px 0;
            }
            #next{
                right: 0; 
                border-radius:5px 0 0 5px;
            }
        </style>
    </head>
    <body>
        <div class=\"page_margins\">
            <div class=\"page\">
                <div id=\"header\">
                    ";
        // line 106
        $this->env->loadTemplate("misc/header.html.twig")->display($context);
        // line 107
        echo "                </div>
                <div id=\"col2\" class=\"mainCol\">
                    ";
        // line 109
        $this->displayBlock('content', $context, $blocks);
        // line 111
        echo "                </div>
                <div class=\"clearBoth\">&nbsp;</div>
                </div>
        </div>
    </body>
</html>";
    }

    // line 4
    public function block_titulo($context, array $blocks = array())
    {
        echo " ";
    }

    // line 109
    public function block_content($context, array $blocks = array())
    {
        // line 110
        echo "                    ";
    }

    public function getTemplateName()
    {
        return "simple.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }
}
