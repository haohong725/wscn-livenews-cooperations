<?php
namespace components;

class MySQLi 
{
	protected static $db;
	protected $conn;

	public function __construct()
	{
		$this->connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DBNANME);
	}

	function connect($host, $user, $password, $dbname)
	{
		$conn = mysqli_connect($host, $user, $password, $dbname);
		mysqli_set_charset($conn, "utf8");
		$this->conn = $conn;
	}

	function query($sql)
	{
		return $this->conn->query($sql);
	}

	function close()
	{
		$this->conn->close();
	}

	function getData($sql, $fetch = 'assoc')
	{
		$result = $this->query($sql);
		$fetchMethod = 'fetch_'.$fetch;

		$data = [];
		while ($item = $result->$fetchMethod()) {
			$data[] = $item;
		}

		return $data;
	}

	function getLine($sql, $fetch = 'assoc')
	{
		$result = $this->getData($sql, $fetch);
		if ($result) {
			return $result[0];
		}
		return false;
	}

	function getVar($sql)
	{
		$result =$this->getLine($sql, 'array');
		return $result[0];
	}

	static function getInstance()
	{
		if (self::$db) {
			return self::$db;
		} else {
			return self::$db = new self;
		}
	}
}
