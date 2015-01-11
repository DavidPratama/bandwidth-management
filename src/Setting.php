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

	public function setup()
	{
		return $this->view->render('configure/setup.html', array('ifaces' => $this->system->getIfaceList()));
	}

	public function save()
	{
		$this->system->enableIPForward();
		$this->system->forwardPacketFrom($_POST['in']);
		$this->system->startBwMonitor($_POST['out']);

		//save configuration
		$config = new ConfigurationEntity;
		$config->add("iface_in", $_POST['in']);
		$config->add("iface_out", $_POST['out']);
		$config->add("base_download", $_POST['base_download']);
		$config->add("base_upload", $_POST['base_upload']);
		$this->conf->add("system" ,$config);
		header("location:/bwmg");
	}
}