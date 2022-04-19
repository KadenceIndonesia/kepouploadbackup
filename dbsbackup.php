<?php

$host = 'localhost';
$username = 'root';
$pass = '';
$database = 'kepo';

// mysql_connect($host, $username, $password) or die('error connect');
// mysql_select_db($database) or die (mysql_error());

$mysqli = new mysqli("$host", "$username", "$pass", "$database") or die(mysql_error());
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
