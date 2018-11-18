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
	public function submit($data = NULL)
	{
		try
		{
			$inserted_date = date("Y-m-d H:i:s");
			// $inserted_date = new \DateTime($inserted_date);
			var_dump($inserted_date);
			$sql = "INSERT INTO applicant (nama, jenis_kelamin, agama, tempat_lahir, tanggal_lahir, status_pernikahan, alamat, telpon1, telpon2, email, apply_as, cv_src, foto_src, tanggal_submit, created_at, updated_at) VALUE ('$data[nama]', '$data[jenis_kelamin], '$data[agama]', '$data[tempat_lahir]', $data[tanggal_lahir],'$data[status_pernikahan]', '$data[alamat]', '$data[telpon1]', '$data[telpon2]', '$data[email]', '$data[apply_as]', '$data[cv_src]', '$data[foto_src]', '$data[tanggal_submit]', '$inserted_date', '$inserted_date')";
			$conn = $this->a->connect();
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$conn->exec($sql);
		}
		catch(PDOException $e)
		{
			echo "err";
		}
		return "Data submitted";
	}
}

