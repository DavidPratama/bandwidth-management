<?php
class Setting{
	private $view;

	private $system;

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
	}

	public function setup()
	{
		return $this->view->render('configure/setup.html', array('ifaces' => $this->system->getIfaceList()));
	}

	public function save()
	{
		$this->system->enableIPForward();
		$this->system->forwardPacketFrom($_POST['in']);
		echo $this->system->startBwMonitor($_POST['in']);
		header("location:/bwmg");
	}
}