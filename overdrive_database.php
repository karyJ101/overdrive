<?php

$localhost = "localhost";
$username  = "kary_johnson";
$password  = "password";
$database  = "summer_webproject";

$conn = new mysqli($localhost, $username, $password, $database);

if($conn->connect_error){
    die("Connection Error". $conn->connect_error);
}
else{
    //echo 'Connection Success';
}