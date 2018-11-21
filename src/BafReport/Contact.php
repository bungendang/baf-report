<?php

namespace BafReport;
// use BafReport\Db;
use BafReport\Db;
use PDO;

class Contact
{
	private $a;

    public function __construct(Db $a)
    {
    	// $a->connect();
        $this->a = $a;
        return $this;
        // var_dump($this->a->conn);
    }
    /*
    *	Get all applicant data, default is submitted today
    */
	public function getAll($range_date = NULL){
		$query = "SELECT * FROM contact ";
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
	// Post application to DB
	public function submit($data = array(
		'nama'=>NULL, 'email'=>NULL, 'telpon'=>NULL, 'nomor_kontrak'=>NULL, 'tanggal_kontak'=>0, 'pesan'=>NULL, 'created_at'=>NULL, 'updated_at'=>NULL)
		)
	{
		try
		{
			$inserted_date = date("Y-m-d H:i:s");
			
			if ($data['tanggal_kontak']) {
				# code...
				// $tanggal_lahir = 0;
			} else {
				# code...
				$tanggal_kontak = 0;
			}
			
			$sql = "INSERT INTO contact (tanggal_kontak, nama, email, telpon, pesan, nomor_kontrak, created_at, updated_at) VALUES ($tanggal_kontak, '$data[nama]', '$data[email]', '$data[telpon]', '$data[pesan]',  '$data[nomor_kontrak]', '$inserted_date', '$inserted_date')";
			$conn = $this->a->connect();
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$conn->exec($sql);
			$id = $conn->lastInsertId();
			// var_dump($id);
			return $id;
		}
		catch(PDOException $e)
		{
			echo "err";
		}
		
	}
}

