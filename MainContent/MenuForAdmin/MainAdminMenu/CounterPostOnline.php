<?php

$serverName = "localhost";
$userName = "root";
$password = "";
$nameDataBase = "PostOffice";

$connectMySQL = new mysqli($serverName, $userName, $password, $nameDataBase);

mysqli_query($connectMySQL, "SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");

$query_num_sent_post = "SELECT COUNT(P.`ID-post`) FROM `Waybill` W, `Statuspost` S, `Post` P
                        WHERE W.`ID-post` = P.`ID-post` AND P.`ID-post` = S.`ID-post` AND
                        S.`StatusOfPost` =  'Чекає на підтвердження'";

$a = mysqli_query($connectMySQL, $query_num_sent_post);

$sent_post = mysqli_fetch_array($a);

echo "<span>" . $sent_post[0] . "</span>";

?>