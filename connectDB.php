<?php
/*$servername = "localhost";
$DBusername = "root";
$DBpassword = "";
$basename = "mysamplesitedb";*/
$url = getenv('JAWSDB_URL');
$dbparts = parse_url($url);

$hostname = $dbparts['host'];
$username = $dbparts['user'];
$password = $dbparts['pass'];
$database = ltrim($dbparts['path'],'/');

$conn = new mysqli($hostname, $username, $password, $database);

  
$conn->set_charset("utf8");

?>