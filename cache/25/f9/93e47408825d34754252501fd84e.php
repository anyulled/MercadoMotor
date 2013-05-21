<?php

/* contacto.html.twig */
class __TwigTemplate_25f993e47408825d34754252501fd84e extends Twig_Template
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
        echo "Contacto";
    }

    // line 4
    public function block_content($context, array $blocks = array())
    {
        // line 5
        echo "    ";
        if ((isset($context["exito"]) ? $context["exito"] : null)) {
            // line 6
            echo "<div class=\"pro_info pro_info_pro_info\">
    <p class=\"message\">
        <img src=\"";
            // line 8
            echo twig_escape_filter($this->env, (constant("ROOT") . constant("IMAGES")), "html", null, true);
            echo "info.png\" alt=\"error\" hspace=\"2\" align=\"top\"/>
        Correo enviado con éxito, será contactado brevemente.
    </p>
</div>
    ";
        } else {
            // line 13
            echo "<form id=\"pro_form1\" method=\"post\" action=\"\">
    <fieldset>
        <legend>Datos personales</legend>
        <label for=\"nombre\">
            <span class=\"pro_text-form\">Nombre:<sup>*</sup></span>
            <input type=\"text\" name=\"nombre\" />
        </label>
        <label for=\"email\">
            <span class=\"pro_text-form\">Email:<sup>*</sup></span>
        <input type=\"text\" name=\"email\" />
        </label>
        <label for=\"telefono\">
            <span class=\"pro_text-form\">Teléfono:</span>
        <input type=\"text\" name=\"telefono\"/>
        </label>
        <label for=\"mensaje\">
            <span class=\"pro_text-form\">Mensaje:<sup>*</sup></span>
        <textarea name=\"mensaje\" cols=\"3\" rows=\"3\"></textarea>
        </label>
        <div class=\"pro_btns\">
            <input class=\"pro_btn\" type=\"submit\" value=\"Enviar\" name=\"submit\" />
        </div>
    </fieldset>
</form>
    ";
        }
    }

    public function getTemplateName()
    {
        return "contacto.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }
}
