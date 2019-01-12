<?php

$serverName = "localhost";
$userName = "root";
$password = "";
$nameDataBase = "PostOffice";

$connectMySQL = new mysqli($serverName, $userName, $password, $nameDataBase);

mysqli_query($connectMySQL, "SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");

include 'SelectInfoAboutPost.php';

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

}

if ( isset($_POST['disregard']) ) {

    echo "<script>document.getElementById('TextActionModalWindow').textContent = 'Ви відмовились від пошти! Повідомлення відправлене до архіву'</script>";
    echo "<script>document.getElementById('ModalWindow').style.display = 'flex';</script>";

}

$ResultPosts = DisplayPosts($connectMySQL);

?>

<body style="background-image: url('Images/blur-bright-close-up-1405773.jpg'); background-attachment: fixed;">

<main>



    <a href="http://localhost/dashboard/CourseWork/MainContent/MenuForCustomer/CustomerMenuPHP.php"><img src="Images/restart.png" alt="back" id="RestartIMG" title="ГОЛОВНЕ МЕНЮ"></a>

    <p id="HeaderDocument">ПРИЙНЯТИ ПОШТУ</p>

    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="application/x-www-form-urlencoded">

        <div id="BlockOfMainData">

            <div id="SearchPost">

                <p>Пошук:</p>
                <input type="text" id="InputSearchPost">
                <img src="Images/search.png" alt="Search">

            </div>


            <div id="ControlPosts">


                <div id="SortFilter">

            <img src="Images/sort.png" title="Сортування">
            <div></div>

            <img src="Images/filter.png" title="Фільтрація">
            <div></div>

                </div>


                <div id="ActionPost">

            <input type="submit" value="ПРИЙНЯТИ">
            <input type="submit" value="ВІДМОВИТИСЯ">

                </div>


                <div id="RefreshHelp">


            <input type="image" src="Images/refresh.png" title="Оновити пошту" style="outline: none;">

            <img src="Images/question.png" alt="help" title="Допомога">


                </div>


            </div>

    </div>



        <div id="Posts">

            <?php

            if ( gettype($ResultPosts) == "string" ) {

                echo "<p>".$ResultPosts."</p>";

            } else if ( gettype($ResultPosts) == "object" ) {


                for ($i = 0; true; $i++) {

                    $arr_select_some_posts = mysqli_fetch_row($ResultPosts);

                    if ($arr_select_some_posts != NULL) {


                        echo "<div class=\"PostElement\">

                <div>

                    <label class=\"checkbox\">
                        <input type=\"checkbox\" />
                        <div class=\"checkbox__text\"></div>
                    </label>


                    <img src=\"Images/open-mail.png\" title=\"Відкрити повідомлення\">
                </div>

                <div>

                    <a class=\"CheckPost\" title=\"Відкрити повідомлення\" href='ViewPost.php?NumDiv=" . "$arr_select_some_posts[6]'".">
                        
                        <div>
                            <p style=\"font-weight: bold; margin-right: 15px;\">Від: </p>
                            <p>
                            $arr_select_some_posts[0] $arr_select_some_posts[1] $arr_select_some_posts[2]
                            ($arr_select_some_posts[3])
                            </p>
                        </div>

                        <div>
                            <p style=\"font-weight: bold; margin-right: 15px;\">Тема:</p>
                            <p style='font-style: italic;'>$arr_select_some_posts[4]</p>
                        </div>

                        <div>
                            <p style=\"font-weight: bold; margin-right: 15px;\">Час доставки:</p>
                            <p>$arr_select_some_posts[5]</p>
                        </div>

                    </a>

                    <div>

                        <input type=\"submit\" value=\"ПРИЙНЯТИ\" name='confirm'>
                        <input type=\"submit\" value=\"ВІДМОВИТИСЯ\" name='disregard'>

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