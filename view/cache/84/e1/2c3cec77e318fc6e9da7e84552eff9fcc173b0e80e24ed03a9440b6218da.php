<?php

/* monitor/layout.html */
class __TwigTemplate_84e12c3cec77e318fc6e9da7e84552eff9fcc173b0e80e24ed03a9440b6218da extends Twig_Template
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
\t<link rel=\"stylesheet\" type=\"text/css\" href=\"css/dashboard.css\">
</head>
<body>

\t<!-- .container is main centered wrapper -->
<div class=\"container\">
  <div class=\"usage\"></div>
  <!-- columns should be the immediate child of a .row -->
  <div class=\"row\">
    <div class=\"five columns\">
    \t<h5><i class=\"fa fa-plus\"></i> RESOURCE USAGE</h5>
        <div id=\"main\">
            <div class=\"resource\">
                <canvas id=\"ram\"></canvas>
                <label class=\"label\">RAM</label>
            </div>
            <div class=\"resource\">
                <canvas id=\"process\"></canvas>
                <label class=\"label\">PROCESSOR</label>
            </div>
        </div>
    </div>
    <div class=\"seven columns\">
    \t<h5><i class=\"fa fa-plus\"></i> BANDWIDTH USAGE (bits/second)</h5>
        <div><canvas id=\"bw\"></canvas></div>
    </div>
  </div>
  <!-- just use a number and class 'column' or 'columns' -->
  <div class=\"row\">
    <div class=\"nine columns\">
    \t<h5><i class=\"fa fa-plus\"></i> BANDWIDTH USAGE</h5>
    \t<table class=\"u-full-width\">
    \t\t<thead>
    \t\t\t<th>IP</th>
    \t\t\t<th>ALIAS</th>
    \t\t\t<th>DOWNLOAD LIMIT</th>
    \t\t\t<th>DOWNLOAD USAGE</th>
                <th>UPLOAD LIMIT</th>
                <th>UPLOAD USAGE</th>
    \t\t</thead>
            ";
        // line 48
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
            // line 49
            echo "                <tr class='danger'>
                    <td>";
            // line 50
            echo twig_escape_filter($this->env, $context["ip"], "html", null, true);
            echo "</td>
                    <td></td>
                    <td>";
            // line 52
            echo twig_escape_filter($this->env, $this->getAttribute($context["conf"], "download", array()), "html", null, true);
            echo "</td>
                    <td id=\"";
            // line 53
            echo twig_escape_filter($this->env, $this->getAttribute($context["loop"], "index", array()), "html", null, true);
            echo "_download\" class=\"download-usage\" data-ip=\"";
            echo twig_escape_filter($this->env, $context["ip"], "html", null, true);
            echo "\"></td>
                    <td>";
            // line 54
            echo twig_escape_filter($this->env, $this->getAttribute($context["conf"], "upload", array()), "html", null, true);
            echo "</td>
                    <td id=\"";
            // line 55
            echo twig_escape_filter($this->env, $this->getAttribute($context["loop"], "index", array()), "html", null, true);
            echo "_upload\" class=\"upload-usage\" data-ip=\"";
            echo twig_escape_filter($this->env, $context["ip"], "html", null, true);
            echo "\"></td>
                </tr>
            ";
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
        // line 58
        echo "    \t</table>\t
    </div>
    <div class=\"three columns\">
    \t<h5><i class=\"fa fa-plus\"></i> SERVICES</h5>
        <table class=\"u-full-width\">
            <thead>
                <th>PORT</th>
                <th>SERVICE</th>
                <th>USAGE</th>
            </thead>
            <tr>
                <td>80</td>
                <td>HTTP</td>
                <td>10M</td>
            </tr>
            <tr>
                <td>80</td>
                <td>HTTP</td>
                <td>10M</td>
            </tr>
            <tr>
                <td>80</td>
                <td>HTTP</td>
                <td>10M</td>
            </tr>
        </table>    
    </div>
  </div>

</div>
    <script type=\"text/javascript\" src=\"js/chart.min.js\"></script>
\t<script type=\"text/javascript\" src=\"js/jquery-1.7.2.min.js\"></script>
    <script type=\"text/javascript\" src=\"js/knockout.js\"></script>
    <script type=\"text/javascript\">
        function MainViewModel(data) {
            var self = this;
            
            self.bwChartData = ko.observable({
                labels : [\"\", \"\", \"\", \"\", \"\", \"\", \"\", ],
                datasets : [
                    {
                        fillColor : \"rgba(151,187,205,0.5)\",
                        strokeColor : \"rgba(151,187,205,1)\",
                        pointColor : \"rgba(151,187,205,1)\",
                        pointStrokeColor : \"#fff\",
                        data : [0, 0, 0, 0, 0, 0, 0]
                    },
                    {
                        fillColor : \"rgba(0,187,0,0.5)\",
                        strokeColor : \"rgba(0,255,0,1)\",
                        pointColor : \"rgba(0,100,0,1)\",
                        pointStrokeColor : \"#fff\",
                        data : [0, 0, 0, 0, 0, 0, 0]
                    }
                ]
            });
            
            self.procChartData = ko.observableArray([
                {
                    value: 0,
                    color:\"#F7464A\",
                    label: \"Used\"
                },
                {
                    value: 100,
                    color:\"#ffffff\",
                    highlight: \"#FF5A5E\",
                    label: \"Free\"
                }
            ]);

            self.memChartData = ko.observableArray([
                {
                    value: 0,
                    color:\"#F7464A\",
                    label: \"Used\"
                },
                {
                    value: 100,
                    color:\"#ffffff\",
                    highlight: \"#FF5A5E\",
                    label: \"Free\"
                }
            ]);

            setInterval(function () {
                \$.ajax({
                    url:'getBwUsage',
                    method:'GET',
                    success:function(data){
                        var bw = jQuery.parseJSON(data);
                        self.bwChartData().datasets[0].data.shift();
                        self.bwChartData().datasets[0].data.push(bw.download);
                        self.bwChartData().datasets[1].data.shift();
                        self.bwChartData().datasets[1].data.push(bw.upload);

                        self.initLine();
                    }
                });
            }, 2000);

            setInterval(function () {
                \$.ajax({
                    url:'getResourceUsage',
                    method:'GET',
                    success:function(data){
                        var res = jQuery.parseJSON(data);
                        
                        self.memChartData()[0].value = res.memory / 20000 * 100;
                        self.memChartData()[1].value = (20000 - res.memory) / 20000 * 100;
                        self.procChartData()[0].value = res.processor;
                        self.procChartData()[1].value = 100 - res.processor;

                        self.initDoughnut();
                    }
                });
            }, 2000);
            
            self.initLine = function() {
                var options = {
                    animation : false,
                    responsive:true,
                    segmentShowStroke : false,
                };
                
                var ctx = \$(\"#bw\").get(0).getContext(\"2d\");
                var myLine = new Chart(ctx).Line( vm.bwChartData(), options );
            }

            self.initDoughnut = function() {
                var options = {
                    animation : false,
                    responsive:true,
                    segmentShowStroke : false,
                };
                
                var ram_ctx = \$(\"#ram\").get(0).getContext(\"2d\");
                var ram = new Chart(ram_ctx).Doughnut( vm.memChartData(), options);

                var process_ctx = \$(\"#process\").get(0).getContext(\"2d\");
                var process = new Chart(process_ctx).Doughnut( vm.procChartData(), options);
            }
            
        }
        
        var vm = new MainViewModel();
        ko.applyBindings(vm);
        vm.initLine();
    </script>

    <script type=\"text/javascript\">
       setInterval(function() {
            \$('.download-usage').each(function(){
                var that = \$(this);
                \$.ajax({
                    url : \"getIPBwUsage/192.168.88.214\",
                    method : \"GET\",
                    success : function(data){
                        var bw = jQuery.parseJSON(data);
                        that.html(bw.download + \" bit\");
                    }
                });
            });
       
            \$('.upload-usage').each(function(){
                var that = \$(this);
                \$.ajax({
                    url : \"getIPBwUsage/192.168.88.214\",
                    method : \"GET\",
                    success : function(data){
                        var bw = jQuery.parseJSON(data);
                        that.html(bw.upload + \" bit\");
                    }
                });
            });
        }, 1000);
        
        
    </script>
</body>
</html>";
    }

    public function getTemplateName()
    {
        return "monitor/layout.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  126 => 58,  107 => 55,  103 => 54,  97 => 53,  93 => 52,  88 => 50,  85 => 49,  68 => 48,  19 => 1,);
    }
}
