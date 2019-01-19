<?php

session_start();

$serverName = "localhost";
$userName = "root";
$password = "";
$nameDataBase = "PostOffice";

$connectMySQL = new mysqli($serverName, $userName, $password, $nameDataBase);

mysqli_query($connectMySQL, "SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");

include 'ProcessingSortAndFilter.php';

$modal_text = "";

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
    <link rel="stylesheet" href="ReceivedPostInterfaceStyle.css">
    <title>ОТРИМАТИ ПОШТУ</title>
    <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
    <script src="FilterJS.js"></script>

</head>

<div id="ModalWindow">


    <div id="MainContentModalWindow">
        <p id="TextActionModalWindow"></p>
        <img src="Images/mail.png" onclick="document.getElementById('ModalWindow').style.display = 'none';">
    </div>

</div>

<?php

if ( isset($_POST['confirm']) ) {

    echo "<script>document.getElementById('TextActionModalWindow').textContent = 'Чудово! Ваша пошта прийнята! Повідомлення відправлене до архіву';</script>";
    echo "<script>document.getElementById('ModalWindow').style.display = 'flex';</script>";

    //$query_confirm = "UPDATE `Statuspost` SET `StatusOfPost` = 'Прийнято' WHERE `ID-post` =" . $_POST['ID'];

    //mysqli_query($connectMySQL, $query_confirm);

}

if ( isset($_POST['disregard']) ) {

    echo "<script>document.getElementById('TextActionModalWindow').textContent = 'Ви відмовились від пошти! Повідомлення відправлене до архіву'</script>";
    echo "<script>document.getElementById('ModalWindow').style.display = 'flex';</script>";

    echo "<script>alert('". $_GET['ID'] ."');</script>";

    //$query_confirm = "UPDATE `Statuspost` SET `StatusOfPost` = 'Відмовлено' WHERE `ID-post` =" . $_POST['ID'];

    //mysqli_query($connectMySQL, $query_confirm);

}

$ResultPosts = DisplayPosts($connectMySQL, "");

if (isset($_POST['Search'])) {

    //U.`SecondName`, U.`FirstName`, U.`Patronymic`, U.`E-mail` S.`DateOfReceipt` P.`TypePost`

    $_SESSION['search'] = "AND (U.`SecondName` LIKE '%". $_POST['SearchInput'] ."%' OR U.`FirstName` LIKE '%". $_POST['SearchInput'] ."%' OR 
    U.`Patronymic` LIKE '%". $_POST['SearchInput'] ."%' OR U.`E-mail` LIKE '%". $_POST['SearchInput'] ."%' OR S.`DateOfReceipt` LIKE '%". $_POST['SearchInput'] ."%' OR
    P.`TypePost` LIKE '%". $_POST['SearchInput'] ."%')";

    $ResultPosts = ProcessingPostData($connectMySQL);

    $_SESSION['SearchInput'] = $_POST['SearchInput'];

}

?>

<body style="background-image: url('Images/blur-bright-close-up-1405773.jpg'); background-attachment: fixed;">

<main>



    <a href="http://localhost/dashboard/CourseWork/MainContent/MenuForCustomer/ReceivedPost/ClearSession.php"><img src="Images/restart.png" alt="back" id="RestartIMG" title="ГОЛОВНЕ МЕНЮ"></a>

    <p id="HeaderDocument">ПРИЙНЯТИ ПОШТУ</p>

    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="application/x-www-form-urlencoded">

        <div id="BlockOfMainData">

            <div id="SearchPost">

                <p>Пошук:</p>
                <input type="text" id="InputSearchPost" name="SearchInput">
                <div>
                    <img src="Images/delete.png" onclick="document.getElementById('InputSearchPost').value = '';">
                </div>
                <input type="submit" value="🔍" alt="Search" title="Пошук" name="Search">

            </div>

            <div id="ControlPosts">


                <div id="SortFilter">

            <img src="Images/sort.png" title="Сортування" onclick="TrueOpenWindow('Sort');">

            <div class="SortMenu" id="SortMenuID">

                <div>

                    <p>СОРТУВАТИ ПО:</p>

                    <div>

                        <div>
                            <input id="SortType" type="submit" name="TypeS" value="ТИП">
                            <img class="SortIMG" src="Images/x-button.png"
                                 onclick="

            document.getElementById('SortType').style.cursor = 'pointer';

            setTimeout(Display23, 400);

            WidthHeight('From');

            document.getElementsByClassName('SortIMG')[0].style.display = 'none';

                                    ">
                        </div>

                        <div>
                            <input id="SortSender" type="submit" name="SenderS" value="АДРЕСАТ">
                            <img class="SortIMG" src="Images/x-button.png"
                                 onclick="

            document.getElementById('SortSender').style.cursor = 'pointer';

            setTimeout(Display13, 400);

            WidthHeight('From');

            document.getElementsByClassName('SortIMG')[1].style.display = 'none';

                                 ">
                        </div>

                        <div>
                            <input id="SortTime" type="submit" name="TimeS" value="ЧАС">
                            <img class="SortIMG" src="Images/x-button.png"
                                 onclick="

            document.getElementById('SortTime').style.cursor = 'pointer';

            setTimeout(Display12, 400);

            WidthHeight('From');

            document.getElementsByClassName('SortIMG')[2].style.display = 'none';

                                ">
                        </div>

                    </div>

                </div>

            </div>

                    <script>

                        function WidthHeight(condition) {

                            if (condition === 'To') {

                                document.getElementsByClassName('SortMenu')[0].style.height = '75px';
                                document.getElementById('SortType').style.width = '130px';
                                document.getElementById('SortSender').style.width = '130px';
                                document.getElementById('SortTime').style.width = '130px';

                            } else if (condition === 'From') {

                                document.getElementsByClassName('SortMenu')[0].style.height = '150px';
                                document.getElementById('SortType').style.width = '160px';
                                document.getElementById('SortSender').style.width = '160px';
                                document.getElementById('SortTime').style.width = '160px';

                            }

                        }


                        function SortType(condition) {


                            if (condition === 'Along') {

                                document.getElementById('SortType').style.cursor = 'default';


                                document.getElementById('SortSender').style.opacity = '0';
                                document.getElementById('SortTime').style.opacity = '0';

                                setTimeout(Displayy23, 400);

                                WidthHeight('To');

                                document.getElementsByClassName('SortIMG')[0].style.display = 'flex';

                            }


                        }


                        function Display23() {

                            document.getElementById('SortSender').style.display = 'flex';
                            document.getElementById('SortTime').style.display = 'flex';

                            document.getElementById('SortSender').style.opacity = '1';
                            document.getElementById('SortTime').style.opacity = '1';
                        }

                        function Displayy23() {

                            document.getElementById('SortSender').style.display = 'none';
                            document.getElementById('SortTime').style.display = 'none';

                        }

                        function SortSender(condition) {


                            if (condition === 'Along') {

                                document.getElementById('SortSender').style.cursor = 'default';

                                document.getElementById('SortType').style.opacity = '0';
                                document.getElementById('SortTime').style.opacity = '0';

                                setTimeout(Displayy13, 100);

                                WidthHeight('To');

                                document.getElementsByClassName('SortIMG')[1].style.display = 'flex';

                            }

                        }

                        function Display13() {

                            document.getElementById('SortType').style.display = 'flex';
                            document.getElementById('SortTime').style.display = 'flex';

                            document.getElementById('SortType').style.opacity = '1';
                            document.getElementById('SortTime').style.opacity = '1';

                        }

                        function Displayy13() {

                            document.getElementById('SortType').style.display = 'none';
                            document.getElementById('SortTime').style.display = 'none';

                        }

                        function SortTime(condition) {

                            if (condition === 'Along') {

                                document.getElementById('SortTime').style.cursor = 'default';

                                document.getElementById('SortType').style.opacity = '0';
                                document.getElementById('SortSender').style.opacity = '0';

                                setTimeout(Displayy12, 100);

                                WidthHeight('To');

                                document.getElementsByClassName('SortIMG')[2].style.display = 'flex';

                            }

                        }

                        function Display12() {

                            document.getElementById('SortType').style.display = 'flex';
                            document.getElementById('SortSender').style.display = 'flex';

                            document.getElementById('SortType').style.opacity = '1';
                            document.getElementById('SortSender').style.opacity = '1';

                        }

                        function Displayy12() {

                            document.getElementById('SortType').style.display = 'none';
                            document.getElementById('SortSender').style.display = 'none';
                        }


                    </script>

                    <?php

                    if (isset($_POST['TypeS'])) {

                        //echo "<script>SortType('Along');</script>";

                        $_SESSION['order'] = "ORDER BY P.`TypePost`";

                        $ResultPosts = ProcessingPostData($connectMySQL);

                        $_SESSION['TypeS'] = "<script>SortType('Along');</script>";

                    }

                    if (isset($_POST['SenderS'])) {

                        //echo "<script>SortSender('Along');</script>";

                        $_SESSION['order'] = "ORDER BY U.`SecondName`";

                        $ResultPosts = ProcessingPostData($connectMySQL);

                        $_SESSION['TypeS'] = "<script>SortSender('Along');</script>";

                    }

                    if (isset($_POST['TimeS'])) {

                        //echo "<script>SortTime('Along');</script>";

                        $_SESSION['order'] = "ORDER BY S.`DateOfReceipt`";

                        $ResultPosts = ProcessingPostData($connectMySQL);

                        $_SESSION['TypeS'] = "<script>SortTime('Along');</script>";
                    }

                    //

                    if (isset($_POST['RefreshPost'])) {

                        if (key_exists('SearchInput', $_SESSION)) {

                            unset($_SESSION['SearchInput']);
                        }

                        if (key_exists('TypeS', $_SESSION)) {

                            unset($_SESSION['TypeS']);

                        }

                        if (key_exists('FilterS', $_SESSION)) {

                            unset($_SESSION['FilterS']);

                        }

                    }


                    ?>

            <img src="Images/filter.png" title="Фільтрація" onclick="TrueOpenWindow('Filter');">

            <div class="FilterMenu" id="FilterCheckerClass">

                <p>Фільтрувати по:</p>

                <div id="TypePost">

                    <p>Тип: </p>

                    <select name="FTPost" id="TypeSendID">

                        <option value="Всі типи пошти">Всі типи пошти</option>
                        <option value="Лист" id="LetterS">Лист</option>
                        <option value="Посилка">Посилка</option>
                        <option value="Гроші">Гроші</option>

                    </select>

                </div>


                <div id="TimeReceived">

                    <p>Час: </p>

                    <select name="FTTime" id="TimeSendID" onchange="SelectTab();">

                        <option value="Весь час" id="AllTime">Весь час</option>
                        <option value="С [--] ДО [--]" id="CertainTime">С [--] ДО [--]</option>

                    </select>

                </div>

                <div id="DateBetween">

                    <div>
                        <p>З:</p>
                        <input name="FromTime" id="FromDate" type="datetime-local" min="2018-12-01T00:00" onchange="ValidationFromDate();">
                    </div>

                    <div>
                        <p>ПО:</p>
                        <input name="ToTime" id="ToDate" type="datetime-local" onchange="ValidationFromDate();">
                    </div>


                </div>

                <input type="submit" id="FilterButton" name="ApplyFilter" value="Фільтрувати">
                <p id="DateError">Вкажіть дві дати правильно</p>

            </div>


                    <?php


                    if (isset($_POST['ApplyFilter'])) {

                        if ($_POST['FTPost'] !== 'Всі типи пошти') {

                            if ($_POST['FTTime'] !== 'Весь час') {

                                $query_time_type = "AND P.`TypePost` = '". $_POST['FTPost'] ."' AND S.`DateOfReceipt` BETWEEN '". $_POST['FromTime'] ."' AND '". $_POST['ToTime'] ."'";

                                $_SESSION['filter'] = $query_time_type;

                                $ResultPosts = ProcessingPostData($connectMySQL);

                                $_SESSION['FilterS'] = "<script>

                                        $(\"#TypeSendID\").val('". $_POST['FTPost'] ."').change();
                                        $(\"#TimeSendID\").val('". $_POST['FTTime'] ."').change();
                                        
                                        document.getElementById('FromDate').value = '". $_POST['FromTime'] ."';
                                        document.getElementById('ToDate').value = '". $_POST['ToTime'] ."';
                                        
                                      SelectTab();
                                        
                                      </script>";


                            } else {

                                $query_type = "AND P.`TypePost` = '". $_POST['FTPost'] ."'";

                                $_SESSION['filter'] = $query_type;

                                $ResultPosts = ProcessingPostData($connectMySQL);

                                $_SESSION['FilterS'] = "<script>$(\"#TypeSendID\").val('". $_POST['FTPost'] ."').change();</script>";
                            }

                        } else {

                            if ($_POST['FTTime'] !== 'Весь час') {

                                $query_time = "AND S.`DateOfReceipt` BETWEEN '". $_POST['FromTime'] ."' AND '". $_POST['ToTime'] ."'";

                                $_SESSION['filter'] = $query_time;

                                $ResultPosts = ProcessingPostData($connectMySQL);

                                $_SESSION['FilterS'] = "<script>

                                        $(\"#TimeSendID\").val('". $_POST['FTTime'] ."').change();
                                        
                                        document.getElementById('FromDate').value = '". $_POST['FromTime'] ."';
                                        document.getElementById('ToDate').value = '". $_POST['ToTime'] ."';
                                        
                                      SelectTab();
                                        
                                      </script>";

                            } else {

                                unset($_SESSION['filter']);
                                unset($_SESSION['FilterS']);

                                $ResultPosts = ProcessingPostData($connectMySQL);

                            }

                        }


                    }

                    ?>



                    <?php

                    if (key_exists('SearchInput', $_SESSION)) {

                        echo "<script>document.getElementById('InputSearchPost').value='" . $_SESSION['SearchInput'] . "';</script>";
                    }

                    if (key_exists('TypeS', $_SESSION)) {

                        echo $_SESSION['TypeS'];

                    }

                    if (key_exists('FilterS', $_SESSION)) {

                        echo $_SESSION['FilterS'];

                    }

                    ?>


                </div>


                <div id="ActionPost">

            <input type="submit" value="ПРИЙНЯТИ">
            <input type="submit" value="ВІДМОВИТИСЯ">

                </div>


                <div id="RefreshHelp">


            <input type="submit" src="Images/refresh.png" title="Оновити пошту" value="↺" name="RefreshPost">

            <img src="Images/question.png" alt="help" title="Допомога">


                </div>


            </div>

    </div>



        <div id="Posts">

            <?php

            if ( gettype($ResultPosts) == "string" ) {

                echo "<p id='NonePost'>".$ResultPosts."</p>";

            } else if ( gettype($ResultPosts) == "object" ) {


                for ($i = 0; true; $i++) {

                    $arr_select_some_posts = mysqli_fetch_row($ResultPosts);

                    if ($arr_select_some_posts != NULL) {

                        $arrayDesc[0] = '';

                        if ($arr_select_some_posts[7] == 'Лист') {

                            $str = (string) $arr_select_some_posts[4];
                            $arrayDesc = explode('æ325691çƒ©h', $str, strlen($str)-11);

                            $arrayDesc[0] = " (" . $arrayDesc[0] . ") ";
                        }

                        $ID = $arr_select_some_posts[6];

                        echo "<div class=\"PostElement\">

                <div>

                    <label class=\"checkbox\">
                        <input type=\"checkbox\" name='C". $ID ."'/>
                        <div class=\"checkbox__text\"></div>
                    </label>


                    <img src=\"Images/open-mail.png\" title=\"Відкрити повідомлення\">
                </div>

                <div>

                    <a class=\"CheckPost\" title=\"Відкрити повідомлення\" href='ViewPost.php?NumDiv=" . "$ID'".">
                        
                        <div>
                            <p style=\"font-weight: bold; margin-right: 15px;\">Від: </p>
                            <p>
                            $arr_select_some_posts[0] $arr_select_some_posts[1] $arr_select_some_posts[2]
                            ($arr_select_some_posts[3])
                            </p>
                        </div>

                        <div>
                            <p style=\"font-weight: bold; margin-right: 15px;\">Тип:</p>
                            <p style='font-style: italic;'> " . $arr_select_some_posts[7] . $arrayDesc[0] . "</p>
                        </div>

                        <div>
                            <p style=\"font-weight: bold; margin-right: 15px;\">Час доставки:</p>
                            <p>$arr_select_some_posts[5]</p>
                        </div>

                    </a>

                    <div>

                        <input type=\"submit\" value=\"ПРИЙНЯТИ\" name='confirm'>
                        <input type=\"submit\" value=\"ВІДМОВИТИСЯ\" name='disregard' onclick='window.location.href = \"http://localhost/dashboard/CourseWork/MainContent/MenuForCustomer/ReceivedPost/ReceivedPostInterface.php?ID=". $ID ."\"'" . ">                  

                    </div>

                </div>
                
                

            </div> ";


                    } else {

                        break;

                    }
                }

            }



            ?>



    </form>

</main>

</body>


</html>