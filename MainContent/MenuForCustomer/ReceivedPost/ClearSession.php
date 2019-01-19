<?php

session_start();

if (key_exists('SearchInput', $_SESSION)) {

    unset($_SESSION['SearchInput']);
}

if (key_exists('TypeS', $_SESSION)) {

    unset($_SESSION['TypeS']);

}

if (key_exists('FilterS', $_SESSION)) {

    unset($_SESSION['FilterS']);

}


header('Location: ' . "http://localhost/dashboard/CourseWork/MainContent/MenuForCustomer/CustomerMenuPHP.php");

?>