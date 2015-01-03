<?php
class FileBasedConfiguration implements ConfigurationDriver{
	private $file;

	public function __construct()
	{
		$this->file = new FileReadWrite;
	}

	public function add($name, ConfigurationEntity $conf)
	{
		$ip = str_replace("/", "_", $name);
		
		foreach ($conf->get() as $entity => $value) {
		$this->file->append("configuration/" . $ip, $entity . "=" . $value . ";");
		}
		$this->file->close();
	}

	public function edit($name, ConfigurationEntity $conf)
	{
		$ip = str_replace("/", "_", $name);
		$str = $this->file->read("configuration/" . $ip);
		$this->file->close();
		$newConf = null;
		foreach ($conf->get() as $entity => $value) {
			$newConf = preg_replace("/" . $entity . "=(.*?);/", $entity . "=" . $value . ";", $str);
			$str = $newConf;
			echo $entity;
			if ($entity == "ip") {
				$newName = str_replace("/", "_", $value);
				exec("mv configuration/" . $ip . " configuration/" . $newName);
				exec("chmod configuration/" . $ip . " 777");
				exec("rm configuration/" . $ip);
			}
		}
		$this->file->write("configuration/" . $newName, $newConf);
		$this->file->close();
	}

	public function delete($name)
	{
		$ip = str_replace("/", "_", $name);
		echo $ip . "as";
		$this->file->delete("configuration/" . $ip);
	}

	public function get($name)
	{
		return $this->file->read($name);
		$this->file->close();
	}

	public function all()
	{
		$conf = array();
		foreach ($this->file->lists("configuration") as $name) {
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
		return $this->file->exists("configuration/" . $ip);
	}

	private function rawConfigurationToArray($name)
	{
		$entities = array();
		$configuration = array_filter(explode(";", $this->get("configuration/" . $name)));
		foreach ($configuration as $idx => $entity) {
			$temp = explode("=", $entity);
			$entities[$temp[0]] = $temp[1];
		}
		return $entities;
	}
}