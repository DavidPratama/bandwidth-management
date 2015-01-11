<?php
class Manage {
	private $conf;
	private $view;

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
		@session_start();
		echo $this->view->render('manage/index.html', array('data' => $this->conf->all(), 'shape' => $_SESSION));
		$compiler = new Compiler("eth0", "wlan0");
		$compiler->compile($this->conf->all());
	}

	public function doAdd()
	{
		$configuration = new ConfigurationEntity;
		$configuration->add('download', $_POST['download']);
		$configuration->add('upload', $_POST['upload']);
		$this->conf->add($_POST['ip'], $configuration);
		header("location:$_SERVER[HTTP_REFERER]");
	}

	public function doEdit($ip)
	{
		$configuration = new ConfigurationEntity;
		$configuration->add('download', $_POST['download']);
		$configuration->add('upload', $_POST['upload']);
		$configuration->add('ip', $_POST['ip']);
		echo $this->conf->edit($ip, $configuration);
		header("location:$_SERVER[HTTP_REFERER]");
	}

	public function doDelete($ip)
	{
		$this->conf->delete($ip);
		header("location:$_SERVER[HTTP_REFERER]");
	}

	public function doShape()
	{
		@session_start();
		//exec("sudo /sbin/tc filter add dev eth0 protocol ip parent  $_POST[http] ");
		$_SESSION['http'] = $_POST['http'];
		//exec("sudo /sbin/tc filter add dev eth0 protocol ip parent  $_POST[https] ");
		$_SESSION['https'] = $_POST['https'];
		//exec("sudo /sbin/tc filter add dev eth0 protocol ip parent  $_POST[smtp] ");
		$_SESSION['smtp'] = $_POST['smtp'];
		//exec("sudo /sbin/tc filter add dev eth0 protocol ip parent  $_POST[ftp] ");
		$_SESSION['ftp'] = $_POST['ftp'];
		header("location:/bwmg/manage");
	}
}
