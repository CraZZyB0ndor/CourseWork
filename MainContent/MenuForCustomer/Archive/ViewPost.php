<?php

$serverName = "localhost";
$userName = "root";
$password = "";
$nameDataBase = "PostOffice";

$connectMySQL = new mysqli($serverName, $userName, $password, $nameDataBase);

mysqli_query($connectMySQL, "SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");


if (!isset($_GET['NumDiv'])) {

    header('Location: ' . "http://localhost/dashboard/CourseWork/MainContent/MenuForCustomer/Archive/ArchiveInterface.php");
}

$query_get_post_content = "SELECT P.`TypePost`, P.`WeightPost`, P.`DescPost`, P.`DateOfReception`, S.`StatusOfPost` FROM `Post` P, `Statuspost` S WHERE P.`ID-post` =" . $_GET['NumDiv'] . " 
                            AND P.`ID-post` = S.`ID-post`";

$do_query_post_content = mysqli_query($connectMySQL, $query_get_post_content);

if (mysqli_num_rows($do_query_post_content) >= 1) {

    $array_query_post_content_data = mysqli_fetch_assoc($do_query_post_content);

} else {

    header('Location: ' . "http://localhost/dashboard/CourseWork/MainContent/MenuForCustomer/Archive/ArchiveInterface.php");
}

if ($array_query_post_content_data['StatusOfPost'] === "Відмовлено") {

    $color_type = '#C0392B';

} else if ($array_query_post_content_data['StatusOfPost'] === "Прийнято") {

    $color_type = '#17A589';
}

?>



    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0\">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link href="https://fonts.googleapis.com/css?family=Playfair+Display+SC|Russo+One" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Cuprum" rel="stylesheet">
        <link rel="stylesheet" href="ViewPostStyle.css">
        <title>Перегляд пошти</title>
    </head>


    <body style="background-image: url('Images/blur-bright-close-up-1405773.jpg'); background-attachment: fixed;">
    
    <main>

        <p id="HeaderDocument">АРХІВНА ПОШТА</p>

        <div id="MainControl">

            <a href="http://localhost/dashboard/CourseWork/MainContent/MenuForCustomer/Archive/ArchiveInterface.php" title="Назад"><img src="Images/restart.png" alt="back" id="RestartIMG"></a>

            <p style="color: <?php echo $color_type; ?>;"><?php echo $array_query_post_content_data['StatusOfPost']; ?></p>

            <form method="POST" action="<?php echo $_SERVER['PHP_SELF'] . "?NumDiv=" . $_GET['NumDiv']; ?>" enctype="application/x-www-form-urlencoded">

        </div>

        <div id="PostContent">

            <div id="ThemeLetter">

                <p><span>Тип пошти: </span><?php echo $array_query_post_content_data['TypePost']; ?></p>

            </div>

        <div id="MainPartLetter">

            <p>

                    <?php

                    if ($array_query_post_content_data['TypePost'] == 'Лист') {

                        $str = (string) $array_query_post_content_data['DescPost'];
                        $arrayDesc = explode('æ325691çƒ©h', $str, strlen($str)-11 );

                        echo "<span style='font-family: \"Russo One\", sans-serif;font-size: 20px; font-weight: bold;'>
                                Тема: 
                                <span style='font-family: \"Cuprum\", sans-serif; font-size: 20px;'>". $arrayDesc[0] .".</span>
                                </span><br><br>";
                        echo "<span style='font-family: \"Cuprum\", sans-serif; font-size: 20px;'>".  $arrayDesc[1] ."</span>";

                    } else if ($array_query_post_content_data['TypePost'] == 'Гроші') {

                        $str = (string) $array_query_post_content_data['DescPost'];
                        $arrayDesc = explode('æ325691çƒ©h', $str, strlen($str)-11 );

                        echo "<span style='font-family: \"Russo One\", sans-serif;font-size: 20px; font-weight: bold;'>
                                Сума: 
                                <span style='font-family: \"Cuprum\", sans-serif; font-size: 20px;'>". $arrayDesc[0] .".</span>
                                </span><br><br>";

                        echo "<span style='font-family: \"Cuprum\", sans-serif; font-size: 20px;'>".  $arrayDesc[1] ."</span>";

                    } else if ($array_query_post_content_data['TypePost'] == 'Посилка') {

                        $str = (string) $array_query_post_content_data['DescPost'];
                        $arrayDesc = explode('æ325691çƒ©h', $str, strlen($str)-11 );

                        echo "<span style='font-family: \"Russo One\", sans-serif;font-size: 20px; font-weight: bold;'>
                                Тип посилки: 
                                <span style='font-family: \"Cuprum\", sans-serif; font-size: 20px;'>". $arrayDesc[0] .".</span>
                                </span><br><br>";
                        echo "<span style='font-family: \"Cuprum\", sans-serif; font-size: 20px;'>".  $arrayDesc[1] ."</span>";
                    }

                    ?>

            </p>


        </div>

            <div id="TechnicalInfo">

                <p><span>Вага пошти: </span><?php echo $array_query_post_content_data['WeightPost']; ?> Кг.</p>
                <p><span>Дата відправки пошти адресатом: </span><?php echo $array_query_post_content_data['DateOfReception']; ?></p>

            </div>


        </div>

        </form>

    </main>

    </body>
    </html>


