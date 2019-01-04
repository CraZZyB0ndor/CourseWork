<?php

session_start();

$serverName = "localhost";
$userName = "root";
$password = "";
$nameDataBase = "PostOffice";

$connectMySQL = new mysqli($serverName, $userName, $password, $nameDataBase);

mysqli_query($connectMySQL, "SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");


include 'GetDataFromDB.php';
include 'CheckToEmail.php';

$ArrFSPNameUser = DetermineInfoAboutUser($connectMySQL);

if ($ArrFSPNameUser == false) {

    print '#ERROR';
}


if ( isset($_POST['SendLetterButton']) ) {

    $_SESSION['Email'] = $_POST['Email_to_user'];
    $_SESSION['Theme'] = $_POST['ThemeLetterPHP'];
    $_SESSION['Content'] = $_POST['MainContentLetterPHP'];

    $ErrorReceived = CheckEmail($connectMySQL);

} else {

    $ErrorReceived = "";
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
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display+SC|Russo+One" rel="stylesheet">
    <link rel="stylesheet" href="StyleForSendMailCustomer.css">
    <title>Відправити пошту</title>
</head>
<body style="background-image: url('Images/blur-bright-close-up-1405773.jpg'); background-attachment: fixed;">

<main>

    <p id="HeaderDocument">відправка пошти</p>

    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="application/x-www-form-urlencoded">

        <div id="BlockOfMainData">

        <div id="ToUser">

            <span class="HeadMainInfo">Кому: </span>
            <input id="InputDataToUser" type="text" list="users" name="Email_to_user">
            <img class="ClearToField" src="Images/eraser.png" onclick="document.getElementById('InputDataToUser').value = '';" title="Очистити поле">

        </div>

            <?php //echo "<script>alert('". date("Y-m-d H:i:s") ."');</script>" ?>

            <datalist id="users">

                <?php


                $query_num_users = "SELECT COUNT(`Sender-ID`) FROM `User`";

                $data_num_users = mysqli_query($connectMySQL, $query_num_users);

                $NumOfUser = mysqli_fetch_array($data_num_users);


                for ($i = 0; $i <= $NumOfUser[0]; $i++ ) {

                    $ArrInfoUser = DetermineAllUsers($connectMySQL, $i);

                    if ($ArrInfoUser != false) {

                            print "<option>". $ArrInfoUser['SecondName'] . " " . $ArrInfoUser['FirstName'] . " " . $ArrInfoUser['Patronymic'] .
                           " (" . $ArrInfoUser['E-mail'] .") " ."</option>";

                    }
                }

                ?>

            </datalist>

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




        <div class="ForLetter">

            <input type="text" placeholder="Тема" id="ThemeLetter" name="ThemeLetterPHP">

            <textarea placeholder="Основна частина…" id="MainContentLetter" name="MainContentLetterPHP"></textarea>


            <span class="ErrorReceived"><?php echo $ErrorReceived; ?></span>

            <input type="submit" name="SendLetterButton"  class="SendKey" value="НАДІСЛАТИ"/>

        </div>


        <div class="ForBox">



            <div class="TypeOfBox">

                <span class="headToBox">Тип:</span>

                <select name="ChooseTypeOfBox" id="SelectChooseBox">

                    <option id="">Пристрої</option>
                    <option id="">Друковані вироби</option>
                    <option id="">Вироби із дерева</option>
                    <option id="">Вироби із тканини</option>
                    <option id="">Вироби із металу</option>
                    <option id="">Вироби зі скла</option>
                    <option id="">Речовини</option>

                </select>

            </div>

            <div class="weightBox">

                <span class="headToBox">Вага:</span>

                <input type="number" min="1" max="100"  step="1" class="InputFieldBox">

                <span class="headToBox">КГ</span>

            </div>

            <div id="ContainerDescBox">

                <div id="WaringCheckBox">

                    <input type="checkbox" class="InputFieldBox" id="WaringCheckBoxElement">
                    <span class="waringBox">Необхідна додаткова обережність під час транспортування</span>

                </div>

                <span class="headToBox headDescBox">Опис:</span>

                <textarea type="text" class="InputFieldBox" id="DescBox"></textarea>

            </div>

            <input type="submit" name="SendBoxButton"  class="SendKey" value="НАДІСЛАТИ"/>



        </div>


        <div class="ForCash">

            <div class="TypeOfCash">

                <span class="headToCash">Сума:</span>

                <input type="number" min="1" class="InputFieldCash">

                <select name="Currency" id="CurrencyStyle">

                    <option id="UA">ГРИВНІ</option>
                    <option id="RU">РУБЛІ</option>
                    <option id="EU">ЄВРО</option>
                    <option id="US">ДОЛАРИ</option>
                    <option id="EN">ФУНТИ</option>

                </select>

            </div>


            <div id="DescriptionMoney">

                <span class="headToCash headDescCash">Опис:</span>

                <textarea type="text" class="InputFieldBox" id="DescBox"></textarea>

            </div>

            <input type="submit" name="SendCashButton"  class="SendKey" value="НАДІСЛАТИ"/>

        </div>



    </form>

</main>

<script src="JavaScroptForSendMailCustomers.js"></script>

<?php


if ( array_key_exists('Email', $_SESSION) ) {

    print "<script>document.getElementById('InputDataToUser').value = '". $_SESSION['Email'] ."';</script>";
}

if ( array_key_exists('Theme', $_SESSION) ) {

    print "<script>document.getElementById('ThemeLetter').value = '". $_SESSION['Theme'] ."';</script>";
}

if ( array_key_exists('Content', $_SESSION) ) {

    print "<script>document.getElementById('MainContentLetter').value = '". $_SESSION['Content'] ."';</script>";
}

?>

</body>
</html>