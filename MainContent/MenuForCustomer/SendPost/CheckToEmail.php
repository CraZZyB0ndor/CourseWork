<?php

function CheckEmail($connectMySQL) {

    $query_num_users = "SELECT COUNT(`Sender-ID`) FROM `User`";


        $data_num_users = mysqli_query($connectMySQL, $query_num_users);

        $NumOfUser = mysqli_fetch_array($data_num_users);


        for ($i = 0; $i <= $NumOfUser[0]; $i++ ) {

            $ArrInfoUser = DetermineAllUsers($connectMySQL, $i);

            if ($ArrInfoUser != false) {

                $str = $ArrInfoUser['SecondName'] . " " . $ArrInfoUser['FirstName'] . " " . $ArrInfoUser['Patronymic'] .
                    " (" . $ArrInfoUser['E-mail'] . ") ";

                print "<script>alert('".$str." | ".$ArrInfoUser['E-mail']."');</script>";

                if ( strcasecmp(trim($_POST['Email_to_user']), trim($str)) === 0 ) {


                    if ( strlen(trim($_POST['ThemeLetterPHP'])) > 2 || strlen(trim($_POST['MainContentLetterPHP'])) > 10 ) {

                        return "OK";


                    } else {

                        return "Некоректна тема або основна частина листа";
                    }


                } else {

                    continue;
                }

            }
        }

    return "Користувачу ' ". $_POST['Email_to_user'] ." ' не можна відправити пошту";

}

?>