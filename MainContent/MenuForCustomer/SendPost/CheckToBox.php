<?php

function CheckBox($connectMySQL) {


    $query_num_users = "SELECT COUNT(`Sender-ID`) FROM `User`";


    $data_num_users = mysqli_query($connectMySQL, $query_num_users);

    $NumOfUser = mysqli_fetch_array($data_num_users);


    for ($i = 0; $i <= $NumOfUser[0]; $i++ ) {

        $ArrInfoUser = DetermineAllUsers($connectMySQL, $i);

        if ($ArrInfoUser != false) {

            $str = $ArrInfoUser['SecondName'] . " " . $ArrInfoUser['FirstName'] . " " . $ArrInfoUser['Patronymic'] .
                " (" . $ArrInfoUser['E-mail'] . ") ";

            //print "<script>alert('".$str." | ".$ArrInfoUser['E-mail']."');</script>";

            if ( strcasecmp(trim($_POST['Email_to_user']), trim($str)) === 0 ) {


                if ( strlen(trim($_POST['WeightOfBox'])) > 0 && preg_match('/^[1-9]+/', trim($_POST['WeightOfBox'])) ) {

                    //return "OK";

                    $ID_user_from = mysqli_real_escape_string($connectMySQL, $_COOKIE['Sender-ID']);
                    $ID_user_to = mysqli_real_escape_string($connectMySQL, $i);

                    $TypeBox = mysqli_real_escape_string($connectMySQL, $_SESSION['TypeOfBox']);
                    $WeightBox = mysqli_real_escape_string($connectMySQL, $_SESSION['Weight']);

                    $CareBox = $_SESSION['CheckBox'] == 1 ? "ДОДАТКОВА ОБЕРЕЖНІСТЬ" : "";

                    $DescribeOfBox = mysqli_real_escape_string($connectMySQL, $_SESSION['Description']);

                    $desc_to_box = $TypeBox . " \n\n " . $DescribeOfBox . "\n\n| " . $CareBox . " |";

                    $date_time = date("Y-m-d H:i:s");

                    $query_insert_post_inf = "INSERT INTO `Post` (`TypePost`, `WeightPost`, `DescPost`, `DateOfReception`) VALUES
                                                                                    ('Посилка', '$WeightBox', '$desc_to_box', '$date_time')";


                    //Query for insert information about post.

                    mysqli_query($connectMySQL, $query_insert_post_inf);


                    $mysqli_id_post = mysqli_query($connectMySQL, "SELECT MAX(`ID-post`) FROM Post");

                    $id_post = mysqli_fetch_array($mysqli_id_post);

                    $query_insert_to_status_post = "INSERT INTO `Statuspost` (`ID-post`)
                                                        VALUES ('$id_post[0]')";

                    $query_insert_to_waybill = "INSERT INTO `Waybill` (`ID-post`, `ID-sender`, `ID-addressee`)
                                                    VALUES ('$id_post[0]', '$ID_user_from', '$ID_user_to')";


                    // Query for insert information about status of post.

                    mysqli_query($connectMySQL, $query_insert_to_status_post);


                    // Query for insert information about waybill.

                    mysqli_query($connectMySQL, $query_insert_to_waybill);


                    return "";

                } else {

                    return "Правильно заповніть всі поля";
                }


            } else {

                continue;
            }

        }
    }

    return "Користувачу ' ". $_POST['Email_to_user'] ." ' не можна відправити пошту";

}

?>