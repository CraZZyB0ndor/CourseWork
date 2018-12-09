<?php

$serverName = "localhost";
$userName = "root";
$password = "";
$nameDataBase = "PostOffice";

$connectMySQL = new mysqli($serverName, $userName, $password, $nameDataBase);

mysqli_query($connectMySQL, "SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");

include 'functionsForDisplay.php';

$ArrResult = DetermineInfoAboutUser($connectMySQL);

if ($ArrResult === false) {

    echo '#ERROR#';

}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="StyleForCustomerMenu.css">
    <link href="https://fonts.googleapis.com/css?family=Yeseva+One" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lobster|Open+Sans+Condensed:300" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Russo+One" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Kurale" rel="stylesheet">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Головне меню (НАША ПОШТА)</title>
</head>
<body onload="startTime()">

<main>

    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="application/x-www-form-urlencoded">

    <div id="ProfileClient" class="blockElement" style="background-image: url('Images/screensaver6.jpg');">


        <a href="DeleteCookies.php" class="LT"><img id="LogOUT" name="LogOUT" src="Images/logout.png"></a>

        <div id="Time">

            <p id="DayYearMonth"></p>
            <p id="ClockTime"></p>

        </div>

        <div id="MainInfoAboutUser">

            <div id="DisplayPost">

                <div class="SR"><span title="Кількість відправленої пошти, яка знаходиться в дорозі">3</span><img src="Images/long-arrow-pointing-up.png"></div>
                <div class="SR"><span title="Кількість пошти, яка чекає підтвердження">5</span><img src="Images/down-arrow.png"></div>

            </div>

            <div id="AvatarANDFIO">

                <div id="UserPhoto"><img src="UserPhoto\user.png"></div>
                <p><?php echo $ArrResult['FirstName'] . " " . $ArrResult['Patronymic']; ?></p>

            </div>

        </div>

        <a href="" class="RegProfile statistic">СТАТИСТИКА</a>
        <p class="RegProfile email"><?php echo $_COOKIE['E-mail']; ?></p>
        <a href="" class="RegProfile regUserProf">РЕДАГУВАТИ ПРОФІЛЬ</a>

        <img id="Settings" src="Images/settings.png">








    </div>

    </form>

    <div id="Archive" class="blockElement">

        <div id="ArchiveSent" >

            <a href="" >відправити пошту</a>
            <img src="Images/send.png" >

        </div>

        <div id="ArchiveReceived" >

            <a href="" class="SendLetter">Прийняти пошту</a>

        </div>

    </div>


    <div id="SendANDHelp" >

        <div id="SendPost">

            <a href="" class="SendLetter">Архів прийнятої і відправленої пошти</a>

        </div>

        <div id="OnlineHelp">

            5

        </div>

    </div>




</main>

<script src="Date.js"></script>

</body>
</html>
