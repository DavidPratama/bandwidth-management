<?php
class FileBasedConfiguration implements ConfigurationDriver{
	private $file;

	private $dir;

	public function __construct($dir)
	{
		$this->dir = $dir . "/";
		$this->file = new FileReadWrite;
	}

	public function add($name, ConfigurationEntity $conf)
	{
		$ip = str_replace("/", "_", $name);
		
		foreach ($conf->get() as $entity => $value) {
		$this->file->append($this->dir . $ip, $entity . "=" . $value . ";");
		}
		$this->file->close();
	}

	public function edit($name, ConfigurationEntity $conf)
	{
		$ip = str_replace("/", "_", $name);
		$str = $this->file->read($this->dir . $ip);
		$this->file->close();
		$newConf = null;
		foreach ($conf->get() as $entity => $value) {
			$newConf = preg_replace("/" . $entity . "=(.*?);/", $entity . "=" . $value . ";", $str);
			$str = $newConf;
			echo $entity;
			if ($entity == "ip") {
				$newName = str_replace("/", "_", $value);
				exec("mv $this->dir" . $ip . " $this->dir" . $newName);
				exec("chmod $this->dir" . $ip . " 777");
				exec("rm $this->dir" . $ip);
			} else {
				$newName = $name;
			}
		}
		$this->file->write($this->dir . $newName, $newConf);
		$this->file->close();
	}

	public function delete($name)
	{
		$ip = str_replace("/", "_", $name);
		echo $ip . "as";
		$this->file->delete($this->dir . $ip);
	}

	public function get($name)
	{
		return $this->file->read($name);
		$this->file->close();
	}

	public function getConf($name)
	{
		return $this->rawConfigurationToArray($name);
	}

	public function all()
	{
		$conf = array();
		foreach ($this->file->lists($this->dir) as $name) {
			if ($name != '.' && $name != '..') {

				$ip = str_replace("_", "/", $name);
				$conf[$ip] = $this->rawConfigurationToArray($name);

			}
		}
		return $conf;
	}

	public function exists($name)
	{
		$ip = str_replace("/", "_", $name);
		return $this->file->exists($this->dir . $ip);
	}

	private function rawConfigurationToArray($name)
	{
		$entities = array();
		$configuration = array_filter(explode(";", $this->get($this->dir . $name)));
		foreach ($configuration as $idx => $entity) {
			$temp = explode("=", $entity);
			$entities[$temp[0]] = $temp[1];
		}
		return $entities;
	}
}