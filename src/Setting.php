<?php
class Setting{
	private $view;

	private $system;

	private $conf;

	public function __construct()
	{
		//initialize twig template engine
		$loader = new Twig_Loader_Filesystem('view');
		$this->view = new Twig_Environment($loader, array(
				'cache' => 'view/cache',
				'auto_reload' => true,
				'debug' => true
			));

		$this->view->addExtension(new Twig_Extension_Debug());

		$this->system = new System;

		$this->conf = new Configuration(new FileBasedConfiguration("configuration"));
	}

	public function loginPage()
	{
		return $this->view->render('login.html');
	}

	public function login()
	{
		$users = include(realpath(__DIR__ . '/..') . "/users.php");
		if (array_key_exists($_POST['username'], $users) && $users[$_POST['username']] == $_POST['password']) {
			@session_start();
			$_SESSION['logged_in'] = $_POST['username'];

			header("location:/bwmg/");
		} else {
			header("location:$_SERVER[HTTP_REFERER]");
		}
	}

	public function setup()
	{
		return $this->view->render('configure/setup.html', array('ifaces' => $this->system->getIfaceList()));
	}

	public function save()
	{
		$this->system->enableIPForward();
		$this->system->forwardPacketFrom($_POST['in']);
		$this->system->startBwMonitor();

		//save configuration
		$config = new ConfigurationEntity;
		$config->add("iface_in", $_POST['in']);
		$config->add("iface_out", $_POST['out']);
		$config->add("base_download", $_POST['base_download']);
		$config->add("base_upload", $_POST['base_upload']);
		
		if (!$this->conf->add("system" ,$config)) {
			$this->conf->edit("system" ,$config);
		}	
		
		header("location:/bwmg");
	}
}