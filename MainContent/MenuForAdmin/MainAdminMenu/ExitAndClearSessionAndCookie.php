<?php

unset($_COOKIE['Sender-ID']);
unset($_COOKIE['E-mail']);


setcookie ("Sender-ID", "", (int)(time() - 3600), '/');
setcookie('E-mail', "", (int)(time() - 3600), '/');

session_destroy();

header('Location: ' . "http://localhost/dashboard/CourseWork/LogInRegisTer/MainHTML.php");

?>