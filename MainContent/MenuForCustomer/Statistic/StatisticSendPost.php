<?php

session_start();

date_default_timezone_set('Europe/Kiev');

$serverName = "localhost";
$userName = "root";
$password = "";
$nameDataBase = "PostOffice";

$connectMySQL = new mysqli($serverName, $userName, $password, $nameDataBase);

mysqli_query($connectMySQL, "SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");


include "GetDataAboutUser.php";

$DataUser = GetDataAboutUser($connectMySQL);

if (key_exists('ArriveWait', $_SESSION)) {

    $SentPostArriveWait = $_SESSION['ArriveWait'];
}

if (key_exists('ReceivedDismiss', $_SESSION)) {

    $SentPostReceivedDismiss = $_SESSION['ReceivedDismiss'];
}

if (key_exists('SumSentPosts', $_SESSION)) {

    $SumSentPosts = $_SESSION['SumSentPosts'];
}

if (key_exists('DisplayAllSentPost', $_SESSION)) {

    $arr_for_graphic_sent_post = $_SESSION['DisplayAllSentPost'];

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
    <link href="https://fonts.googleapis.com/css?family=Comfortaa" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300" rel="stylesheet">

    <link rel="stylesheet" href="StyleForPrint.css">

    <title>ДРУК</title>
</head>
<body>


<div id="DivPrintSentPost">

    <p class="HeaderPrintDocument">відправлена пошта за (<?php echo $SentPostReceivedDismiss['TimeStart'] . ' - ' . $SentPostReceivedDismiss['TimeFinish']; ?>)</p>

    <div class="DivInfoCustomerPrint">

        <table cellspacing="20px">

            <tr>
                <td>Клієнт:</td>
                <td class="InfoUserPR"><?php echo $DataUser['SecondName'] . ' ' . $DataUser['FirstName'] . ' ' . $DataUser['Patronymic']; ?></td>
            </tr>

            <tr>
                <td>E-mail:</td>
                <td class="InfoUserPR"><?php echo $_COOKIE['E-mail']; ?></td>
            </tr>

            <tr>
                <td>Телефон:</td>
                <td class="InfoUserPR"><?php echo $DataUser['PhoneNumber']; ?></td>
            </tr>

            <tr>
                <td>Адреса:</td>
                <td class="InfoUserPR"><?php echo $DataUser['Address']; ?></td>
            </tr>

        </table>

    </div>

    <div class="GraphicsForPrint">

        <div id="chart_div_print_sent_all_post"></div>

        <p class="TittleGraphic" style="margin-top: 30px;">Графік відправленої пошти за час (<?php echo $SentPostReceivedDismiss['TimeStart'] . '-' . $SentPostReceivedDismiss['TimeFinish']; ?>)</p>

        <hr style="height: 1px; border: none; background-color: black; width: 850px; margin-top: 10px; margin-bottom: 20px;">

        <div id="piechart1Print"></div>

        <p class="TittleGraphic">Графік стану пошти (відправлена/чекає на відправку) за час (<?php echo $SentPostReceivedDismiss['TimeStart'] . '-' . $SentPostReceivedDismiss['TimeFinish']; ?>)</p>

        <hr style="height: 1px; border: none; background-color: black; width: 850px; margin-top: 10px; margin-bottom: 20px;">

        <div id="piechart2Print"></div>

        <p class="TittleGraphic">Графік стану пошти (прийнято/відмовлено) за час (<?php echo $SentPostReceivedDismiss['TimeStart'] . '-' . $SentPostReceivedDismiss['TimeFinish']; ?>)</p>

        <hr style="height: 1px; border: none; background-color: black; width: 850px; margin-top: 10px; margin-bottom: 20px;">

    </div>


    <div class="TextStatisticPrint">

        <table cellspacing="20px">

            <tr>
                <td>сумарна кількість вашої пошти, яка була відправлена:</td>
                <td class="ValuePrintGR1"><?php echo $SumSentPosts['Sum send post']; ?></td>
            </tr>

            <tr>
                <td>кількість вашої пошти, яка була доставлена: </td>
                <td class="ValuePrintGR1"><?php echo $SentPostArriveWait['Arrive post']; ?></td>
            </tr>

            <tr>
                <td>кількість вашої пошти, яка чекає на відправку:</td>
                <td class="ValuePrintGR1"><?php echo $SentPostArriveWait['Wait post']; ?></td>
            </tr>

            <tr>
                <td>Кількість вашої пошти, яка була прийнята:</td>
                <td class="ValuePrintGR1"><?php echo $SentPostReceivedDismiss['Received post']; ?></td>
            </tr>

            <tr>
                <td>Кількість вашої пошти, якій було відмовлено:</td>
                <td class="ValuePrintGR1"><?php echo $SentPostReceivedDismiss['Dismiss post']; ?></td>
            </tr>

        </table>


    </div>


</div>


</body>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChartSendPost);

        function drawChartSendPost() {

            var data = google.visualization.arrayToDataTable([
                ['Дата відправки пошти', 'Кількість відправленої пошти'],
                <?php

                for ($i = 0; $i < count($arr_for_graphic_sent_post); $i++) {

                    for ($j = 0; $j < count($arr_for_graphic_sent_post[$i]); $j++) {

                        echo "['". $arr_for_graphic_sent_post[$i][$j] ."', " . $arr_for_graphic_sent_post[$i][$j + 1] . "],\n";

                        break;
                    }
                }

                ?>
            ]);

            var options = {
                title: 'ВІДПРАВЛЕНА ПОШТА',

                hAxis: {

                    title: 'ДАТА ВІДПРАВКИ ПОШТИ АДРЕСАТОМ',

                    titleTextStyle: {color: 'black'},

                    textStyle: { fontName: 'Arial',
                        fontSize: 12,
                        bold: true,
                        italic: true,
                        // The color of the text.
                        color: 'black',
                        opacity: 0.8
                    },



                },

                vAxis: {

                    minValue: 0,

                    title: 'КІЛЬКІСТЬ ВІДПРАВЛЕНОЇ ПОШТИ',

                    titleTextStyle: {color: 'black'},

                    format: '#',

                    textStyle: {
                        fontName: 'Arial',
                        fontSize: 15,
                        bold: true,
                        italic: true,
                        // The color of the text.
                        color: 'black',
                        opacity: 0.8,

                    }
                },

                colors: ['F1C40F'],

                backgroundColor: 'none',

                stroke: { backgroundColor: 'Black', color: 'black' },


            };

            var chart = new google.visualization.AreaChart(document.getElementById('chart_div_print_sent_all_post'));
            chart.draw(data, options);
        }
    </script>

    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChartFirstPie);

        function drawChartFirstPie() {

            var data = google.visualization.arrayToDataTable([
                ['Стан', 'Кількість'],
                ['Доставлено', <?php echo $SentPostArriveWait['Arrive post']; ?>],
                ['Чекає на відправку', <?php echo $SentPostArriveWait['Wait post']; ?>]
            ]);

            var options = {
                title: 'ПОШТА ДОСТАВЛЕНА АБО ЧЕКАЄ НА ВІДПРАВКУ',
                backgroundColor: 'none'
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart1Print'));

            chart.draw(data, options);
        }
    </script>


    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChartSecondPie);

        function drawChartSecondPie() {

            var data = google.visualization.arrayToDataTable([
                ['Стан', 'Кількість'],
                ['Прийнято', <?php echo $SentPostReceivedDismiss['Received post']; ?>],
                ['Відмовлено', <?php echo $SentPostReceivedDismiss['Dismiss post']; ?>]

            ]);

            var options = {
                title: 'ПОШТУ ПРИЙНЯТО АБО ВІДМОВЛЕНО',
                backgroundColor: 'none'
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart2Print'));

            chart.draw(data, options);
        }

        </script>

</html>