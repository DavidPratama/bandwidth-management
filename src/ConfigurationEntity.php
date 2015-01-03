<?php
class ConfigurationEntity{
	public $configuration = array();

	public function add($entity, $value)
	{
		$this->configuration["$entity"] = $value;
	}

	public function get()
	{
		return $this->configuration;
	}
}