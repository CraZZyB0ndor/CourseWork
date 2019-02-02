<?php

session_start();

$serverName = "localhost";
$userName = "root";
$password = "";
$nameDataBase = "PostOffice";

$connectMySQL = new mysqli($serverName, $userName, $password, $nameDataBase);

mysqli_query($connectMySQL, "SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");


?>
<!doctype html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="https://fonts.googleapis.com/css?family=Russo+One" rel="stylesheet">

    <link rel="stylesheet" href="MainAdminMenuStyle.css">

    <title>Головне меню АДМІНІСТРАТОРА</title>

</head>
<body>

<header>

    <div>
        <a href="ExitAndClearSessionAndCookie.php">
            <img src="Images/Exit.png">
        </a>
    </div>

    <div>
        <a href="MainAdminMenuInterface.php">
            <p>онлайн пошта</p>
            <sup id="CounterOnlPost"></sup>
        </a>
    </div>

    <div>
        <a href="">
            <p>оброблена пошта</p>
            <sup id="CounterPostChanged"></sup>
        </a>
    </div>

    <div>
        <a href="">
            <p>Користувачі</p>
            <sup id="CounterUsers"></sup>
        </a>
    </div>

    <div>
        <a href="">
            <img src="Images/WriteLetter.png">
        </a>
    </div>

    <div>
        <a href="">
            <img src="Images/Statistic.png">
        </a>
    </div>

    <div>
        <a href="">
            <img src="Images/SQL.png">
        </a>
    </div>

    <div>
        <p>Адмін</p>
    </div>

</header>


<main>



</main>

<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>

<script>

    $("#CounterOnlPost").load("CounterPostOnline.php");
    $("#CounterPostChanged").load("CounterPostChecked.php");
    $("#CounterUsers").load("CounterCustomers.php");

    setInterval(function(){

        $("#CounterOnlPost").load("CounterPostOnline.php");
        $("#CounterPostChanged").load("CounterPostChecked.php");
        $("#CounterUsers").load("CounterCustomers.php");

    }, 3000);

</script>

</body>
</html>
