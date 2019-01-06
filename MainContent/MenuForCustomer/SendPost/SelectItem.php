<?php

function SelectItem() {


    switch ($_POST['ChooseTypeOfPost']) {

        case 'лист':

            $_SESSION['Email'] = $_POST['Email_to_user'];

            $_SESSION['Theme'] = $_POST['ThemeLetterPHP'];
            $_SESSION['Content'] = $_POST['MainContentLetterPHP'];

            $_SESSION['TypeOfBox'] = 'Пристрої';
            $_SESSION['TypeOfCash'] = "UA";

            unset($_SESSION['Weight']);
            unset($_SESSION['CheckBox']);
            unset($_SESSION['Description']);
            unset($_SESSION['CashSum']);
            unset($_SESSION['DescriptionCash']);

            break;

        case 'посилка':

            $_SESSION['Email'] = $_POST['Email_to_user'];

            $_SESSION['TypeOfBox'] = $_POST['ChooseTypeOfBox'];
            $_SESSION['Weight'] = $_POST['WeightOfBox'];

            if (isset($_REQUEST['CheckboxBox'])) {

                $_SESSION['CheckBox'] = 1;

            } else {

                $_SESSION['CheckBox'] = 0;
            }

            $_SESSION['Description'] = $_POST['DescriptionBox'];

            $_SESSION['TypeOfCash'] = "UA";

            unset($_SESSION['Theme']);
            unset($_SESSION['Content']);
            unset($_SESSION['CashSum']);
            unset($_SESSION['DescriptionCash']);

            break;

        case 'грощі':

            $_SESSION['Email'] = $_POST['Email_to_user'];

            $_SESSION['CashSum'] = $_POST['SumOfCash'];
            $_SESSION['TypeOfCash'] = $_POST['Currency'];
            $_SESSION['DescriptionCash'] = $_POST['DescrOfCash'];

            $_SESSION['TypeOfBox'] = 'Пристрої';

            unset($_SESSION['Theme']);
            unset($_SESSION['Content']);
            unset($_SESSION['Weight']);
            unset($_SESSION['CheckBox']);
            unset($_SESSION['Description']);

            break;

    }

}

?>