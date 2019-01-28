<?php

session_start();

if (key_exists('SearchInput', $_SESSION)) {

    unset($_SESSION['SearchInput']);
}

if (key_exists('TypeS', $_SESSION)) {

    unset($_SESSION['TypeS']);
}

if (key_exists('ConditionS', $_SESSION)) {

    unset($_SESSION['ConditionS']);
}

if (key_exists('FilterS', $_SESSION)) {

    unset($_SESSION['FilterS']);
}

if (key_exists('order', $_SESSION)) {

    unset($_SESSION['order']);
}

if (key_exists('filter', $_SESSION)) {

    unset($_SESSION['filter']);
}

if (key_exists('search', $_SESSION)) {

    unset($_SESSION['search']);
}


header('Location: ' . "http://localhost/dashboard/CourseWork/MainContent/MenuForCustomer/CustomerMenuPHP.php");

session_destroy();

?>