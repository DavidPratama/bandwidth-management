<?php
class Compiler{
	private $upDev;
	private $downDev;

	public function __construct($upDev, $downDev)
	{
		$this->upDev = $upDev;
		$this->downDev = $downDev;
	}

	public function compile($configuration)
	{
		$this->compileRules($configuration);
	}

	public function compileRules($configuration)
	{
		$this->initialize($this->upDev);
		$id = 1;
		foreach ($configuration as $ip => $rules) {	
			exec("sudo /sbin/tc class add dev $this->upDev parent 1:1 classid 1:$id htb rate $rules[upload] ceil $rules[upload] burst 15k");
			exec("sudo /sbin/tc qdisc add dev $this->upDev parent 1:$id handle $id: sfq perturb 10");
			exec("sudo /sbin/tc filter add dev $this->upDev protocol ip parent 1:0 prio 1 u32 match ip src $ip flowid 1:$id");
			$id++;
		}

		$this->initialize($this->downDev);
		$id = 1;
		foreach ($configuration as $ip => $rules) {	
			exec("sudo /sbin/tc class add dev $this->downDev parent 1:1 classid 1:$id htb rate $rules[download] ceil $rules[download] burst 15k");
			exec("sudo /sbin/tc qdisc add dev $this->downDev parent 1:$id handle $id: sfq perturb 10");
			exec("sudo /sbin/tc filter add dev $this->downDev protocol ip parent 1:0 prio 1 u32 match ip dst $ip flowid 1:$id");
			$id++;
		}
	}

	public function initialize($dev)
	{
		exec("sudo /sbin/tc qdisc del dev $dev root");
		exec("sudo /sbin/tc qdisc add dev $dev root handle 1: htb default 0");
		//default interface speed
		exec("sudo /sbin/tc class add dev $dev parent 1: classid 1:1 rate 1000mbit burst 15k");
	}
}