<?php

function GetData($connectionMySQL) {

    $query_get_data = "SELECT * FROM `User` WHERE `Sender-ID` = " . $_COOKIE['Sender-ID'];

    $DO_query_get_data = mysqli_query($connectionMySQL, $query_get_data);

    if ( mysqli_num_rows($DO_query_get_data) === 1 ) {

        return mysqli_fetch_assoc($DO_query_get_data);

    } else {

        return false;
    }


}

?>