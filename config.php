<?php
// constant database
define('DB_HOST', 'localhost');
define('DB_NAME', 'fog652');
define('DB_USER', 'root');
define('DB_PASS', '');
$dbh =  new PDO('mysql:host='.DB_HOST.';dbname=' .DB_NAME , DB_USER, DB_PASS);
$sql = $dbh->prepare("SET NAMES 'utf8'");
$sql = $dbh->prepare("SET CHARACTER SET utf8");
$sql->execute();


// Setting output buffer
ob_start();
if(!session_start()){
    session_start();
}
// Error Handling
error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT);