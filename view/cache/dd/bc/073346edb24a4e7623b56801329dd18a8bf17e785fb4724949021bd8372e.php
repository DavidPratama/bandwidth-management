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
\t\t<a href=\"#\" class=\"md-trigger btn big\" data-modal=\"modal-shape\">TRAFFIC SHAPING</a>
\t\t<table>
\t\t\t<thead>
\t\t\t\t<th>IP</th>
\t\t\t\t<th>DOWNLOAD LIMIT</th>
\t\t\t\t<th>UPLOAD LIMIT</th>
\t\t\t\t<th>ACTION</th>
\t\t\t</thead>
\t\t";
        // line 15
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
            // line 16
            echo "\t\t\t<tr class='danger'>
\t\t\t\t<td>";
            // line 17
            echo twig_escape_filter($this->env, $context["ip"], "html", null, true);
            echo "</td>
\t\t\t\t<td>";
            // line 18
            echo twig_escape_filter($this->env, $this->getAttribute($context["conf"], "download", array()), "html", null, true);
            echo "</td>
\t\t\t\t<td>";
            // line 19
            echo twig_escape_filter($this->env, $this->getAttribute($context["conf"], "upload", array()), "html", null, true);
            echo "</td>
\t\t\t\t<td>
\t\t\t\t\t<a href=\"#\" class='md-trigger btn small' data-modal=\"modal-";
            // line 21
            echo twig_escape_filter($this->env, $this->getAttribute($context["loop"], "index", array()), "html", null, true);
            echo "\"><i class='fa fa-pencil'></i> Edit</a>
\t\t\t\t\t<a href=";
            // line 22
            echo twig_escape_filter($this->env, ("manage/delete/" . $context["ip"]), "html", null, true);
            echo " class='btn small'><i class='fa fa-trash'></i> Delete</a>
\t\t\t\t\t<a href=\"#\" class='md-trigger btn small' data-modal=\"report-";
            // line 23
            echo twig_escape_filter($this->env, $this->getAttribute($context["loop"], "index", array()), "html", null, true);
            echo "\"><i class='fa fa-file'></i> Report</a>
\t\t\t\t</td>
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
        // line 27
        echo "\t\t</table>
\t\t<a href=\"/bwmg\" class=\"md-trigger right btn\" data-modal=\"modal-add\">SAVE</a>
\t</div>
";
    }

    // line 32
    public function block_modals($context, array $blocks = array())
    {
        // line 33
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
            // line 34
            echo "\t<div class=\"md-modal md-effect-1\" id=\"modal-";
            echo twig_escape_filter($this->env, $this->getAttribute($context["loop"], "index", array()), "html", null, true);
            echo "\">
\t\t<div class=\"md-content\">
\t\t\t<h3>EDIT RULE</h3>
\t\t\t<div>
\t\t\t\t<form action=\"manage/edit/";
            // line 38
            echo twig_escape_filter($this->env, $context["ip"], "html", null, true);
            echo "\" method=\"POST\">
\t\t\t\t<table>
\t\t\t\t\t<tr>
\t\t\t\t\t\t<td>IP / CLIENT</td>
\t\t\t\t\t\t<td><input type=\"text\" name=\"ip\" value=\"";
            // line 42
            echo twig_escape_filter($this->env, $context["ip"], "html", null, true);
            echo "\"></td>
\t\t\t\t\t</tr>
\t\t\t\t\t<tr>
\t\t\t\t\t\t<td>DOWNLOAD LIMIT</td>
\t\t\t\t\t\t<td><input type=\"text\" name=\"download\" value=\"";
            // line 46
            echo twig_escape_filter($this->env, $this->getAttribute($context["conf"], "download", array()), "html", null, true);
            echo "\"></td>
\t\t\t\t\t</tr>
\t\t\t\t\t<tr>
\t\t\t\t\t\t<td>UPLOAD LIMIT</td>
\t\t\t\t\t\t<td><input type=\"text\" name=\"upload\" value=\"";
            // line 50
            echo twig_escape_filter($this->env, $this->getAttribute($context["conf"], "upload", array()), "html", null, true);
            echo "\"></td>
\t\t\t\t\t</tr>
\t\t\t\t</table>
\t\t\t\t<div class=\"right action\">
\t\t\t\t\t<span class=\"md-close\">Cancel</span> or 
\t\t\t\t\t<input type=\"submit\" href=\"#\" class=\"md-trigger btn\" data-modal=\"modal-";
            // line 55
            echo twig_escape_filter($this->env, $this->getAttribute($context["loop"], "index", array()), "html", null, true);
            echo "\" value=\"SAVE\">
\t\t\t\t</div>
\t\t\t\t</form>
\t\t\t</div>
\t\t</div>
\t</div>

\t<div class=\"md-modal md-effect-1\" id=\"report-";
            // line 62
            echo twig_escape_filter($this->env, $this->getAttribute($context["loop"], "index", array()), "html", null, true);
            echo "\">
\t\t<div class=\"md-content\">
\t\t\t<h3>SHOW REPORT</h3>
\t\t\t<div>
\t\t\t\t<form action=\"report\" method=\"POST\">
\t\t\t\t<table>
\t\t\t\t\t<tr>
\t\t\t\t\t\t<td>MONTH</td>
\t\t\t\t\t\t<td>
\t\t\t\t\t\t\t<select name=\"month\">
\t\t\t\t\t\t\t\t<option value=\"01\">January</option>
\t\t\t\t\t\t\t\t<option value=\"02\">Febuary</option>
\t\t\t\t\t\t\t\t<option value=\"03\">March</option>
\t\t\t\t\t\t\t\t<option value=\"04\">April</option>
\t\t\t\t\t\t\t\t<option value=\"05\">May</option>
\t\t\t\t\t\t\t\t<option value=\"06\">June</option>
\t\t\t\t\t\t\t\t<option value=\"07\">July</option>
\t\t\t\t\t\t\t\t<option value=\"08\">August</option>
\t\t\t\t\t\t\t\t<option value=\"09\">September</option>
\t\t\t\t\t\t\t\t<option value=\"10\">October</option>
\t\t\t\t\t\t\t\t<option value=\"11\">November</option>
\t\t\t\t\t\t\t\t<option value=\"12\">December</option>
\t\t\t\t\t\t\t</select>
\t\t\t\t\t\t</td>
\t\t\t\t\t</tr>
\t\t\t\t</table>
\t\t\t\t<div class=\"right action\">
\t\t\t\t\t<input type=\"hidden\" name=\"ip\" value=\"";
            // line 89
            echo twig_escape_filter($this->env, $context["ip"], "html", null, true);
            echo "\">
\t\t\t\t\t<span class=\"md-close\">Cancel</span> or 
\t\t\t\t\t<input type=\"submit\" href=\"#\" class=\"md-trigger btn\" data-modal=\"report-";
            // line 91
            echo twig_escape_filter($this->env, $this->getAttribute($context["loop"], "index", array()), "html", null, true);
            echo "\" value=\"SAVE\">
\t\t\t\t</div>
\t\t\t\t</form>
\t\t\t</div>
\t\t</div>
\t</div>

\t<div class=\"md-modal md-effect-1\" id=\"modal-shape\">
\t\t<div class=\"md-content\">
\t\t\t<h3>TRAFFIC SHAPING</h3>
\t\t\t<div>
\t\t\t\t<form action=\"manage/shape\" method=\"POST\">
\t\t\t\t<table>
\t\t\t\t\t<tr>
\t\t\t\t\t\t<td>HTTP</td>
\t\t\t\t\t\t<td><input type=\"text\" name=\"http\" placeholder=\"Percentage\" value=\"";
            // line 106
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["shape"]) ? $context["shape"] : null), "http", array(), "array"), "html", null, true);
            echo "\">%</td>
\t\t\t\t\t</tr>
\t\t\t\t\t<tr>
\t\t\t\t\t\t<td>HTTPS</td>
\t\t\t\t\t\t<td><input type=\"text\" name=\"https\" placeholder=\"Percentage\" value=\"";
            // line 110
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["shape"]) ? $context["shape"] : null), "https", array(), "array"), "html", null, true);
            echo "\">%</td>
\t\t\t\t\t</tr>
\t\t\t\t\t<tr>
\t\t\t\t\t\t<td>POP3/SMTP</td>
\t\t\t\t\t\t<td><input type=\"text\" name=\"smtp\" placeholder=\"Percentage\" value=\"";
            // line 114
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["shape"]) ? $context["shape"] : null), "smtp", array(), "array"), "html", null, true);
            echo "\">%</td>
\t\t\t\t\t</tr>
\t\t\t\t\t<tr>
\t\t\t\t\t\t<td>FTP</td>
\t\t\t\t\t\t<td><input type=\"text\" name=\"ftp\" placeholder=\"Percentage\" value=\"";
            // line 118
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["shape"]) ? $context["shape"] : null), "ftp", array(), "array"), "html", null, true);
            echo "\">%</td>
\t\t\t\t\t</tr>
\t\t\t\t</table>
\t\t\t\t<div class=\"right action\">
\t\t\t\t\t<input type=\"hidden\" name=\"ip\" value=\"";
            // line 122
            echo twig_escape_filter($this->env, $context["ip"], "html", null, true);
            echo "\">
\t\t\t\t\t<span class=\"md-close\">Cancel</span> or 
\t\t\t\t\t<input type=\"submit\" href=\"#\" class=\"md-trigger btn\" data-modal=\"report-";
            // line 124
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
        return array (  265 => 124,  260 => 122,  253 => 118,  246 => 114,  239 => 110,  232 => 106,  214 => 91,  209 => 89,  179 => 62,  169 => 55,  161 => 50,  154 => 46,  147 => 42,  140 => 38,  132 => 34,  114 => 33,  111 => 32,  104 => 27,  86 => 23,  82 => 22,  78 => 21,  73 => 19,  69 => 18,  65 => 17,  62 => 16,  45 => 15,  32 => 4,  29 => 3,);
    }
}
