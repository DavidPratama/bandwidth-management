<?php
class Monitor {
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
		echo $this->view->render('monitor/layout.html', array("data" => $this->conf->all(), "monitor" => new System));
	}

}