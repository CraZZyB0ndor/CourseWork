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

            <div id="ChooseType">

                <span id="titleToListPost">вид пошти:</span>

                <select name="ChooseTypeOfPost" id="SelectChoose" onchange="DetermineSelectIndex();">

                    <option id="1L">лист</option>
                    <option id="2B">посилка</option>
                    <option id="3C">грощі</option>

                </select>

            </div>



        </div>


        <hr noshade style="height: 10.5%; width: 1px; background-color: black; position: absolute; left: 50%; top: 10%; border: none;">



        <div class="HeaderOfChooseType"><span id="HeaderForTextForChooseType"></span></div>



        <div class="ForLetter">

            <input type="text" placeholder="Тема" id="ThemeLetter">

            <input type="text" placeholder="Основна частина…" id="MainCintentLetter">


            <span id="ErrorReceived"></span>

            <a href=""></a>

        </div>


        <div class="ForBox">



        </div>


        <div class="ForCash">



        </div>



    </form>

</main>

<script src="JavaScroptForSendMailCustomers.js"></script>

</body>
</html>