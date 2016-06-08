<?php


class Database {

	private $host;
	private $user;
	private $pass;
	private $name;

	public function __construct($host='localhost', $user='root', $pass='', $name='loksuchna') {
		$this->host = $host;
		$this->user = $user;
		$this->pass = $pass;
		$this->name = $name;
	}

	public function makeConnection() {
		$dbc = mysqli_connect($this->host, $this->user, $this->pass, $this->name);
		return $dbc;
	}

	
}


?>