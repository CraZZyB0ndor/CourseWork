<?php

function DisplayPosts($connectMySQL) {

    $query_count_posts = "SELECT COUNT(W.`ID-addressee`) FROM `Waybill` W, `Post` P, `Statuspost` S WHERE `ID-addressee` = '". $_COOKIE["Sender-ID"] ."'
    AND W.`ID-post` = P.`ID-post` AND P.`ID-post` = S.`ID-post` AND S.`StatusOfPost` = 'Доставлено'";

    $do_query_count_posts = mysqli_query($connectMySQL, $query_count_posts);

    $arr_count_posts = mysqli_fetch_array($do_query_count_posts);

    if ($arr_count_posts[0] > 0) {

        $query_get_info = "SELECT U.`SecondName`, U.`FirstName`, U.`Patronymic`, U.`E-mail`, P.`DescPost`, S.`DateOfReceipt` FROM `User` U, `Waybill` W,
        `Post` P, `Statuspost` S WHERE '". $_COOKIE['Sender-ID'] ."' = W.`ID-addressee` AND W.`ID-sender` = U.`Sender-ID` AND W.`ID-post` = P.`ID-post`
        AND P.`ID-post` = S.`ID-post` AND S.`StatusOfPost` = 'Доставлено'";

    } else {

        return "В ДАНИЙ ЧАС ДЛЯ ВАС НЕ МАЄ НОВОЇ ПОШТИ";
    }
}

?>