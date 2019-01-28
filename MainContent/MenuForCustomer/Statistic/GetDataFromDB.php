<?php



function ArraySentPost($MySQL, $time_limit_start, $time_limit_finish) {

    //

    $result_array = [];

    //

    $arr_time_limit_finish = explode('-', $time_limit_finish);

    $new_time_limit_finish = $arr_time_limit_finish[0] . '-' . $arr_time_limit_finish[1] . '-';

    $arr_time_limit_finish = explode(" ", $arr_time_limit_finish[2]);

    $LastDay = ((int) $arr_time_limit_finish[0]) + 1;

    $new_time_limit_finish .= $LastDay . ' 00:00:00';

    //

    $arr_time_limit_start = explode('-', $time_limit_start);

    $new_time_limit_start = $arr_time_limit_start[0] . '-' . $arr_time_limit_start[1] . '-';

    $arr_time_limit_start = explode(" ", $arr_time_limit_start[2]);

    $new_time_limit_start .= $arr_time_limit_start[0] . ' 00:00:00';

    //


    $begin = new DateTime( $new_time_limit_start );
    $end = new DateTime( $new_time_limit_finish );

    $interval = DateInterval::createFromDateString('1 day');
    $period = new DatePeriod($begin, $interval, $end);

    foreach ( $period as $dt ) {


        $start = $dt->format( "Y-m-d H:i:s" );



        $arr_start = explode('-', $start);

        $new_str_start = $arr_start[0] . '-' . $arr_start[1] . '-';

        $arr_start = explode(" ", $arr_start[2]);

        $new_str_start .= $arr_start[0] . ' 23:59:59';

        $finish = $new_str_start;


        $query = "SELECT COUNT(DISTINCT P.`ID-post`) FROM `Waybill` W, `Post` P WHERE W.`ID-sender` = '". $_COOKIE['Sender-ID'] ."' AND W.`ID-post` = P.`ID-post` AND 
                  P.`DateOfReception` BETWEEN '$start' AND '$finish'";

        $do_query = mysqli_query($MySQL, $query);

        $arr_do_query = mysqli_fetch_array($do_query);

        $start = explode(' ', $start);

        $result_array[] = [$start[0], $arr_do_query[0]];

    }

    return $result_array;

}


function ArrayReceivedWaitPost($MySQL, $time_limit_start, $time_limit_finish) {

    $query_arrived_to_db = "SELECT COUNT(DISTINCT S.`ID-post`) FROM `Waybill` W, `Post` P, `Statuspost` S WHERE
                    W.`ID-sender` = '" . $_COOKIE['Sender-ID'] . "' AND W.`ID-post` = P.`ID-post` AND P.`ID-post` = S.`ID-post` AND
                    S.`StatusOfPost` = 'Доставлено' AND P.`DateOfReception` BETWEEN '". $time_limit_start ."' AND '". $time_limit_finish ."'";

    $query_wait_to_db = "SELECT COUNT(DISTINCT S.`ID-post`) FROM `Waybill` W, `Post` P, `Statuspost` S WHERE
                    W.`ID-sender` = '" . $_COOKIE['Sender-ID'] . "' AND W.`ID-post` = P.`ID-post` AND P.`ID-post` = S.`ID-post` AND
                    S.`StatusOfPost` = 'Чекає на підтвердження' AND P.`DateOfReception` BETWEEN '". $time_limit_start ."' AND '". $time_limit_finish ."'";

//AND P.`DateOfReception` BETWEEN '". $time_limit_start ."' AND '". $time_limit_finish ."'";

    $do_query_arrived_to_db = mysqli_query($MySQL, $query_arrived_to_db);
    $do_query_wait_to_db = mysqli_query($MySQL, $query_wait_to_db);

    $ArrivePost = mysqli_fetch_array($do_query_arrived_to_db);
    $WaitPost = mysqli_fetch_array($do_query_wait_to_db);

    $result_array = ['Arrive post' => $ArrivePost[0], 'Wait post' => $WaitPost[0], 'TimeStart' => $time_limit_start, 'TimeFinish' => $time_limit_finish];

    //print($query_wait_to_db);

    return $result_array;


}


function ArrayReceivedDismissPost($MySQL, $time_limit_start, $time_limit_finish) {

    $query_received_to_db = "SELECT COUNT(DISTINCT S.`ID-post`) FROM `Waybill` W, `Post` P, `Statuspost` S WHERE
                    W.`ID-sender` = '" . $_COOKIE['Sender-ID'] . "' AND W.`ID-post` = P.`ID-post` AND P.`ID-post` = S.`ID-post` AND
                    S.`StatusOfPost` = 'Прийнято' AND P.`DateOfReception` BETWEEN '". $time_limit_start ."' AND '". $time_limit_finish ."'";

    $query_dismiss_to_db = "SELECT COUNT(DISTINCT S.`ID-post`) FROM `Waybill` W, `Post` P, `Statuspost` S WHERE
                    W.`ID-sender` = '" . $_COOKIE['Sender-ID'] . "' AND W.`ID-post` = P.`ID-post` AND P.`ID-post` = S.`ID-post` AND
                    S.`StatusOfPost` = 'Відмовлено' AND P.`DateOfReception` BETWEEN '". $time_limit_start ."' AND '". $time_limit_finish ."'";

    //AND P.`DateOfReception` BETWEEN '". $time_limit_start ."' AND '". $time_limit_finish ."'";


    $do_query_received_to_db = mysqli_query($MySQL, $query_received_to_db);
    $do_query_dismiss_to_db = mysqli_query($MySQL, $query_dismiss_to_db);

    $ReceivedPost = mysqli_fetch_array($do_query_received_to_db);
    $DismissPost = mysqli_fetch_array($do_query_dismiss_to_db);

    $result_array = ['Received post' => $ReceivedPost[0], 'Dismiss post' => $DismissPost[0], 'TimeStart' => $time_limit_start, 'TimeFinish' => $time_limit_finish];

    return $result_array;
}


function SendPost($MySQL, $time_limit_start, $time_limit_finish) {

    $query_sum_sent_post = "SELECT COUNT(DISTINCT P.`ID-post`) FROM `Waybill` W, `Post` P WHERE W.`ID-sender` = '". $_COOKIE['Sender-ID'] ."' AND 
                            W.`ID-post` = P.`ID-post` AND P.`DateOfReception` BETWEEN '". $time_limit_start ."' AND '". $time_limit_finish ."'";

    //AND P.`DateOfReception` BETWEEN '". $time_limit_start ."' AND '". $time_limit_finish ."'";

    $do_query_sum_sent_post = mysqli_query($MySQL, $query_sum_sent_post);

    $SumSendPost = mysqli_fetch_array($do_query_sum_sent_post);

    $result_array = ['Sum send post' => $SumSendPost[0]];

    return $result_array;

}

?>