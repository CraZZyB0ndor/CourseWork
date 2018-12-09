<?php


function DetermineInfoAboutUser($connectMySQL) {

//print_r($_COOKIE);

    $query = "SELECT `FirstName`, `Patronymic` FROM `User` WHERE '" . $_COOKIE['Sender-ID'] ."' = `Sender-ID`";

    $data = mysqli_query($connectMySQL, $query);

    if (mysqli_num_rows($data) === 1) {

        $row = mysqli_fetch_assoc($data);

        return $row;


    } else {

        return false;

    }
}

?>