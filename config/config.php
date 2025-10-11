<?php

$hostname = "localhost";
$username = "root";
$password = 12345;
$database = "falai";

$connect = new mysqli($hostname, $username, $password, $database);

if($connect->connect_error){
    die("Falha na conexão" . $connect->connect_error);
}

echo "conectado";