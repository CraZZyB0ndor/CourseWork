<?php

include 'GetDataFromDB.php';

function SelectSubject($connectMySQL) {

    switch ($_POST['SubjectSelect']) {

        case 'відправлена пошта':

            if (SelectTime() === 0) {

                $_SESSION['checkSelect'] = '00';

            } else if (SelectTime() === 1) {


                // Select first date of sending post.

                $query_min_date_sent_post = "SELECT MIN(P.`DateOfReception`) FROM `Waybill` W, `Post` P WHERE W.`ID-sender` = '". $_COOKIE['Sender-ID'] ."' AND 
                                 W.`ID-post` = P.`ID-post`";

                $do_query_min_date_sent_post = mysqli_query($connectMySQL, $query_min_date_sent_post);

                $min_date = mysqli_fetch_array($do_query_min_date_sent_post);



                $_SESSION['checkSelect'] = '01';

                $_SESSION['ArriveWait'] = ArrayReceivedWaitPost($connectMySQL, $min_date[0], date("Y-m-d H:i:s"));

                $_SESSION['ReceivedDismiss'] = ArrayReceivedDismissPost($connectMySQL, $min_date[0], date("Y-m-d H:i:s"));

                $_SESSION['SumSentPosts'] = SendPost($connectMySQL, $min_date[0], date("Y-m-d H:i:s"));

                $_SESSION['DisplayAllSentPost'] = ArraySentPost($connectMySQL, $min_date[0], date("Y-m-d H:i:s"));
            }

            break;

        case 'отримана пошта':

            if (SelectTime() === 0) {

                $_SESSION['checkSelect'] = '10';

            } else if (SelectTime() === 1) {

                $_SESSION['checkSelect'] = '11';
            }

            break;

        case 'загальна статистика користувача':

            if (SelectTime() === 0) {

                $_SESSION['checkSelect'] = '20';

            } else if (SelectTime() === 1) {

                $_SESSION['checkSelect'] = '21';
            }

            break;
    }

}

function SelectTime() {

    switch ($_POST['TimeSelect']) {

        case 'З [--] ДО [--]':

            return 0;

            break;

        case 'за весь час':

            return 1;

            break;
    }
}


?>