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

    <div id="ProfileClient" class="blockElement" style="background-image: url('Images/blur-bright-close-up-1405773.jpg'); background-attachment: fixed">


        <a href="DeleteCookies.php" class="LT"><img id="LogOUT" name="LogOUT" src="Images/logout.png"></a>

        <div id="Time">

            <p id="DayYearMonth"></p>
            <p id="ClockTime"></p>

        </div>

        <div id="MainInfoAboutUser">

            <div id="DisplayPost">

                <div class="SR"><span title="Кількість відправленої пошти, яка знаходиться в дорозі" id="TO"></span><img src="Images/long-arrow-pointing-up.png"></div>
                <div class="SR"><span title="Кількість пошти, яка чекає підтвердження" id="FROM"></span><img src="Images/down-arrow.png"></div>

            </div>

            <div id="AvatarANDFIO">

                <div id="UserPhoto"><img src="UserPhoto\man-user.png"></div>
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


           <a id="ArchiveSent" href="SendPost/SendMailCustomer.php" style="background-image: url('Images/blur-bright-close-up-1405773.jpg'); background-attachment: fixed;">

        <span>відправити пошту</span>
            <img src="Images/email.png" >

        </a>




        <a id="ArchiveReceived" href="ReceivedPost/ReceivedPostInterface.php" style="background-image: url('Images/blur-bright-close-up-1405773.jpg'); background-attachment: fixed;">

            <span class="SendLetter">Прийняти пошту <sup id="FROMT" style="background-color: darkred;
    border-radius: 100px; color: white; width: 40px; height: 40px; margin-right: 10px; display: flex; justify-content: center; align-items: center;"></sup></span>
            <img src="Images/envelope.png">

        </a>

    </div>


    <div id="SendANDHelp" >

        <a id="ArchiveSendANDReceivedPost" style="background-image: url('Images/blur-bright-close-up-1405773.jpg'); background-attachment: fixed;">

            <span class="SendLetter">Архів прийнятої і відправленої пошти <sup id="FROMTO" style="background-color: darkred;
    border-radius: 100px; color: white; width: 40px; height: 40px; margin-right: 10px; display: flex; justify-content: center; align-items: center;"></sup></span>
            <img src="Images/branding.png">
            
        </a>

        
        <a id="OnlineHelp" style="background-image: url('Images/blur-bright-close-up-1405773.jpg'); background-attachment: fixed;">

            <span class="SendLetter">онлайн допомога</span>
            <img src="Images/question-mark.png">

        </a>

    </div>




</main>

<script src="Date.js"></script>

<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>

<script>


    //location.reload(true);


    $("#TO").load("TO.php");
    $("#FROM").load("FROM.php");
    $("#FROMT").load("FROM.php");
    $("#FROMTO").load("FROMTO.php");

    setInterval(function(){

        $("#TO").load("TO.php");
        $("#FROM").load("FROM.php");
        $("#FROMT").load("FROM.php");
        $("#FROMTO").load("FROMTO.php");

    }, 3000);

</script>

</body>
</html>
