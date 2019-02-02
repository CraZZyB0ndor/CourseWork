<?php

session_start();

date_default_timezone_set('Europe/Kiev');

$serverName = "localhost";
$userName = "root";
$password = "";
$nameDataBase = "PostOffice";

$connectMySQL = new mysqli($serverName, $userName, $password, $nameDataBase);

mysqli_query($connectMySQL, "SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");

include 'SelectControlling.php';

$query_check_count_post = "SELECT COUNT(DISTINCT P.`ID-post`) FROM `Waybill` W, `Post` P WHERE W.`ID-sender` = '". $_COOKIE['Sender-ID'] ."' AND 
                            W.`ID-post` = P.`ID-post`";

$do_query_check_count_post = mysqli_query($connectMySQL, $query_check_count_post);
$array_do_query_check_count_post = mysqli_fetch_array($do_query_check_count_post);


if ($array_do_query_check_count_post[0] >= 1) {

    $_SESSION['checkSelect'] = 0;

} else {

    $_SESSION['checkSelect'] = '-1';

    $SentPostArriveWait['Arrive post'] = 0;
    $SentPostArriveWait['Wait post'] = 0;
    $SentPostReceivedDismiss['Received post'] = 0;
    $SentPostReceivedDismiss['Dismiss post'] = 0;
    $SentPostReceivedDismiss['TimeStart'] = 0;
    $SentPostReceivedDismiss['TimeFinish'] = 0;
    $SumSentPosts['Sum send post'] = 0;

}

//

if (isset($_POST['BuildGraphic'])) {

    SelectSubject($connectMySQL);
}


if ( $_SESSION['checkSelect'] === 0 ) {

    /* $query_min_date_sent_post = "SELECT MIN(P.`DateOfReception`) FROM `Waybill` W, `Post` P WHERE W.`ID-sender` = '". $_COOKIE['Sender-ID'] ."' AND
                                 W.`ID-post` = P.`ID-post`";

    $do_query_min_date_sent_post = mysqli_query($connectMySQL, $query_min_date_sent_post);

    $min_date = mysqli_fetch_array($do_query_min_date_sent_post);


    $SentPostArriveWait = ArrayReceivedWaitPost($connectMySQL, $min_date[0], date("Y-m-d H:i:s"));
    $SentPostReceivedDismiss = ArrayReceivedDismissPost($connectMySQL, $min_date[0], date("Y-m-d H:i:s"));
    $SumSentPosts = SendPost($connectMySQL, $min_date[0], date("Y-m-d H:i:s"));
    $arr_for_graphic_sent_post = ArraySentPost($connectMySQL, $min_date[0], date("Y-m-d H:i:s"));
*/

    SelectSubject($connectMySQL);

    $SentPostArriveWait = $_SESSION['ArriveWait'];
    $SentPostReceivedDismiss = $_SESSION['ReceivedDismiss'];
    $SumSentPosts = $_SESSION['SumSentPosts'];
    $arr_for_graphic_sent_post = $_SESSION['DisplayAllSentPost'];


} else if ( $_SESSION['checkSelect'] === '01' ) {

        $SentPostArriveWait = $_SESSION['ArriveWait'];
        $SentPostReceivedDismiss = $_SESSION['ReceivedDismiss'];
        $SumSentPosts = $_SESSION['SumSentPosts'];
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

    <link rel="stylesheet" href="StatisticsInterfaceStyle.css">
    <link rel="stylesheet" href="StyleForPrint.css">

    <title>СТАТИСТИКА</title>

    <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>

</head>

<body style="background-image: url('Images/blur-bright-close-up-1405773.jpg'); background-attachment: fixed;">

<div class="FixedElement" style="background-image: url('Images/blur-bright-close-up-1405773.jpg'); background-attachment: fixed;">


    <a href="ExitAndClearSession.php"><img src="Images/restart.png"></a>

    <p>СТАТИСТИКА</p>


    <div id="ControlPanel">

        <form  method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="application/x-www-form-urlencoded">


            <div id="SubjectOfStatistic">

                <p>предмет статистики: </p>

                <select name="SubjectSelect" id="SelectSubject">

                    <option value="відправлена пошта">відправлена пошта</option>
                    <option value="отримана пошта">отримана пошта</option>
                    <option value="загальна статистика користувача">загальна статистика користувача</option>


                </select>

            </div>

            <div id="TimeBorder">

                <p>часові обмеження: </p>

                <select name="TimeSelect" id="SelectTime">

                    <option value="З [--] ДО [--]">З [--] ДО [--]</option>
                    <option value="за весь час">за весь час</option>

                </select>

            </div>




            <div id="BuildStatistic">

                <button type="submit" name="BuildGraphic"><img src="Images/build_statistic.png" onclick="" title="Побудувати статистику"></button>

            </div>

        </form>

    </div>


    <div id="PrintStatistic" >

        <p>статистика обмежується проміжком часу: <span id="TimeBuildGraphic"></span></p>
        <input type="button" value="НАДРУКУВАТИ СТАТИСТИКУ" onclick="DeterminePrintContent();">

    </div>


</div>

    <main>

        <p id="NonePost">ви не відправили жодної пошти</p>

    <div id="GraphicOfStatistic">

        <p id="HeaderGraphic"></p>

        <div id="ContainerForGraphic">

            <div id="MainGraphic">

                <div id="FieldsFromSendPost">

                    <p>сумарна кількість відправленої пошти: <span><?php echo $SumSentPosts['Sum send post']; ?></span></p>

                </div>


                <div id="chart_div"></div>

            </div>

            <hr style="height: 1px; border: none; background-color: black; width: 550px; margin-top: 10px; margin-bottom: 20px;">

            <div id="FirstPieGraphic">

                <div id="FieldsFromReceivedPost">

                    <p>кількість доставленої пошти: <span><?php echo $SentPostArriveWait['Arrive post']; ?></span></p>
                    <p style="margin-top: 20px;">кількість пошти, яка чекає на відправку: <span><?php echo $SentPostArriveWait['Wait post']; ?></span></p>

                </div>

                <div id="piechart1"></div>

            </div>

            <hr style="height: 1px; border: none; background-color: black; width: 550px; margin-top: 10px; margin-bottom: 20px;">

            <div id="SecondPieGraphic">

                <div id="FieldsNumOfPostForSending">

                    <p>Кількість прийнятої пошти: <span><?php echo $SentPostReceivedDismiss['Received post']; ?></span></p>
                    <p style="margin-top: 20px;">Кількість пошти, якій було відмовлено: <span><?php echo $SentPostReceivedDismiss['Dismiss post']; ?></span></p>

                </div>

                <div id="piechart2"></div>

            </div>

        </div>

    </div>


</main>

</body>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>


<script>

switch  ('<?php echo $_SESSION['checkSelect']; ?>') {

    case '-1':

        document.getElementById('GraphicOfStatistic').style.display = 'none';
        document.getElementById('PrintStatistic').style.display = 'none';
        document.getElementById('BuildStatistic').style.display = 'none';
        document.getElementById('NonePost').style.display = 'flex';

        break;

    case '0':

        document.getElementById('TimeBuildGraphic').textContent = 'за весь час';
        document.getElementById('HeaderGraphic').textContent = "відправлена пошта за весь час (<?php echo $SentPostReceivedDismiss['TimeStart'] . ' - ' . $SentPostReceivedDismiss['TimeFinish']; ?>)";


        $('#SelectSubject').val('відправлена пошта');
        $('#SelectTime').val('за весь час');

        break;

    case '00':

        document.getElementById('ContainerForGraphic').style.display = 'flex';

        $('#SelectSubject').val('відправлена пошта');
        $('#SelectTime').val('З [--] ДО [--]');

        break;

    case '01':

        document.getElementById('TimeBuildGraphic').textContent = 'за весь час';
        document.getElementById('HeaderGraphic').textContent = "відправлена пошта за весь час (<?php echo $SentPostReceivedDismiss['TimeStart'] . ' - ' . $SentPostReceivedDismiss['TimeFinish']; ?>)";

        document.getElementById('ContainerForGraphic').style.display = 'flex';


        $('#SelectSubject').val('відправлена пошта');
        $('#SelectTime').val('за весь час');

        break;

    case '10':

        document.getElementById('ContainerForGraphic').style.display = 'none';

        $('#SelectSubject').val('отримана пошта');
        $('#SelectTime').val('З [--] ДО [--]');

        break;

    case '11':

        document.getElementById('TimeBuildGraphic').textContent = 'весь час';


        $('#SelectSubject').val('отримана пошта');
        $('#SelectTime').val('за весь час');

        break;

    case '20':

        $('#SelectSubject').val('загальна статистика користувача');
        $('#SelectTime').val('З [--] ДО [--]');

        break;

    case '21':

        document.getElementById('TimeBuildGraphic').textContent = 'весь час';


        $('#SelectSubject').val('загальна статистика користувача');
        $('#SelectTime').val('за весь час');

        break;


}

// FUNCTION FOR DETERMINE PRINT CONTENT.

function DeterminePrintContent() {


    switch('<?php

            if (key_exists('SubjectSelect', $_POST)) {

                echo $_POST['SubjectSelect'];

            } else {

                echo 'відправлена пошта';
            }

        ?>') {

        case 'відправлена пошта':

            CallPrint('StatisticSendPost.php');

            break;
    }
}

</script>

<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChartSendPost);

    function drawChartSendPost() {

        var data = google.visualization.arrayToDataTable([
            ['Дата відправки пошти', 'Кількість відправленої пошти'],
            <?php

                if ($_SESSION['checkSelect'] == '0' || $_SESSION['checkSelect'] == '01') {

        for ($i = 0; $i < count($arr_for_graphic_sent_post); $i++) {

            for ($j = 0; $j < count($arr_for_graphic_sent_post[$i]); $j++) {

                echo "['". $arr_for_graphic_sent_post[$i][$j] ."', " . $arr_for_graphic_sent_post[$i][$j + 1] . "],\n";

                break;
            }
        }



                } else {

                    echo "['0', 0 ],";
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

        var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
        chart.draw(data, options);
    }
</script>

<!---  --->

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

        var chart = new google.visualization.PieChart(document.getElementById('piechart1'));

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

        var chart = new google.visualization.PieChart(document.getElementById('piechart2'));

        chart.draw(data, options);
    }
</script>


<script language="javascript">


    function CallPrint(AddressPage) {

        var WinPrint = window.open(AddressPage,'','left=50,top=50,width=800,height=640,toolbar=0,scrollbars=1,status=0');

        WinPrint.focus();
        WinPrint.print();

    }

</script>


</html>