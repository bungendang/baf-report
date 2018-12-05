<?php

require_once __DIR__ . '/vendor/autoload.php'; // Autoload files using Composer autoload

// var_dump(__DIR__);



// use BafReport;
use BafReport\Db as DB;
use BafReport\Career as Career;
use BafReport\Contact as Contact;
use BafReport\Fleet as Fleet;
// use BafReport\Career;

// echo BafReport\BafReport::test();

// echo BafReport\Career::test();

$config = Array (
    'host' => 'mysql',
    'username' => 'root', 
    'password' => 'tiger',
    'db_name'=> 'baf_extension_db',
    'port' => 3306,
    'charset' => 'utf8'
);



$db = new DB($config);
// $career = new Career($db);

// $career = Career::getAll();

// $data = $db->findAll('applicant');

// $career = Career::getAll();
// var_dump($career->getAll());

// var_dump($career->submit([
// 	'nama'=>'Endang Kurniawan',
// 	'email'=>'bungendang@gmail.com',
// 	'telpon1'=>'08123123123',
// 	'cv_src'=>'asdasdsd.com'
// ]));

// var_dump($data);

// $contact = new Contact($db);

// var_dump($contact->getAll());
// var_dump($contact->submit([
// 	'nama'=> 'Endang Kurniawan',
// 	'telpon'=>"0812312312312",
// 	'email'=>'endag_kur@gmail.com',
// 	'pesan'=>'ini pesan saya',
// 	'nomor_kontrak'=>'0123123123'
// ]));


$fleet = new Fleet($db);

var_dump($fleet->submit([
    'nama'=> "endang Kurniawan",
    "perusahaan" => "Does",
    "telpon" => "08123123123",
    "email" => "bungendang@gmail.com"
]));

var_dump($fleet->getAll());
