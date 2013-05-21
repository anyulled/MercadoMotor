<?php

/* misc/noticias2.html.twig */
class __TwigTemplate_d08aca43a0de8e1d504f145b7c039de2 extends Twig_Template
{
    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<div class=\"floatbox\" style=\"padding-top: 10px;\" id=\"noticias\">
    <div class=\"floatbox\">
        <h1 class=\"titulo\">Noticias</h1>
    </div>
    ";
        // line 5
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["feed"]) ? $context["feed"] : null), "data"));
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
        foreach ($context['_seq'] as $context["_key"] => $context["noticia"]) {
            // line 6
            echo "        ";
            $this->env->loadTemplate("noticia/noticia-pqno.html.twig")->display($context);
            // line 7
            echo "    ";
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
            // line 8
            echo "        <div>
            <p class=\"pro_info pro_info_pro_info\"> No hay noticias publicadas</p>
        </div>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['noticia'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 12
        echo "</div>";
    }

    public function getTemplateName()
    {
        return "misc/noticias2.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }
}
