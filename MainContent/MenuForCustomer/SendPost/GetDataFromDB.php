<?php

function DetermineInfoAboutUser($connectMYSQL) {

    $query = "SELECT `FirstName`, `SecondName`, `Patronymic` FROM `User` WHERE ". $_COOKIE['Sender-ID'] ." = `Sender-ID`";

    $data = mysqli_query($connectMYSQL, $query);

    if (mysqli_num_rows($data) === 1) {

        $row = mysqli_fetch_assoc($data);

        return $row;

    } else {

        return false;
    }
}


function DetermineAllUsers($connectMYSQL, $ID) {


    if ($_COOKIE['Sender-ID'] == $ID || 4 == $ID ) {

        return false;
    }

    $query = "SELECT `FirstName`, `SecondName`, `Patronymic`, `E-mail` FROM `User` WHERE `Sender-ID` = ". $ID;

    $data = mysqli_query($connectMYSQL, $query);

    if (mysqli_num_rows($data) >= 1) {

       $row =  mysqli_fetch_assoc($data);

        return $row;

    } else {

        return false;
    }

}

function DetermineAllPhoneNumberOfUsers() {

// ...
}

function DetermineAllAddressOfUsers() {

// ...
}
?>