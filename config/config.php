<?php

function getConnection(){ 
    $hostname = "localhost";
    $username = "root";
    $password = "";
    $database = "tcc";

   $connect = new mysqli($hostname, $username, $password, $database);

    if($connect->connect_error){
    die("Falha na conexão" . $connect->connect_error);
    }
    return $connect;
}
