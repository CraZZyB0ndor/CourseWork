<?php

$serverName = "localhost";
$userName = "root";
$password = "";
$nameDataBase = "PostOffice";

$connectMySQL = new mysqli($serverName, $userName, $password, $nameDataBase);

mysqli_query($connectMySQL, "SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");


if (!isset($_GET['NumDiv'])) {

    header('Location: ' . "http://localhost/dashboard/CourseWork/MainContent/MenuForCustomer/ReceivedPost/ReceivedPostInterface.php");
    //ViewPost($_SESSION['connectMySQL'], $_GET['NumDiv']); // Delete on future.
}

$query_get_post_content = "SELECT `TypePost`, `WeightPost`, `DescPost`, `DateOfReception` FROM `Post` WHERE `ID-post` =" . $_GET['NumDiv'];

$do_query_post_content = mysqli_query($connectMySQL, $query_get_post_content);

if (mysqli_num_rows($do_query_post_content) >= 1) {

    $array_query_post_content_data = mysqli_fetch_assoc($do_query_post_content);

} else {

    header('Location: ' . "http://localhost/dashboard/CourseWork/MainContent/MenuForCustomer/ReceivedPost/ReceivedPostInterface.php");
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

        <p id="HeaderDocument">ПРИЙНЯТИ ПОШТУ</p>

        <div id="MainControl">

            <a href="http://localhost/dashboard/CourseWork/MainContent/MenuForCustomer/ReceivedPost/ReceivedPostInterface.php" title="Назад"><img src="Images/restart.png" alt="back" id="RestartIMG"></a>

            <div id="ActionPost">

                <input type="submit" value="ПРИЙНЯТИ">
                <input type="submit" value="ВІДМОВИТИСЯ">

            </div>

        </div>

        <div id="PostContent">

            <div id="ThemeLetter">

                <p><span>Тип пошти: </span><?php echo $array_query_post_content_data['TypePost']; ?></p>

            </div>

        <div id="MainPartLetter">

            <p>
                <span>

                    <?php

                    // Написать условие отображение темы (если тип письма = "Лист", то тема есть, во всех остальных случаях ее нет).

                    ?>

                </span>


                <?php echo $array_query_post_content_data['DescPost']; ?>

            </p>



        </div>

            <div id="TechnicalInfo">

                <p><span>Вага пошти: </span><?php echo $array_query_post_content_data['WeightPost']; ?> Кг.</p>
                <p><span>Дата відправки пошти адресатом: </span><?php echo $array_query_post_content_data['DateOfReception']; ?></p>

            </div>


        </div>

    </main>

    </body>
    </html>


