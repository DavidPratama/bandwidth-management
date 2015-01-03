<?php
class FileReadWrite{
	private $file;

	public function write($name, $data)
	{
		if (!$this->file) {
			$this->file = fopen($name, "w");
		}
		fwrite($this->file, $data) or die("error");
	}

	public function append($name, $data)
	{
		if (!$this->file) {
			$this->file = fopen($name, "w+");
		}
		fwrite($this->file, $data) or die("error");
	}

	public function delete($name)
	{
		if($this->exists($name)) {
			unlink($name);
			return true;
		}
		return false;
	}

	public function read($name)
	{
		$this->file = fopen($name, "r");
		return fread($this->file, filesize($name));
	}

	public function lists($dirname)
	{
		return scandir($dirname);
	}

	public function exists($name)
	{
		return file_exists($name);
	}

	public function close()
	{
		fclose($this->file);
		$this->file = null;
	}
}
