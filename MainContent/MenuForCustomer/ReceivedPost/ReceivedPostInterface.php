<?php

$serverName = "localhost";
$userName = "root";
$password = "";
$nameDataBase = "PostOffice";

$connectMySQL = new mysqli($serverName, $userName, $password, $nameDataBase);

mysqli_query($connectMySQL, "SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");

include 'SelectInfoAboutPost.php';

$ResultPosts = DisplayPosts($connectMySQL);


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

            <input type="submit" value="ДО АРХІВУ">
            <input type="submit" value="ВІДМОВИТИСЯ">

                </div>


                <div id="RefreshHelp">


            <input type="image" src="Images/refresh.png" title="Оновити пошту">

            <img src="Images/question.png" alt="help" title="Допомога">


                </div>


            </div>


        </div>

        <div id="Posts">

            <?php

            echo "<p>".$ResultPosts."</p>";

            ?>

        </div>

    </form>

</main>

</body>

</html>