<?php

$serverName = "localhost";
$userName = "root";
$password = "";
$nameDataBase = "PostOffice";

$connectMySQL = new mysqli($serverName, $userName, $password, $nameDataBase);

mysqli_query($connectMySQL, "SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");


if (!isset($_GET['NumDiv'])) {

    header('Location: ' . "http://localhost/dashboard/CourseWork/MainContent/MenuForCustomer/ReceivedPost/ReceivedPostInterface.php");

} else {



}

?>