<?php

/* manage/index.html */
class __TwigTemplate_ddbc073346edb24a4e7623b56801329dd18a8bf17e785fb4724949021bd8372e extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("manage/layout.html");

        $this->blocks = array(
            'content' => array($this, 'block_content'),
            'modals' => array($this, 'block_modals'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "manage/layout.html";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_content($context, array $blocks = array())
    {
        // line 4
        echo "\t<div class=\"container\">
\t\t<h1 class=\"title\">BANWIDTH RULES</h1>
\t\t<a href=\"#\" class=\"md-trigger btn big\" data-modal=\"modal-add\">ADD RULE</a>
\t\t<table>
\t\t";
        // line 8
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["data"]) ? $context["data"] : null));
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
        foreach ($context['_seq'] as $context["ip"] => $context["conf"]) {
            // line 9
            echo "\t\t\t<tr class='danger'>
\t\t\t\t<td>";
            // line 10
            echo twig_escape_filter($this->env, $context["ip"], "html", null, true);
            echo "</td>
\t\t\t\t<td>";
            // line 11
            echo twig_escape_filter($this->env, $this->getAttribute($context["conf"], "download", array()), "html", null, true);
            echo "</td>
\t\t\t\t<td>";
            // line 12
            echo twig_escape_filter($this->env, $this->getAttribute($context["conf"], "upload", array()), "html", null, true);
            echo "</td>
\t\t\t\t<td><a href=\"#\" class='md-trigger btn small' data-modal=\"modal-";
            // line 13
            echo twig_escape_filter($this->env, $this->getAttribute($context["loop"], "index", array()), "html", null, true);
            echo "\"><i class='fa fa-pencil'></i> Edit</a><a href=";
            echo twig_escape_filter($this->env, ("manage/delete/" . $context["ip"]), "html", null, true);
            echo " class='btn small'><i class='fa fa-trash'></i> Delete</a></td>
\t\t\t</tr>
\t\t";
            ++$context['loop']['index0'];
            ++$context['loop']['index'];
            $context['loop']['first'] = false;
            if (isset($context['loop']['length'])) {
                --$context['loop']['revindex0'];
                --$context['loop']['revindex'];
                $context['loop']['last'] = 0 === $context['loop']['revindex0'];
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['ip'], $context['conf'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 16
        echo "\t\t</table>
\t</div>
";
    }

    // line 20
    public function block_modals($context, array $blocks = array())
    {
        // line 21
        echo "\t";
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["data"]) ? $context["data"] : null));
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
        foreach ($context['_seq'] as $context["ip"] => $context["conf"]) {
            // line 22
            echo "\t<div class=\"md-modal md-effect-1\" id=\"modal-";
            echo twig_escape_filter($this->env, $this->getAttribute($context["loop"], "index", array()), "html", null, true);
            echo "\">
\t\t<div class=\"md-content\">
\t\t\t<h3>ADD RULE</h3>
\t\t\t<div>
\t\t\t\t<form action=\"manage/edit/";
            // line 26
            echo twig_escape_filter($this->env, $context["ip"], "html", null, true);
            echo "\" method=\"POST\">
\t\t\t\t<table>
\t\t\t\t\t<tr>
\t\t\t\t\t\t<td>IP / CLIENT</td>
\t\t\t\t\t\t<td><input type=\"text\" name=\"ip\" value=\"";
            // line 30
            echo twig_escape_filter($this->env, $context["ip"], "html", null, true);
            echo "\"></td>
\t\t\t\t\t</tr>
\t\t\t\t\t<tr>
\t\t\t\t\t\t<td>DOWNLOAD LIMIT</td>
\t\t\t\t\t\t<td><input type=\"text\" name=\"download\" value=\"";
            // line 34
            echo twig_escape_filter($this->env, $this->getAttribute($context["conf"], "download", array()), "html", null, true);
            echo "\"></td>
\t\t\t\t\t</tr>
\t\t\t\t\t<tr>
\t\t\t\t\t\t<td>UPLOAD LIMIT</td>
\t\t\t\t\t\t<td><input type=\"text\" name=\"upload\" value=\"";
            // line 38
            echo twig_escape_filter($this->env, $this->getAttribute($context["conf"], "upload", array()), "html", null, true);
            echo "\"></td>
\t\t\t\t\t</tr>
\t\t\t\t</table>
\t\t\t\t<div class=\"right action\">
\t\t\t\t\t<span class=\"md-close\">Cancel</span> or 
\t\t\t\t\t<input type=\"submit\" href=\"#\" class=\"md-trigger btn\" data-modal=\"modal-";
            // line 43
            echo twig_escape_filter($this->env, $this->getAttribute($context["loop"], "index", array()), "html", null, true);
            echo "\" value=\"SAVE\">
\t\t\t\t</div>
\t\t\t\t</form>
\t\t\t</div>
\t\t</div>
\t</div>
\t";
            ++$context['loop']['index0'];
            ++$context['loop']['index'];
            $context['loop']['first'] = false;
            if (isset($context['loop']['length'])) {
                --$context['loop']['revindex0'];
                --$context['loop']['revindex'];
                $context['loop']['last'] = 0 === $context['loop']['revindex0'];
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['ip'], $context['conf'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
    }

    public function getTemplateName()
    {
        return "manage/index.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  153 => 43,  145 => 38,  138 => 34,  131 => 30,  124 => 26,  116 => 22,  98 => 21,  95 => 20,  89 => 16,  70 => 13,  66 => 12,  62 => 11,  58 => 10,  55 => 9,  38 => 8,  32 => 4,  29 => 3,);
    }
}
