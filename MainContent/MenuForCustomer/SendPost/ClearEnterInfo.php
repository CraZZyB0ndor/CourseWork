<?php

function ClearSessionS() {

    $_SESSION['TypeOfBox'] = 'Пристрої';
    $_SESSION['TypeOfCash'] = "UA";

    unset($_SESSION['Weight']);
    unset($_SESSION['CheckBox']);
    unset($_SESSION['Description']);
    unset($_SESSION['CashSum']);
    unset($_SESSION['DescriptionCash']);
    unset($_SESSION['Theme']);
    unset($_SESSION['Content']);
    unset($_SESSION['Email']);

}

?>