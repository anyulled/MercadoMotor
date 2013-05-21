<?php

/* misc/header.html.twig */
class __TwigTemplate_5f5c3fcf154cae602ad48758c97325b1 extends Twig_Template
{
    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<div class=\"container_12\">
    <div class=\"pro_wrapper pro_grid-row\">
        <div class=\"grid_6\">
            <a href=\"";
        // line 4
        echo twig_escape_filter($this->env, (constant("ROOT") . "/index.php"), "html", null, true);
        echo "\">
                <img src=\"";
        // line 5
        echo twig_escape_filter($this->env, ((constant("ROOT") . constant("IMAGES")) . "Logo.png"), "html", null, true);
        echo "\" alt=\"logo\" align=\"middle\"  height=\"100\"/>
            </a>
        </div>
        <div class=\"grid_6\">
        ";
        // line 9
        if ((twig_length_filter($this->env, $this->getAttribute((isset($context["sesion"]) ? $context["sesion"] : null), "usuario")) == 0)) {
            // line 10
            echo "            <form id=\"pro_log_in\" action=\"";
            echo twig_escape_filter($this->env, (constant("ROOT") . "/login.php"), "html", null, true);
            echo "\" name=\"login\" method=\"post\" >
                <input type=\"usuario\" placeholder=\"usuario\" />
                <input type=\"password\" placeholder=\"password\"/>
                <button type=\"submit\" class=\"pro_btn pro_sign-in\"><span></span>Log In</button>
                <span class=\"pro_info\"><a href=\"";
            // line 14
            echo twig_escape_filter($this->env, (constant("ROOT") . "/login.php"), "html", null, true);
            echo "\">¿Deseas registrarte?</a> </span>
            </form>
        ";
        } else {
            // line 17
            echo "            <div class=\"container\">
                <div class=\"grid_4\">
                    <h3>Bienvenido, ";
            // line 19
            echo twig_escape_filter($this->env, (($this->getAttribute((isset($context["usuario"]) ? $context["usuario"] : null), "nombre") . " ") . twig_title_string_filter($this->env, $this->getAttribute((isset($context["usuario"]) ? $context["usuario"] : null), "apellido"))), "html", null, true);
            echo "</h3>
                </div>
                <div class=\"grid_4\">
                    <p>
                        <a href=\"";
            // line 23
            echo twig_escape_filter($this->env, (constant("ROOT") . "/usuarios/"), "html", null, true);
            echo "\" title=\"Menú\" class=\"pro_btn pro_settings\"><span></span>Menú de Usuario</a>
                        <a href=\"";
            // line 24
            echo twig_escape_filter($this->env, (isset($context["self"]) ? $context["self"] : null), "html", null, true);
            echo "?logout=true\" class=\"pro_btn pro_sign-out\"><span></span>Cerrar Sesión</a>
                    </p>
                </div>
            </div>
        ";
        }
        // line 29
        echo "        </div>
    </div>
</div>";
    }

    public function getTemplateName()
    {
        return "misc/header.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }
}
