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
    <a href=\"manage\" class=\"md-trigger btn big\" data-modal=\"modal-add\">MANAGE</a>
    <a href=\"setup\" class=\"md-trigger btn big\" data-modal=\"modal-add\">SETUP</a>
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
            <tbody class=\"clients\">
            </tbody>
    \t</table>\t
    </div>
    <div class=\"three columns\">
    \t<h5><i class=\"fa fa-plus\"></i> SERVICES</h5>
        <table class=\"u-full-width\">
            <thead>
                <th>PORT</th>
                <th>SERVICE</th>
                <th>USAGE</th>
            </thead>
            <tbody class=\"ports\">
            </tbody>
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
            }, 1500);

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
            //clients
            \$.ajax({
                url : \"getClientsBwUsage\",
                method : \"GET\",
                success : function(data){
                    \$(\".clients\").html(data);
                }
            });
            //ports
            \$.ajax({
                url : \"getPortsBwUsage\",
                method : \"GET\",
                success : function(data){
                    \$(\".ports\").html(data);
                }
            });
        }, 1800);
        
        
    </script>
</body>
</html>";
    }

    public function getTemplateName()
    {
        return "monitor/layout.html";
    }

    public function getDebugInfo()
    {
        return array (  19 => 1,);
    }
}
