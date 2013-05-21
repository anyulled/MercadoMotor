<?php

/* login.html.twig */
class __TwigTemplate_3243be2b0e7ee7c168d6ea00b890d67d extends Twig_Template
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
        echo "Iniciar Sesión";
    }

    // line 3
    public function block_content($context, array $blocks = array())
    {
        // line 4
        echo "    ";
        if ((isset($context["ingresar"]) ? $context["ingresar"] : null)) {
            // line 5
            echo "<div class=\"container_12\">
    <div class=\"grid_6\">
        <form id=\"pro_form2\" class=\"\" action=\"registrar.php\" style=\"border-radius:10px;\">
            <fieldset>
                <legend>Nuevo Cliente</legend>
                <div>
                    <h3>Soy un nuevo cliente</h3>
                    <br/>
                    <p>Al crear una cuentra en <b>mercadomotor.com</b> usted acepta los términos y condiciones de este sitio.</p>
                </div>
                <div class=\"type-button\">
                    <input class=\"pro_btn\" type=\"submit\" value=\"Continuar\"/>
                </div>
            </fieldset>
        </form>
    </div>
    <div class=\"grid_6\">
        <form id=\"pro_form1\" action=\"login.php\" method=\"post\"  style=\"border-radius:10px;\">
            <fieldset>
                <legend>Ya soy cliente</legend>
                <div class=\"type-text\">
                    <label for=\"usuario\">
                        <span class=\"pro_text-form\">Usuario:</span>
                        <input type=\"text\" name=\"usuario\"/>
                    </label>
                </div>
                <div class=\"type-text\">
                    <label for=\"password\">
                        <span class=\"pro_text-form\">Password:</span>
                        <input type=\"password\" name=\"password\"/>
                    </label>
                </div>
                <div>
                    <a href=\"recuperarPassword.php\" class=\"pro_btn\">¿Olvidó su contraseña?</a>
                </div>
                <div class=\"type-button\">
                    <input class=\"pro_btn\" type=\"submit\" name=\"ingresar\" value=\"Ingresar\"/>
                </div>
            </fieldset>
        </form>
    </div>
</div>
    ";
        } else {
            // line 48
            echo "<div> <b>Post</b> </div>
<form id=\"pro_form1\" method=\"post\" action=\"\" class=\"yform\">
    <div class=\"error\">
        <label>Error</label>
        <p class=\"pro_info\">Usuario y/o contraseña inválida</p>
    </div>
    <fieldset>
        <legend>Iniciar Sesión</legend>
        <div class=\"type-text\">
            <label for=\"usuario\">Usuario:</label>
            <input type=\"text\" name=\"usuario\"/>
        </div>
        <div class=\"type-text\">
            <label for=\"password\">
                <span class=\"pro_text-form\">Password:</span>
                <input type=\"password\" name=\"password\"/>
            </label>
        </div>
        <div>
            <a class=\"pro_btn\" href=\"recuperarPassword.php\">¿Olvidó su contraseña?</a>
        </div>
        <div class=\"type-button\">
            <input class=\"pro_btn\" type=\"submit\" name=\"ingresar\" value=\"Ingresar\"/>
        </div>
    </fieldset>
</form>
    ";
        }
    }

    public function getTemplateName()
    {
        return "login.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }
}
