<?php

session_start();

date_default_timezone_set('Ukraine');

$serverName = "localhost";
$userName = "root";
$password = "";
$nameDataBase = "PostOffice";

$connectMySQL = new mysqli($serverName, $userName, $password, $nameDataBase);

mysqli_query($connectMySQL, "SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");


include 'GetDataFromDB.php';
include 'CheckToEmail.php';
include 'CheckToBox.php';
include "CheckToCash.php";
include 'SelectItem.php';

$ArrFSPNameUser = DetermineInfoAboutUser($connectMySQL);

if ($ArrFSPNameUser == false) {

    print '#ERROR';
}

$ErrorReceived = "";

$SelectedID = 0;

$TypeOfDisplay = 'none';


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
    <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
</head>
<body style="background-image: url('Images/blur-bright-close-up-1405773.jpg'); background-attachment: fixed;">
<?php

if ( isset($_POST['SendLetterButton']) ) {

    SelectItem();

    $ErrorReceived = CheckEmail($connectMySQL);

    $SelectedID = 1;

    if ( $ErrorReceived == "" ) {

        $TypeOfDisplay = 'flex';
    }

}


if ( isset($_POST['SendBoxButton']) ) {

    SelectItem();

    $ErrorReceived = CheckBox($connectMySQL);

    $SelectedID = 2;

    if ( $ErrorReceived == "" ) {

        $TypeOfDisplay = 'flex';
    }

}


if ( isset($_POST['SendCashButton']) ) {

    SelectItem();

    $ErrorReceived = CheckCash($connectMySQL);

    $SelectedID = 3;

    if ( $ErrorReceived == "" ) {

        $TypeOfDisplay = 'flex';
    }

}

?>
<main>

    <a href="http://localhost/dashboard/CourseWork/MainContent/MenuForCustomer/CustomerMenuPHP.php"><img src="Images/restart.png" alt="back" id="RestartIMG" title="ГОЛОВНЕ МЕНЮ" onclick=""></a>

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

                    <option id="1L" value="лист">лист</option>
                    <option id="2B" value="посилка">посилка</option>
                    <option id="3C" value="грощі">гроші</option>

                </select>

            </div>



        </div>


        <hr noshade style="height: 10.5%; width: 1px; background-color: black; position: absolute; left: 50%; top: 10%; border: none;">




        <div class="ForLetter">

            <input type="text" placeholder="Тема" id="ThemeLetter" name="ThemeLetterPHP">

            <textarea placeholder="Основна частина…" id="MainContentLetter" name="MainContentLetterPHP"></textarea>

            <input type="submit" name="SendLetterButton"  class="SendKey" value="НАДІСЛАТИ"/>

            <span class="ErrorReceived"><?php echo $ErrorReceived; ?></span>

        </div>


        <div class="ForBox">



            <div class="TypeOfBox">

                <span class="headToBox">Тип:</span>

                <select name="ChooseTypeOfBox" id="SelectChooseBox">

                    <option value="Пристрої">Пристрої</option>
                    <option value="Друковані вироби">Друковані вироби</option>
                    <option value="Вироби із дерева">Вироби із дерева</option>
                    <option value="Вироби із тканини">Вироби із тканини</option>
                    <option value="Вироби із металу">Вироби із металу</option>
                    <option value="Вироби із скла">Вироби зі скла</option>
                    <option value="Речовини">Речовини</option>

                </select>

            </div>

            <div class="weightBox">

                <span class="headToBox">Вага:</span>

                <input type="number" min="1" max="100"  step="0.001" class="InputFieldBox" name="WeightOfBox" id="InputFiledBoxID">

                <span class="headToBox">КГ</span>

            </div>

            <div id="ContainerDescBox">

                <div id="WaringCheckBox">

                    <input type="checkbox" class="InputFieldBox" id="WaringCheckBoxElement" name="CheckboxBox">
                    <span class="waringBox">Необхідна додаткова обережність під час транспортування</span>

                </div>

                <span class="headToBox headDescBox">Опис:</span>

                <textarea type="text" class="InputFieldBox" id="DescBox" placeholder="Опис…" name="DescriptionBox"></textarea>

            </div>

            <input type="submit" name="SendBoxButton"  class="SendKey" value="НАДІСЛАТИ"/>

            <span class="ErrorReceived"><?php echo $ErrorReceived; ?></span>

        </div>


        <div class="ForCash">

            <div class="TypeOfCash">

                <span class="headToCash">Сума:</span>

                <input type="number" min="1" class="InputFieldCash" name="SumOfCash" id="InputFieldCashID">

                <select name="Currency" id="CurrencyStyle">

                    <option value="UA">ГРИВНІ</option>
                    <option value="RU">РУБЛІ</option>
                    <option value="EU">ЄВРО</option>
                    <option value="US">ДОЛАРИ</option>
                    <option value="EN">ФУНТИ</option>

                </select>

            </div>


            <div id="DescriptionMoney">

                <span class="headToCash headDescCash">Опис:</span>

                <textarea type="text" class="InputFieldBox" id="DescCash" placeholder="Опис…" name="DescrOfCash"></textarea>

            </div>

            <input type="submit" name="SendCashButton"  class="SendKey" value="НАДІСЛАТИ"/>

            <span class="ErrorReceived"><?php echo $ErrorReceived; ?></span>

        </div>

        <div id="ModalWindowSentPost">

            <div id="AfterSendLetter">

                <div>
                    <img src="Images/checked.png" alt="Sent">
                    <p>ЛИСТ УСПІШНО ВІДПРАВЛЕНО</p>
                </div>


                <div>

                    <a href="GoToMainMenu.php">ПЕРЕЙТИ НА ГОЛОВНУ СТОРІНКУ</a>
                    <a onclick="document.getElementById('ModalWindowSentPost').style.display = 'none';">ЗАЛИШИТИСЯ НА ЦІЙ СТОРІНЦІ</a>

                </div>

            </div>

        </div>

        <?php print "<script>document.getElementById('ModalWindowSentPost').style.display = '". $TypeOfDisplay ."'</script>"; ?>

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


if ( array_key_exists('Weight', $_SESSION) ) {

    print "<script>document.getElementById('InputFiledBoxID').value = '". $_SESSION['Weight'] ."';</script>";
}

if ( array_key_exists('CheckBox', $_SESSION) ) {

    if ( $_SESSION['CheckBox'] == 1 ) {

        print "<script>document.getElementById('WaringCheckBoxElement').checked = true;</script>";

    } else {

        print "<script>document.getElementById('WaringCheckBoxElement').checked = false;</script>";
    }

}

if ( array_key_exists('Description', $_SESSION) ) {

    print "<script>document.getElementById('DescBox').value = '". $_SESSION['Description'] ."';</script>";
}

if ( array_key_exists('CashSum', $_SESSION) ) {

    print "<script>document.getElementById('InputFieldCashID').value = '". $_SESSION['CashSum'] ."';</script>";
}

if ( array_key_exists('DescriptionCash', $_SESSION) ) {

    print "<script>document.getElementById('DescCash').value = '". $_SESSION['DescriptionCash'] ."';</script>";
}

?>

<script>

    switch (<?php echo $SelectedID; ?>) {

        case 1:

            $('#SelectChoose').val('лист');
            DetermineSelectIndex();

            break;

        case 2:

            $('#SelectChoose').val('посилка');
            DetermineSelectIndex();

            break;

        case 3:

            $('#SelectChoose').val('грощі');
            DetermineSelectIndex();

            break;

    }


    $('#SelectChooseBox').val('<?php echo $_SESSION['TypeOfBox']; ?>');

    $('#CurrencyStyle').val('<?php echo $_SESSION['TypeOfCash']; ?>');

</script>

</body>
</html>