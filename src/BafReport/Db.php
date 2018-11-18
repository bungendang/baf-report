<?php

namespace BafReport;

use PDO;

class Db
{
	protected static $_instance;
	// Database Credentials
	protected $host;
	protected $username;
	protected $password;
	protected $db_name;
	protected $charset;
	protected $conn;


	// static $this;

	public function __construct($host = NULL, $username = NULL, $password = NULL, $db_name = NULL, $port = NULL, $charset = 'utf8')
	{
		// global $conn;
		// if params were passed as array
        if (is_array ($host)) {
            foreach ($host as $key => $val)
                $$key = $val;
        }
        // if host were set as mysqli socket
        if (is_object ($host))
            $this->_mysqli = $host;
        else
            $this->host = $host;

        $this->username = $username;
        $this->password = $password;
        $this->db_name = $db_name;
        $this->port = $port;
        $this->charset = $charset;

        $this->conn = $this->connect();
        return self::$_instance;
        // var_dump($this);
	}

	public function connect(){
		try {
		    $conn = new PDO("mysql:host=".$this->host.";dbname=".$this->db_name, $this->username, $this->password);
		    // $conn = new PDO("mysql:host=mysql;dbname=baf_extension_db", $this->username, $this->password);
		    // set the PDO error mode to exception
		    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION, PDO::FETCH_ASSOC);
		    // echo "Connected successfully"; 
		    }
		catch(PDOException $e)
		    {
		    // echo "Connection failed: " . $e->getMessage();
	    }
        return $conn;

	}

	public function findAll($table_name)
	{
		// var_dump($this);
		$sth = $this->conn->prepare("SELECT * FROM ".$table_name);
		$sth->execute();

		/* Fetch all of the remaining rows in the result set */
		// print("Fetch all of the remaining rows in the result set:\n");
		$result = $sth->fetchAll();
		// print_r($result);
		// var_dump($conn);
		// $conn->
		// $data = $this->db->query('SELECT * FROM applicant');
		// return "data";
		return $result;
	}

	public function mysqli ()
    {
        if (!$this->_mysqli)
            $this->connect();
        return $this->_mysqli;
    }

}

