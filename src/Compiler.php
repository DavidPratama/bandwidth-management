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
		$id = 2;
		exec("sudo /sbin/tc qdisc add dev $this->upDev root handle 2: htb default 0");
		//default interface speed
		exec("sudo /sbin/tc class add dev $this->upDev parent 2: classid 2:1 htb rate 1000mbit burst 15k");
		foreach ($configuration as $ip => $rules) {	
			exec("sudo /sbin/tc class add dev $this->upDev parent 2:1 classid 2:$id htb rate $rules[upload] ceil $rules[upload] burst 15k prio $id");
			exec("sudo /sbin/tc qdisc add dev $this->upDev parent 2:$id handle $id: sfq perturb 10");
			$id++;
		}

		$this->initialize($this->downDev);
		$id = 2;
		exec("sudo /sbin/tc qdisc add dev $this->downDev root handle 1: htb default 0");
		//default interface speed
		exec("sudo /sbin/tc class add dev $this->downDev parent 1: classid 1:1 htb rate 1000mbit burst 15k");
		foreach ($configuration as $ip => $rules) {	
			exec("sudo /sbin/tc class add dev $this->downDev parent 1:1 classid 1:$id htb rate $rules[download] ceil $rules[download] burst 15k");
			exec("sudo /sbin/tc qdisc add dev $this->downDev parent 1:$id handle $id: sfq perturb 10");
			$id++;
		}

		$id = 2;
		foreach($configuration as $ip => $rules) {
			exec("sudo iptables -t mangle -A POSTROUTING -s $ip -j CLASSIFY --set-class 2:$id");
			exec("sudo iptables -t mangle -A POSTROUTING -d $ip -j CLASSIFY --set-class 1:$id");
			$id++;
		}
	}

	public function initialize($dev)
	{
		exec("sudo iptables -t mangle -F");
		exec("sudo /sbin/tc qdisc del dev $dev root");
	}
}
