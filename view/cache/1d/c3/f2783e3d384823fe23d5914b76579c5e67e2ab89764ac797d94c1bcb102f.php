<?php

/* test.html */
class __TwigTemplate_1dc3f2783e3d384823fe23d5914b76579c5e67e2ab89764ac797d94c1bcb102f extends Twig_Template
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
\t<title>Testing</title>
</head>
<body>
\tHello world!!!

\t";
        // line 8
        echo twig_var_dump($this->env, $context, (isset($context["data"]) ? $context["data"] : null));
        echo "
</body>
</html>";
    }

    public function getTemplateName()
    {
        return "test.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  28 => 8,  19 => 1,);
    }
}
