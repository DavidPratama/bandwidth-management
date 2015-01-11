<?php
class Configuration{
	private $drv;

	public function __construct(ConfigurationDriver $drv)
	{
		$this->drv = $drv;
	}

	public function add($name, ConfigurationEntity $conf)
	{
		if(!$this->drv->exists($name)) {
			$this->drv->add($name, $conf);
			return true;
		}
		return false;
	}

	public function edit($name, ConfigurationEntity $conf)
	{
		if($this->drv->exists($name)) {
			$this->drv->edit($name, $conf);
			return true;
		}
		return false;
	}

	public function delete($name)
	{
		if($this->drv->exists($name)) {
			$this->drv->delete($name);
			return true;
		}
		return false;
	}

	public function get($name)
	{
		if($this->drv->exists($name)) {
			return $this->drv->get($name);
		}
		return false;
	}

	public function getConf($name)
	{
		if($this->drv->exists($name)) {
			return $this->drv->getConf($name);
		}
		return false;
	}	

	public function all()
	{
		return $this->drv->all();
	}
}