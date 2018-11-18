<?php

namespace BafReport;
// use BafReport\Db;
use BafReport\Db;
use PDO;

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
	public function getAll($range_date = NULL){
		$query = "SELECT * FROM applicant ";
		// var_dump(date("Y-m-d H:i:s"));
		$to = "";
		$from = "";
		if (isset($range_date)) {
			# code...
			$from = new \DateTime($range_date['from']);
			$to = new \DateTime($range_date['to']);
			$query = $query."WHERE created_at BETWEEN :from AND :to ORDER BY created_at asc";
		} else {
			# code...
			$today = date("Y-m-d H:i:s");
			$from = new \DateTime($today);
			$from->setTime(00,00,00);
			$to = new \DateTime($today);
			$to->setTime(59,00,00);
			$range_date['from'] = $from;
			$range_date['to'] = $to;
			$query = $query."WHERE created_at BETWEEN :from AND :to ORDER BY created_at asc";
		}
		
		$conn = $this->a->connect();
		
		$sth = $conn->prepare($query);
		$sth->execute(array(
			":from" => $from->format("Y-m-d H:i:s"),
			":to" => $to->format("Y-m-d H:i:s")
		));

		$result = $sth->fetchAll(PDO::FETCH_ASSOC);

		return $result;
	}
}

