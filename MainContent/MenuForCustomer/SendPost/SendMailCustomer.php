<?php

$serverName = "localhost";
$userName = "root";
$password = "";
$nameDataBase = "PostOffice";

$connectMySQL = new mysqli($serverName, $userName, $password, $nameDataBase);

mysqli_query($connectMySQL, "SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");


include 'GetDataFromDB.php';

$ArrFSPNameUser = DetermineInfoAboutUser($connectMySQL);

if ($ArrFSPNameUser == false) {

    print '#ERROR';
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Russo+One" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Cuprum" rel="stylesheet">
    <link rel="stylesheet" href="StyleForSendMailCustomer.css">
    <title>Відправити пошту</title>
</head>
<body>

<main>

    <p id="HeaderDocument">відправка пошти</p>

    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="application/x-www-form-urlencoded">

        <div id="BlockOfMainData">

        <div id="ToUser">

            <span class="HeadMainInfo">Кому: </span>
            <input id="InputDataToUser" type="text">
            <img class="ClearToField" src="Images/eraser.png" onclick="document.getElementById('InputDataToUser').value = '';" title="Очистити поле">
            <img class="CheckSearchEmail CheckTo" src="Images/confirm.png">

        </div>


        <div id="FromUser">

            <span class="HeadMainInfo">Від кого: </span>
            <span id="InfoUserFromDB">
                <?php

                echo $ArrFSPNameUser['SecondName'] . ' ' . $ArrFSPNameUser['FirstName'] . ' ' . $ArrFSPNameUser['Patronymic'] . ' (' . $_COOKIE['E-mail'] . ') ';

                ?>
            </span>

        </div>

        </div>

        <hr noshade style="height: 11%; width: 1px; background-color: black; position: absolute; left: 50%; top: 8%">

    </form>

</main>

</body>
</html>