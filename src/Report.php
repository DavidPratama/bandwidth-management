<?php
class Report {
	private $view;
	private $ip;

	public function __construct()
	{
		$this->conf = new Configuration(new FileBasedConfiguration);

		//initialize twig template engine
		$loader = new Twig_Loader_Filesystem('view');
		$this->view = new Twig_Environment($loader, array(
				'cache' => 'view/cache',
				'auto_reload' => true,
				'debug' => true
			));

		$this->view->addExtension(new Twig_Extension_Debug());
	}

	public function index()
	{
		$this->ip = $_POST['ip'];
		if ($_POST['month'] == 1){
			$down = rand(0,50);
			$up = rand(0,50);
			$total = $down+$up;
		} else {
			$down = $up = $total = 0;
		}
		return $this->view->render('report/index.html', array("ip" => $this->ip, "data" => $this->getGraphData(), "month" => $_POST['month'], "usage" => array("down" => $down, "up" => $up, "total" => $total)));
	}

	public function getDownloadUsage()
	{
		exec("sudo tcpdump -ttttnr /tmp/bw_usage dst net $this->ip", $out);
		return $out;
	}

	public function getUploadUsage()
	{
		exec("sudo tcpdump -ttttnr /tmp/bw_usage src net $this->ip", $out);
		return $out;
	}

	public function getGraphData()
	{
		$upData = $downData = array();
		for ($i=0; $i < 7; $i++) { 
			array_push($upData, rand(0, 20) * 1000);
			array_push($downData, rand(5, 30) * 1000);
		}
		header('Content-type: text/html');
		return json_encode(array("upload" => $upData, "download" => $downData));
	}
}