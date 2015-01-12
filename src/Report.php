<?php
class Report {
	private $view;
	private $ip;

	private $down;
	private $up;
	private $total;

	public function __construct()
	{
		$this->conf = new Configuration(new FileBasedConfiguration("rules"));

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
		if($_POST['month'] == "01"){
			$this->up = date('d') * 10;
			$this->down = 34;
			$this->total = $this->up + $this->down;
		}
		$this->ip = $_POST['ip'];	
		return $this->view->render('report/index.html', array("ip" => $this->ip, "month" => $_POST['month'], "usage" => array("down" => $this->down, "up" => $this->up, "total" => $this->total)));
	}

	public function getDownloadUsage($month)
	{
		$date = date('Y') . "-$month";
		$ip = $_SERVER['HTTP_HOST'];
		exec("sudo tcpdump -ttttnr /root/bw_usage dst net $this->ip |
				grep $date | 
				awk '{print $1}' |  
				sort | 
				uniq -c  | 
				cat |
				awk '{print substr($2, 9, 2) \" \" $1}'", $out);
		return $out;
		/*$down_bw = 0;
		foreach ($out as $packet) {
			preg_match("/length (\d+)/", $packet, $length);
			if(isset($length[1]))
			$down_bw += $length[1];
		}
		return $down_bw;*/
	}

	public function getUploadUsage($month)
	{
		$date = date('Y') . "-$month";
		$ip = $_SERVER['HTTP_HOST'];
		exec("sudo tcpdump -ttttnr /root/bw_usage src net $this->ip | 
				grep $date | 
				awk '{print $1}' |  
				sort | 
				uniq -c  | 
				cat |
				awk '{print $2 \" \" $1}'", $out);

		return $out;
		/*$up_bw = 0;
		foreach ($out as $packet) {
			preg_match("/length (\d+)/", $packet, $length);
			if(isset($length[1]))
			$up_bw += $length[1];
		}
		return $up_bw;*/
	}

	public function getGraphData($month)
	{	
		$dumpDown = array("2320", "3320", "1293", "23120", "23320", "13330", "12320", "23202", "42320", "23720", "23770", "53880", "31120", "12320", "43202", "32320", "22720", "23770", "53880", "31120", "3320", "1293", "23120", "23320", "13330", "12320", "23202", "42320", "23720", "1100", "21212");
		$dumpUp = array("23203", "33620", "12933", "21120", "34320", "23330", "67320", "25202", "9330", "13610", "30012", "30112", "32355", "9330", "13610", "22012", "30112", "32355", "9330", "13610", "30012", "2212", "32355", "9330", "2320", "3320", "1293", "23120", "13610", "30012", "30112",);
		$upData = $downData = array();
		if ($month == "01"){
			for ($i=0; $i < intval(date('d')); $i++) { 
				array_push($upData, $dumpUp[$i]);
				array_push($downData, $dumpDown[$i]);
			}
			
		}
		
		
		header('Content-type: text/html');
		return json_encode(array("upload" => $upData, "download" => $downData, "label" => $this->getLabel($month)));
	}

	private function getLabel($month)
	{
		$label = array();
		for($i = 1;$i <= count($this->getDateArray($month));$i++) {
			array_push($label, $i);
		}
	
		return $label;
	}

	private function getDateArray($month){
		$start = strtotime(date('Y-m') . '-1');
		$i_max = (date("L",$start)?366:365)-1;

		for($i = 0;$i <= $i_max;$i++){
		    $calendar[strftime("%m",$loop = strtotime("+$i day",$start))][$i] = date("Y-m-d",$loop);
		}
		return $calendar[$month];
	}
}