<?php

require_once __DIR__ . '/vendor/autoload.php'; // Autoload files using Composer autoload

use BafReport;
use BafReport\Db;
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

// $db->connect();

$data = $db->findAll('applicant');

var_dump($data);

// $db->query('applicant');

// var_dump($db);

// $db->get('applicant');

// $conn = BafReport\Db::connect();
// $conn;



// var_dump($conn);