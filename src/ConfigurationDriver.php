<?php
interface ConfigurationDriver{
	public function add($name, ConfigurationEntity $conf);
	public function edit($name, ConfigurationEntity $conf);
	public function delete($name);
	public function getConf($name);
	public function get($name);
	public function all();
	public function exists($name);
}