<?php

/* report/index.html */
class __TwigTemplate_36072c751e3ccdf8f4b6ebd1988a6aed5a4441f7b7faafb0fdb5b2fa9980902e extends Twig_Template
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
\t<title>Bandwidth Management | Report</title>
\t<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
\t<link rel=\"stylesheet\" type=\"text/css\" href=\"/bwmg/css/font-awesome.min.css\">
\t<link rel=\"stylesheet\" type=\"text/css\" href=\"/bwmg/css/skeleton.css\">
\t<link rel=\"stylesheet\" type=\"text/css\" href=\"/bwmg/css/normalize.css\">
\t<link rel=\"stylesheet\" type=\"text/css\" href=\"/bwmg/css/dashboard.css\">
</head>
<body>

\t<!-- .container is main centered wrapper -->
<div class=\"container\">
    <div class=\"row\">
        <h2>Monthly Report of ";
        // line 15
        echo twig_escape_filter($this->env, (isset($context["ip"]) ? $context["ip"] : null), "html", null, true);
        echo " ";
        echo twig_escape_filter($this->env, twig_date_format_filter($this->env, twig_date_converter($this->env, (("2012-" . (isset($context["month"]) ? $context["month"] : null)) . "-02")), "F"), "html", null, true);
        echo " 2015</h2>
        <h4>Total Usage : ";
        // line 16
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["usage"]) ? $context["usage"] : null), "total", array()), "html", null, true);
        echo "Mbit | Download : ";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["usage"]) ? $context["usage"] : null), "down", array()), "html", null, true);
        echo "Mbit | Upload : ";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["usage"]) ? $context["usage"] : null), "up", array()), "html", null, true);
        echo "Mbit</h4>
        <div>
            <canvas id=\"bw\"></canvas>
        </div>
    </div>
</div>
    <script type=\"text/javascript\" src=\"/bwmg/js/chart.min.js\"></script>
\t<script type=\"text/javascript\" src=\"/bwmg/js/jquery-1.7.2.min.js\"></script>
    <script type=\"text/javascript\">
            \$.ajax({
                url:'getGraphData',
                method:'GET',
                success:function(data){
                    var chart = jQuery.parseJSON(data);
                    if (";
        // line 30
        echo twig_escape_filter($this->env, (isset($context["month"]) ? $context["month"] : null), "html", null, true);
        echo " != 1) {
                        chart = null
                        
                    } else {
                        var bwChartData = {
                            labels : [\"1\", \"2\", \"3\", \"4\", \"5\", \"6\", \"7\", \"8\", \"9\", \"10\", \"11\", \"12\", \"13\", \"14\", \"15\", \"16\", \"17\", \"18\", \"19\", \"20\", \"21\", \"22\", \"23\", \"24\", \"25\", \"26\", \"27\", \"28\", \"29\", \"30\"],
                            datasets : [
                                {
                                    fillColor : \"rgba(151,187,205,0.5)\",
                                    strokeColor : \"rgba(151,187,205,1)\",
                                    pointColor : \"rgba(151,187,205,1)\",
                                    pointStrokeColor : \"#fff\",
                                    data : chart.download
                                },
                                {
                                    fillColor : \"rgba(0,187,0,0.5)\",
                                    strokeColor : \"rgba(0,255,0,1)\",
                                    pointColor : \"rgba(0,100,0,1)\",
                                    pointStrokeColor : \"#fff\",
                                    data : chart.upload
                                }
                            ]
                        };
                        
                        var options = {
                            animation : false,
                            responsive:true,
                            segmentShowStroke : false,
                        };
                        
                        var ctx = \$(\"#bw\").get(0).getContext(\"2d\");
                        var myLine = new Chart(ctx).Line(bwChartData, options );
                    }
                }
            });
    </script>
</body>
</html>";
    }

    public function getTemplateName()
    {
        return "report/index.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  62 => 30,  41 => 16,  35 => 15,  19 => 1,);
    }
}
