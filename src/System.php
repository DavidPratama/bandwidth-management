<?php
class System{
	private $conf;

	public function __construct()
	{
		$this->conf = new Configuration(new FileBasedConfiguration);
	}

	public function getIfaceList()
	{
		$ifaces = array();
		exec("ip link list", $out);
		foreach ($out as $ifaceList) {
			preg_match("/\d: ([a-z0-9]+):/", $ifaceList, $result); 	
			if (!empty($result)) {
				array_push($ifaces, $result[1]);
			}
		}	
		return $ifaces;
	}

	public function enableIPForward()
	{
		exec("sudo sysctl -w net.ipv4.ip_forward=1", $out);
		return isset($out);
	}

	public function forwardPacketFrom($outIface)
	{
		exec("sudo iptables -t nat -A POSTROUTING -o $outIface -j MASQUERADE");
	}

	public function startBwMonitor($iface)
	{
		$command = "sudo tcpdump -i $iface -v -w /tmp/bw_usage";
		$pid = shell_exec(sprintf('%s > /dev/null 2>&1 & echo $!', $command));
	}

	public function getBwUsage()
	{
		$ip = $_SERVER['HTTP_HOST'];
		$currTime = date('Y-m-d H:i:s');
		exec("sudo tcpdump -ttttnnr /tmp/bw_usage | grep '$currTime'", $out);
		
		$up_packets = preg_grep("/$ip\.\d+ >/", $out);
		$down_packets = preg_grep("/> $ip\.\d+/", $out);
		$up_bw = $down_bw = 0;
		foreach ($up_packets as $packet) {
			preg_match("/length (\d+)/", $packet, $length);
			if(isset($length[1]))
			$up_bw += $length[1];
		}
		foreach ($down_packets as $packet) {
			preg_match("/length (\d+)/", $packet, $length);
			if(isset($length[1]))
			$down_bw += $length[1];
		}
		header('Content-type: text/html');
		return json_encode(array("download" => $down_bw, "upload" => $up_bw));
	}

	public function getClientsBwUsage()
	{
		$return = array();
		foreach ($this->conf->all() as $ip => $conf) {
			$return = json_decode($this->getIPBwUsage($ip));
			echo "<tr class='danger'>
	                <td>$ip</td>
	                <td></td>
	                <td>$conf[download]</td>
	                <td class='download-usage'>$return->download bit</td>
	                <td>$conf[upload]</td>
	                <td class='upload-usage'>$return->upload bit</td>
	            </tr>";
		}
	}

	public function getPortsBwUsage()
	{
		$ports = array(80 => "HTTP", 443 => "HTTPS", 21 => "FTP", 25 => "SMTP");
		$return = array();
		foreach ($ports as $port => $name) {
			echo "<tr>
                <td>$port</td>
                <td>$name</td>
                <td>" . $this->getPortBwUsage($port) . " bit</td>
            </tr>";
		}
	}

	public function getPortBwUsage($port)
	{
		$currTime = date('Y-m-d H:i:s');
		exec("sudo tcpdump -ttttnnr /tmp/bw_usage port $port | grep '$currTime'", $packets);
		$usage = 0;
		foreach ($packets as $packet) {
			preg_match("/length (\d+)/", $packet, $length);
			if(isset($length[1]))
			$usage += $length[1];
		}
		return $usage;
	}

	public function getIPBwUsage($ip)
	{
		$currTime = date('Y-m-d H:i:s');
		exec("sudo tcpdump -ttttnnr /tmp/bw_usage src net $ip | grep '$currTime'", $up_packets);
		exec("sudo tcpdump -ttttnnr /tmp/bw_usage dst net $ip | grep '$currTime'", $down_packets);
		$up_bw = $down_bw = 0;
		foreach ($up_packets as $packet) {
			preg_match("/length (\d+)/", $packet, $length);
			if(isset($length[1]))
			$up_bw += $length[1];
		}
		foreach ($down_packets as $packet) {
			preg_match("/length (\d+)/", $packet, $length);
			if(isset($length[1]))
			$down_bw += $length[1];
		}
		header('Content-type: text/html');
		return json_encode(array("download" => $down_bw, "upload" => $up_bw));
	}

	public function getResourceUsage()
	{
		return json_encode(array("memory" => $this->getMemoryUsage(), "processor" => $this->getProcessorUsage()));
	}

	public function getProcessorUsage()
	{
		$loads = sys_getloadavg();
		$core_nums = trim(shell_exec("grep -P '^processor' /proc/cpuinfo|wc -l"));
		$load = round($loads[0]/($core_nums + 1)*100, 2);
		return $load;
	}

	public function getMemoryUsage()
	{
		$fh = fopen('/proc/meminfo','r');
		$mem = 0;
		while ($line = fgets($fh)) {
		$pieces = array();
			if (preg_match('/^MemFree:\s+(\d+)\skB$/', $line, $pieces)) {
				$mem = $pieces[1];
				break;
			}
		}
		fclose($fh);

		return intval($mem);
	}

}	
