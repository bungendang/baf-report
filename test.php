<?php

require_once __DIR__ . '/vendor/autoload.php'; // Autoload files using Composer autoload

use BafReport;
use BafReport\Db;
use BafReport\Career as Career;
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


$db = new BafReport\Db($config);
$career = new Career($db);

// $career = Career::getAll();

// $data = $db->findAll('applicant');

// $career = Career::getAll();
var_dump($career->getAll([
	'from'=>'2018-11-04',
	'to'=>'2018-11-15'
]));
// var_dump($data);