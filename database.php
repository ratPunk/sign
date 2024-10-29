<?php

$host = "localhost";
$username = "root";
$password = "root";
$dbname = "database";

$mysqli = new mysqli($host, $username, $password, $dbname);

if($mysqli->connect_errno){
    die("Ошибка подключения" . $mysqli->connect_errno);
}