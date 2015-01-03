<?php

/* manage/layout.html */
class __TwigTemplate_f6ec85c90a6bf7154a00e8e39409fbcc34f6c30db4d9b9907a3283343dcc684a extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'modals' => array($this, 'block_modals'),
            'content' => array($this, 'block_content'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<html>
<head>
\t<title>Manage Bandwidth</title>
\t<link rel=\"stylesheet\" type=\"text/css\" href=\"css/style.css\">
\t<link rel=\"stylesheet\" type=\"text/css\" href=\"css/font-awesome.min.css\">
\t<link rel=\"stylesheet\" type=\"text/css\" href=\"css/default.css\" />
\t<link rel=\"stylesheet\" type=\"text/css\" href=\"css/component.css\" />
\t<script src=\"js/modernizr.custom.js\"></script>
</head>
<body>
\t<div class=\"md-modal md-effect-1\" id=\"modal-add\">
\t\t<div class=\"md-content\">
\t\t\t<h3>ADD RULE</h3>
\t\t\t<div>
\t\t\t\t<form action=\"manage/add\" method=\"POST\">
\t\t\t\t<table>
\t\t\t\t\t<tr>
\t\t\t\t\t\t<td>IP / CLIENT</td>
\t\t\t\t\t\t<td><input type=\"text\" name=\"ip\" placeholder=\"xx.xx.xx.xx/xx\"></td>
\t\t\t\t\t</tr>
\t\t\t\t\t<tr>
\t\t\t\t\t\t<td>DOWNLOAD LIMIT</td>
\t\t\t\t\t\t<td><input type=\"text\" name=\"download\" placeholder=\"<n> Kb/Mb/Gb\"></td>
\t\t\t\t\t</tr>
\t\t\t\t\t<tr>
\t\t\t\t\t\t<td>UPLOAD LIMIT</td>
\t\t\t\t\t\t<td><input type=\"text\" name=\"upload\" placeholder=\"<n> Kb/Mb/Gb\"></td>
\t\t\t\t\t</tr>
\t\t\t\t</table>
\t\t\t\t<div class=\"right action\">
\t\t\t\t\t<span class=\"md-close\">Cancel</span> or 
\t\t\t\t\t<input type=\"submit\" href=\"#\" class=\"md-trigger btn\" data-modal=\"modal-add\" value=\"SAVE\">
\t\t\t\t</div>
\t\t\t\t</form>
\t\t\t</div>
\t\t</div>
\t</div>
\t";
        // line 38
        $this->displayBlock('modals', $context, $blocks);
        // line 41
        echo "\t";
        $this->displayBlock('content', $context, $blocks);
        // line 44
        echo "\t<div class=\"md-overlay\"></div><!-- the overlay element -->
\t<script src=\"js/classie.js\"></script>
\t<script src=\"js/modalEffects.js\"></script>
\t<script>
\t\t// this is important for IEs
\t\tvar polyfilter_scriptpath = '/js/';
\t</script>
\t<script src=\"js/cssParser.js\"></script>
\t<script src=\"js/css-filters-polyfill.js\"></script>
</body>
</html>";
    }

    // line 38
    public function block_modals($context, array $blocks = array())
    {
        // line 39
        echo "\t\t
\t";
    }

    // line 41
    public function block_content($context, array $blocks = array())
    {
        // line 42
        echo "\t\t
\t";
    }

    public function getTemplateName()
    {
        return "manage/layout.html";
    }

    public function getDebugInfo()
    {
        return array (  90 => 42,  87 => 41,  82 => 39,  79 => 38,  65 => 44,  62 => 41,  60 => 38,  21 => 1,);
    }
}
