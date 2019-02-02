<?php

session_start();

if (key_exists('checkSelect', $_SESSION)) {

    unset($_SESSION['checkSelect']);
}

if (key_exists('ArriveWait', $_SESSION)) {

    unset($_SESSION['ArriveWait']);
}

if (key_exists('ReceivedDismiss', $_SESSION)) {

    unset($_SESSION['ReceivedDismiss']);
}

if (key_exists('SumSentPosts', $_SESSION)) {

    unset($_SESSION['SumSentPosts']);
}

if (key_exists('DisplayAllSentPost', $_SESSION)) {

    unset($_SESSION['DisplayAllSentPost']);
}



header('Location: ' . "http://localhost/dashboard/CourseWork/MainContent/MenuForCustomer/CustomerMenuPHP.php");

session_destroy();

?>