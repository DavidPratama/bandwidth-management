<?php
class Manage {
	private $conf;
	private $view;

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
		echo $this->view->render('manage/index.html', array('data' => $this->conf->all()));
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
}