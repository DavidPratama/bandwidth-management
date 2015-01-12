<?php

/* login.html */
class __TwigTemplate_993b173d29fb0cb85d6e575efd797ff4f4e288f4d180973678f5022a8418fa98 extends Twig_Template
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
\t<title></title>
\t<link rel=\"stylesheet\" type=\"text/css\" href=\"/bwmg/css/login.css\">
</head>
<body>
\t<div class=\"container\">
\t\t<div class=\"login-container\">
\t\t<h2>BANDWIDTH MANAGEMENT</h2>\t\t\t
\t\t<div id=\"output\"></div>
\t\t<div class=\"avatar\"></div>
\t\t<div class=\"form-box\">
\t\t    <form action=\"/bwmg/login\" method=\"POST\">
\t\t        <input name=\"username\" type=\"text\" placeholder=\"username\">
\t\t        <input name=\"password\" type=\"password\" placeholder=\"password\">
\t\t        <button class=\"btn btn-info btn-block login\" type=\"submit\">Login</button>
\t\t    </form>
\t\t</div>
\t\t</div>  
\t</div>
</body>
</html>";
    }

    public function getTemplateName()
    {
        return "login.html";
    }

    public function getDebugInfo()
    {
        return array (  19 => 1,);
    }
}
