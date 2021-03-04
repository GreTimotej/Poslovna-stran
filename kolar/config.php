<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'timotej');
define('DB_PASSWORD', 'pass');
define('DB_NAME', 'sola');
 
/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

//mysqli_set_charset($link,"utf8");
?>