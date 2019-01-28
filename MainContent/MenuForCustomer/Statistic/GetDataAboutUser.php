<?php

function GetDataAboutUser($connectionDB) {

    $query = "SELECT `SecondName`, `FirstName`, `Patronymic`, `PhoneNumber`, `Address` FROM `User` WHERE `Sender-ID` = '". $_COOKIE['Sender-ID'] ."'";

    $do_query = mysqli_query($connectionDB, $query);

    return mysqli_fetch_assoc($do_query);

}

?>