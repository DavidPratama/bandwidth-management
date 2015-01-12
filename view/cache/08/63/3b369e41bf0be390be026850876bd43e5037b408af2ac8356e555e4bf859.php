<?php

/* configure/setup.html */
class __TwigTemplate_08633b369e41bf0be390be026850876bd43e5037b408af2ac8356e555e4bf859 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<html>
<head>
\t<title>Bandwidth Management | Dashboard</title>
\t<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
\t<link rel=\"stylesheet\" type=\"text/css\" href=\"css/font-awesome.min.css\">
\t<link rel=\"stylesheet\" type=\"text/css\" href=\"css/skeleton.css\">
\t<link rel=\"stylesheet\" type=\"text/css\" href=\"css/normalize.css\">
\t<style type=\"text/css\">
\t\tbody{
\t\t\tbackground-color: #181818;
\t\t}

\t\t.container{
\t\t\tbackground-color: #ffffff;
\t\t\tpadding: 10px;
\t\t\ttop:30%;
\t\t}
\t</style>
</head>
<body>
\t<div class=\"container\">
\t\t<h1>Basic Configuration</h1>
\t\t<form action=\"setup/save\" method=\"post\">
\t\t<div class=\"row\">
\t\t\t<div class=\"six columns\">
\t\t\t\t<label for=\"exampleRecipientInput\">Interface Connected To Internet</label>
\t\t\t\t<select name=\"in\" class=\"u-full-width\" id=\"exampleRecipientInput\">
\t\t\t\t\t";
        // line 28
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["ifaces"]) ? $context["ifaces"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["iface"]) {
            // line 29
            echo "\t\t\t\t\t\t<option value=\"";
            echo twig_escape_filter($this->env, $context["iface"], "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, $context["iface"], "html", null, true);
            echo "</option>
\t\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['iface'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 31
        echo "\t\t\t\t</select>
\t\t\t</div>
\t\t\t<div class=\"six columns\">
\t\t\t\t<label for=\"exampleRecipientInput\">Client Interface</label>
\t\t\t\t<select name=\"out\" class=\"u-full-width\" id=\"exampleRecipientInput\">
\t\t\t\t\t";
        // line 36
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["ifaces"]) ? $context["ifaces"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["iface"]) {
            // line 37
            echo "\t\t\t\t\t\t<option value=\"";
            echo twig_escape_filter($this->env, $context["iface"], "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, $context["iface"], "html", null, true);
            echo "</option>
\t\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['iface'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 39
        echo "\t\t\t\t</select>
\t\t\t</div>
\t\t</div>
\t\t<div class=\"row\">
\t\t\t<div class=\"six columns\">
\t\t\t\t<label for=\"\">Available Download Bandwidth</label>
\t\t\t\t<input name=\"base_download\" class=\"u-full-width\" type=\"text\" placeholder=\"xxx Mb\">
\t\t\t</div>
\t\t\t<div class=\"six columns\">
\t\t\t\t<label for=\"\">Available Upload Bandwidth</label>
\t\t\t\t<input name=\"base_upload\" class=\"u-full-width\" type=\"text\" placeholder=\"xxx Mb\">
\t\t\t</div>
\t\t</div>
\t\t<br>
\t\t<input class=\"button-primary\" type=\"submit\" value=\"Save\">
\t\t</form>
\t</div>
</body>
</html>";
    }

    public function getTemplateName()
    {
        return "configure/setup.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  85 => 39,  74 => 37,  70 => 36,  63 => 31,  52 => 29,  48 => 28,  19 => 1,);
    }
}
