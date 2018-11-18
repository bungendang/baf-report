<?php

namespace BafReport;
// use BafReport\Db;
use BafReport\Db;

class Career
{
	private $a;

    public function __construct(Db $a)
    {
    	// $a->connect();
        $this->a = $a;
        return $this;
        // var_dump($this->a->conn);
    }
	public function getAll(){
		// $db = Db();
		// BafReport::Db()
		// var_dump($this->a->connect());
		$conn = $this->a->connect();
		$sth = $conn->prepare("SELECT * FROM applicant");
		$sth->execute();

		$result = $sth->fetchAll();

		return $result;
	}
}

