<?php
ini_set("display_error", 1);

//************** Session Check *****************//

session_start();
if(isset($_SESSION["user_id"] ) && !empty($_SESSION["user_id"] )){
    $userId = $_SESSION["user_id"]; 
    include 'overdrive_database.php';
}
else{
    header("Location: login.php");
}


if($_GET["logout"] === "1"){
    session_destroy();
    header("Location: login.php");
}




