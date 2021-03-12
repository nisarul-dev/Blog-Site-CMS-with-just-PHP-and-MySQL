<?php
$db['host'] = "localhost";
$db['user'] = "root";
$db['password']= "";
$db['database'] = "cms";

foreach ($db as $key => $value) {
    define( strtoupper($key), $value );
}

$connection  = mysqli_connect(HOST, USER, PASSWORD, DATABASE);

//if ($connection) {
//    echo "Hello";
//}

//include "db.php";