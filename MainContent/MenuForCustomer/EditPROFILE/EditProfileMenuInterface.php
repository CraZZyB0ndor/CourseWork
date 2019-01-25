<?php

$serverName = "localhost";
$userName = "root";
$password = "";
$nameDataBase = "PostOffice";

$connectMySQL = new mysqli($serverName, $userName, $password, $nameDataBase);

mysqli_query($connectMySQL, "SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");

include 'GetDataFromDB.php';

$array_info_user = GetData($connectMySQL);

$variable_after_saving_modal_window = 0;

if (!$array_info_user) {

    echo 'ERROR DB';

    exit();
}

if ( isset($_POST['SaveButtonSubmit']) ) {

    $query_update_data = "UPDATE `User` SET ";

    if (strlen($_POST['SurnameName']) !== 0 && $array_info_user['SecondName'] !== $_POST['SurnameName']) {

        $query_update_data .= " `SecondName` = '" . $_POST['SurnameName'] . "',";
    }

    if (strlen($_POST['UserName']) !== 0 && $array_info_user['FirstName'] !== $_POST['UserName']) {

        $query_update_data .= " `FirstName` = '" . $_POST['UserName'] . "',";
    }

    if (strlen($_POST['PatronymicName']) !== 0 && $array_info_user['Patronymic'] !== $_POST['PatronymicName']) {

        $query_update_data .= " `Patronymic` = '". $_POST['PatronymicName'] . "',";
    }

    if (strlen($_POST['DateName']) !== 0 && $array_info_user['DateOfBirth'] !== $_POST['DateName']) {

        $query_update_data .= " `DateOfBirth` = '". $_POST['DateName'] . "',";
    }

    if (strlen($_POST['AddressName']) !== 0 && $array_info_user['Address'] !== $_POST['AddressName']) {

        $query_update_data .= " `Address` = '". $_POST['AddressName'] . "',";
    }

    if (strlen($_POST['PhoneName']) !== 0 && $array_info_user['PhoneNumber'] !== $_POST['PhoneName']) {

        $query_update_data .= " `PhoneNumber` = '". $_POST['PhoneName'] . "',";
    }

    if (strlen($_POST['EmailName']) !== 0 && $array_info_user['E-mail'] !== $_POST['EmailName']) {

        $query_update_data .= " `E-mail` = '". $_POST['EmailName'] . "',";
    }

    if (strlen($_POST['PasswordName']) !== 0 && $array_info_user['Password'] !== $_POST['PasswordName']) {

        $query_update_data .= " `Password` = '". $_POST['PasswordName'] . "'";
    }

    //*

    if ( substr($query_update_data, -1, 1) === ',') {

        $query_update_data = substr($query_update_data, 0, strlen($query_update_data)-1 );
    }

    //*

    $query_update_data .= " WHERE `Sender-ID` = '" . $_COOKIE['Sender-ID'] . "'";

    mysqli_query($connectMySQL, $query_update_data);

    $variable_after_saving_modal_window = 1;

    $array_info_user = GetData($connectMySQL);
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ПРОФІЛЬ</title>

    <link href="https://fonts.googleapis.com/css?family=Russo+One" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Cuprum" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300" rel="stylesheet">

    <link rel="stylesheet" href="EditProfileMenuInterfaceStyle.css">

</head>
<body style="background-image: url('Images/blur-bright-close-up-1405773.jpg'); background-attachment: fixed;">

<p>ПРОФІЛЬ</p>

<a href="http://localhost/dashboard/CourseWork/MainContent/MenuForCustomer/CustomerMenuPHP.php" title="До головного меню"><img src="Images/restart.png"></a>

<img src="Images/question.png" id="HelpIMG" title="Допомога">

<main>

    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="application/x-www-form-urlencoded">

    <div>

        <div id="BlockOfProfIMG">
            <div id="UserImage"><img src="Images/man-user.png"></div>
            <input type="button" value="Завантажити фото">
        </div>


        <div id="BlockOfDataUser">

            <table cellspacing="20" cellpadding="5">

                <tr id="SurnameStyleID">

                            <td class="NameCell">прізвище: </td>
                            <td>

                                <div>

                                    <span class="UserDataFromPHP" ><?php echo $array_info_user['SecondName']; ?></span>

                                    <div class="HelpSwitchChange">

                                    <sup>

                                        <img src="Images/notifications_about_change_info.png" class="SwitchChange">

                                    </sup>

                                    <span class="ToolipHelpSwitchChange">

                                        <span style="color: #FF6D00; text-transform: uppercase; font-weight: bold;">Поле було редаговано!</span> <br>

                                        <span style="text-transform: uppercase"></span>Первинне значення поля<br><span style="color: royalblue; font-weight: bold;">↓</span><br><span style="font-weight: bold;"><?php echo $array_info_user['SecondName']; ?></span>


                                    </span>

                                    </div>

                                </div>

                            </td>

                    <td class="ImageEditData"><img src="Images/pencil-edit-button.png" id="EditSurnameIMG" onclick="EditMenu('Surname'); CheckEnterData('Surname');"></td>
                    <td><input type="text" name="SurnameName" id="SurnameID" onkeyup="CheckEnterData('Surname');"><img src="Images/delete.png" class="DeleteContentImage" onclick="document.getElementById('SurnameID').value = ''; CheckEnterData('Surname');"></td>
                    <td class="ImageConfirmEditData"><img id="TFSurnameIMG"></td>

                </tr>

                <tr id="NameStyleID">

                            <td class="NameCell">ім'я: </td>
                            <td>
                                <div>
                                    <span class="UserDataFromPHP"><?php echo $array_info_user['FirstName']; ?></span>

                                    <div class="HelpSwitchChange">

                                        <sup>

                                            <img src="Images/notifications_about_change_info.png" class="SwitchChange">

                                        </sup>

                                        <span class="ToolipHelpSwitchChange">

                                        <span style="color: #FF6D00; text-transform: uppercase; font-weight: bold;">Поле було редаговано!</span> <br>

                                        <span style="text-transform: uppercase"></span>Первинне значення поля<br><span style="color: royalblue;">↓</span><br><span style="font-weight: bold;"><?php echo $array_info_user['FirstName']; ?></span>


                                    </span>

                                    </div>

                                </div>

                            </td>


                    <td class="ImageEditData"><img src="Images/pencil-edit-button.png" id="EditNameIMG" onclick="EditMenu('Name'); CheckEnterData('Name');"></td>
                    <td><input type="text" name="UserName" id="NameID" onkeyup="CheckEnterData('Name');"><img src="Images/delete.png" class="DeleteContentImage" onclick="document.getElementById('NameID').value = ''; CheckEnterData('Name');"></td>
                    <td class="ImageConfirmEditData"><img id="TFNameIMG"></td>

                </tr>

                <tr id="PatronymicStyleID">

                            <td class="NameCell">ім'я по батькові: </td>
                            <td>
                                <div>

                                    <span class="UserDataFromPHP"><?php echo $array_info_user['Patronymic']; ?></span>

                                    <div class="HelpSwitchChange">

                                        <sup>

                                            <img src="Images/notifications_about_change_info.png" class="SwitchChange">

                                        </sup>

                                        <span class="ToolipHelpSwitchChange">

                                        <span style="color: #FF6D00; text-transform: uppercase; font-weight: bold;">Поле було редаговано!</span> <br>

                                        <span style="text-transform: uppercase"></span>Первинне значення поля<br><span style="color: royalblue;">↓</span><br><span style="font-weight: bold;"><?php echo $array_info_user['Patronymic']; ?></span>


                                    </span>

                                    </div>

                                </div>

                            </td>

                    <td class="ImageEditData"><img src="Images/pencil-edit-button.png" id="EditPatronymicIMG" onclick="EditMenu('Patronymic'); CheckEnterData('Patronymic');"></td>
                    <td><input type="text" name="PatronymicName" id="PatronymicID" onkeyup="CheckEnterData('Patronymic');"><img src="Images/delete.png" class="DeleteContentImage" onclick="document.getElementById('PatronymicID').value = ''; CheckEnterData('Patronymic');"></td>
                    <td class="ImageConfirmEditData"><img id="TFPatronymicIMG"></td>

                </tr>

                <tr id="DateStyleID">

                            <td class="NameCell">дата народження: </td>
                            <td>
                                <div>

                                    <span class="UserDataFromPHP"><?php echo $array_info_user['DateOfBirth']; ?></span>

                                    <div class="HelpSwitchChange">

                                        <sup>

                                            <img src="Images/notifications_about_change_info.png" class="SwitchChange">

                                        </sup>

                                        <span class="ToolipHelpSwitchChange">

                                        <span style="color: #FF6D00; text-transform: uppercase; font-weight: bold;">Поле було редаговано!</span> <br>

                                        <span style="text-transform: uppercase"></span>Первинне значення поля<br><span style="color: royalblue;">↓</span><br><span style="font-weight: bold;"><?php echo $array_info_user['DateOfBirth']; ?></span>


                                    </span>

                                    </div>

                                </div>

                            </td>

                    <td class="ImageEditData"><img src="Images/pencil-edit-button.png" id="EditDateIMG" onclick="EditMenu('Date'); CheckEnterData('Date');"></td>
                    <td><input type="date" name="DateName" id="DateID" onchange="CheckEnterData('Date');"></td>
                    <td class="ImageConfirmEditData"><img id="TFDateIMG"></td>

                </tr>

                <tr id="AddressStyleID">

                            <td class="NameCell">адреса: </td>
                            <td>

                                <div>

                                    <span class="UserDataFromPHP"><?php echo $array_info_user['Address']; ?></span>

                                    <div class="HelpSwitchChange">

                                        <sup>

                                            <img src="Images/notifications_about_change_info.png" class="SwitchChange">

                                        </sup>

                                        <span class="ToolipHelpSwitchChange">

                                        <span style="color: #FF6D00; text-transform: uppercase; font-weight: bold;">Поле було редаговано!</span> <br>

                                        <span style="text-transform: uppercase"></span>Первинне значення поля<br><span style="color: royalblue;">↓</span><br><span style="font-weight: bold;"><?php echo $array_info_user['Address']; ?></span>


                                    </span>

                                    </div>

                                </div>

                            </td>

                    <td class="ImageEditData"><img src="Images/pencil-edit-button.png" id="EditAddressIMG" onclick="EditMenu('Address'); CheckEnterData('Address');"></td>
                    <td><input type="text" name="AddressName" id="AddressID" onkeyup="CheckEnterData('Address');"><img src="Images/delete.png" class="DeleteContentImage" onclick="document.getElementById('AddressID').value = ''; CheckEnterData('Address');"></td>
                    <td class="ImageConfirmEditData"><img id="TFAddressIMG"></td>

                </tr>

                <tr id="PhoneStyleID">

                            <td class="NameCell">телефон: </td>
                            <td>

                                <div>

                                    <span class="UserDataFromPHP"><?php echo $array_info_user['PhoneNumber']; ?></span>

                                    <div class="HelpSwitchChange">

                                        <sup>

                                            <img src="Images/notifications_about_change_info.png" class="SwitchChange">

                                        </sup>

                                        <span class="ToolipHelpSwitchChange">

                                        <span style="color: #FF6D00; text-transform: uppercase; font-weight: bold;">Поле було редаговано!</span> <br>

                                        <span style="text-transform: uppercase"></span>Первинне значення поля<br><span style="color: royalblue;">↓</span><br><span style="font-weight: bold;"><?php echo $array_info_user['PhoneNumber']; ?></span>


                                    </span>

                                    </div>

                                </div>

                            </td>

                    <td class="ImageEditData"><img src="Images/pencil-edit-button.png" id="EditPhoneIMG" onclick="EditMenu('Phone'); CheckEnterData('Phone');"></td>
                    <td><input type="text" name="PhoneName" id="PhoneID" onkeyup="CheckEnterData('Phone');"><img src="Images/delete.png" class="DeleteContentImage" onclick="document.getElementById('PhoneID').value = '+380'; CheckEnterData('Phone');"></td>
                    <td class="ImageConfirmEditData"><img id="TFPhoneIMG"></td>

                </tr>

                <tr>

                    <td class="NameCell">номер та серія паспорта: </td>
                    <td><?php echo $array_info_user['NSPassport']; ?></td>

                </tr>

                <tr id="EmailStyleID">

                            <td class="NameCell">E-mail: </td>
                            <td>

                                <div>

                                    <span class="UserDataFromPHP"><?php echo $array_info_user['E-mail']; ?></span>

                                    <div class="HelpSwitchChange">

                                        <sup>

                                            <img src="Images/notifications_about_change_info.png" class="SwitchChange">

                                        </sup>

                                        <span class="ToolipHelpSwitchChange">

                                        <span style="color: #FF6D00; text-transform: uppercase; font-weight: bold;">Поле було редаговано!</span> <br>

                                        <span style="text-transform: uppercase"></span>Первинне значення поля<br><span style="color: royalblue;">↓</span><br><span style="font-weight: bold;"><?php echo $array_info_user['E-mail']; ?></span>


                                    </span>

                                    </div>

                                </div>

                            </td>

                    <td class="ImageEditData"><img src="Images/pencil-edit-button.png" id="EditEmailIMG" onclick="EditMenu('Email'); CheckEnterData('Email');"></td>
                    <td><input type="text" name="EmailName" id="EmailID" onkeyup="CheckEnterData('Email');"><img src="Images/delete.png" class="DeleteContentImage" onclick="document.getElementById('EmailID').value = ''; CheckEnterData('Email');"></td>
                    <td class="ImageConfirmEditData"><img id="TFEmailIMG"></td>

                </tr>

                <tr>

                    <td class="NameCell">пароль: </td>
                    <td style="text-align: center;"><a id="ChangePassword" onclick="document.getElementById('backgroundForWindowChangePassword').style.display = 'flex';">змінити пароль</a><img id="ChangePasswordIMG" src="Images/notifications_about_change_info.png"></td>

                </tr>

            </table>

        </div>

    </div>

    <hr style="height: 1px; border: none; background-color: black; width: 900px; margin-top: 20px;">

    <input type="submit" value="ЗБЕРЕГТИ" id="SaveButton" name="SaveButtonSubmit">

        <input type="text" name="PasswordName" id="PasswordID">

    </form>

</main>


<div id="backgroundForModalWindow">

    <div id="ModalWindowForEditUserData">



        <input type="button" value="підтвердити" id="ConfirmChanges" onclick="AcceptEdit();">
        <input type="button" value="відмінити" id="DismissChanges" onclick="CancelEdit();">

        <span id="NameOfEditRow"></span>
    </div>

</div>


<div id="backgroundForWindowChangePassword">

    <div id="WindowChangePassword">

        <img src="Images/multiply.png" onclick="ClosePasswordChangeWindow();">
        <img src="Images/question.png">

        <p>ЗМІНА ПАРОЛЯ</p>

        <hr style="height: 1px; border: none; background-color: black; width: 550px; margin-top: 10px; margin-bottom: 20px;">

        <div onclick="document.getElementById('WindowChangePassword').style.display = 'none'; document.getElementById('WindowChangePasswordStepPassword').style.display = 'flex';"><div class="SelectWayPassword1">1</div><p>Я пам'ятаю свій пароль</p></div>

        <div><div class="SelectWayPassword2">2</div><p>Я пам'ятаю E-mail на який зареєстрований мій профіль</p></div>

        <div><div class="SelectWayPassword3">3</div><p>Я нічого не пам'ятаю</p></div>

        <input type="button" onclick="document.getElementById('backgroundForWindowChangePassword').style.display = 'none';" value="ВІДМІНИТИ">

    </div>


    <div id="WindowChangePasswordStepPassword">

        <img src="Images/restart.png" onclick="ClosePasswordChangeWindow(1);">
        <img src="Images/question.png">

        <p>Я ПАМ'ЯТАЮ СВІЙ ПАРОЛЬ</p>

        <hr style="height: 1px; border: none; background-color: black; width: 550px; margin-top: 10px; margin-bottom: 20px;">

        <div id="OldPasswordContainer"><p>Введіть свій пароль: </p><input type="password" id="OldPassword"><img src="Images/send-button.png" onclick="CheckOldPassword();" id='SendOldPassword'></div>

        <span id="ErrorChangePassword">Пароль невірний</span>

        <div id="NewPasswordContainer">

            <p>Введіть новий пароль: </p>

            <input type="password" id="InputNewPassword" onkeyup="CheckNewPassword();"><img id="StatusNewPassword"></div>

        <input type="button" id="SaveNewPassword" value="ЗБЕРЕГТИ" onclick="SaveNewPassword();">
        

        <input id="CloseWindowPassword" type="button" onclick="ClosePasswordChangeWindow();" value="ВІДМІНИТИ">
        
    </div>


</div>


<div id="backgroundForWindowConfirmPassword">


    <div id="NotificationsForNewPassword">

        <span>ПАРОЛЬ ПРИЙНЯТО</span>

        <hr style="height: 1px; border: none; background-color: black; width: 550px; margin-top: 10px;">

        <p>Вітаємо! Ваш новий пароль прийнято. Для збереження пароля та інших редагованих Вами даних потрібно натиснути на кнопку "ЗБЕРЕГТИ"<br>↓</p>

        <img src="Images/Button_save_edit_information.png" id="HelpSaveButton">

        <div id="OKButton" onclick="document.getElementById('backgroundForWindowConfirmPassword').style.display = 'none';"><img src="Images/mail.png"></div>

    </div>


</div>


<div id="backgroundForWindowDismissOldPassword">

    <div id="NotificationsForOldPassword">

        <span>ПАРОЛЬ ПРИЙНЯТО</span>

        <hr style="height: 1px; border: none; background-color: black; width: 550px; margin-top: 10px;">

        <p>Вітаємо! Ваш пароль прийнято. Ви вписали свій старий пароль. Його збереження не вимагається. Для збереження редагованих Вами даних потрібно натиснути на кнопку "ЗБЕРЕГТИ"<br>↓</p>

        <img src="Images/Button_save_edit_information_2.png" id="HelpUnSaveButton">

        <div id="OKButtonOld" onclick="document.getElementById('backgroundForWindowDismissOldPassword').style.display = 'none';"><img src="Images/mail.png"></div>

    </div>

</div>


<div id="backgroundForWindowAfterSaveData">

   <div id="AfterSaveNotifications">

       <p>ВАШІ ДАНІ УСПІШНО ЗБЕРЕЖЕНІ!</p>

       <hr style="height: 1px; border: none; background-color: black; width: 550px; margin-top: 10px;">


       <div>

           <a href="http://localhost/dashboard/CourseWork/MainContent/MenuForCustomer/CustomerMenuPHP.php">ПЕРЕЙТИ ДО ГОЛОВНОГО МЕНЮ</a>

           <a onclick="document.getElementById('backgroundForWindowAfterSaveData').style.display = 'none';">ЗАЛИШИТИСЯ НА ЦІЙ СТОРІНЦІ</a>

       </div>

   </div>

</div>


<script>


    if ( <?php echo $variable_after_saving_modal_window; ?> === 1) {

        document.getElementById('backgroundForWindowAfterSaveData').style.display = 'flex';

    } else {

        document.getElementById('backgroundForWindowAfterSaveData').style.display = 'none';
    }

function CheckOnChange(name, element) {

        switch (name) {

            case 'Surname':

                if ( !('<?php echo $array_info_user['SecondName']; ?>' === element) ) {

                document.getElementsByClassName('SwitchChange')[0].style.display = 'inherit';

                document.getElementById('SaveButton').style.display = 'block';

            } else { document.getElementsByClassName('SwitchChange')[0].style.display = 'none'; }

                break;

            case 'Name':

                if ( !('<?php echo $array_info_user['FirstName']; ?>' === element) ) {

                document.getElementsByClassName('SwitchChange')[1].style.display = 'inherit';

                document.getElementById('SaveButton').style.display = 'block';

            } else { document.getElementsByClassName('SwitchChange')[1].style.display = 'none'; }

                break;

            case 'Patronymic':

                if ( !('<?php echo $array_info_user['Patronymic']; ?>' === element) ) {

                document.getElementsByClassName('SwitchChange')[2].style.display = 'inherit';

                    document.getElementById('SaveButton').style.display = 'block';

            } else { document.getElementsByClassName('SwitchChange')[2].style.display = 'none'; }

                break;

            case 'Date':

                if ( !('<?php echo $array_info_user['DateOfBirth']; ?>' === element) ) {

                document.getElementsByClassName('SwitchChange')[3].style.display = 'inherit';

                    document.getElementById('SaveButton').style.display = 'block';

            } else { document.getElementsByClassName('SwitchChange')[3].style.display = 'none'; }

                break;

            case 'Address':

                if ( !('<?php echo $array_info_user['Address']; ?>' === element) ) {

                document.getElementsByClassName('SwitchChange')[4].style.display = 'inherit';

                document.getElementById('SaveButton').style.display = 'block';

            } else { document.getElementsByClassName('SwitchChange')[4].style.display = 'none'; }

                break;

            case 'Phone':

                if ( !('<?php echo $array_info_user['PhoneNumber']; ?>' === element) ) {

                document.getElementsByClassName('SwitchChange')[5].style.display = 'inherit';

                document.getElementById('SaveButton').style.display = 'block';

            } else { document.getElementsByClassName('SwitchChange')[5].style.display = 'none'; }

                break;

            case 'Email':

                if ( !('<?php echo $array_info_user['E-mail']; ?>' === element) ) {

                document.getElementsByClassName('SwitchChange')[6].style.display = 'inherit';

                document.getElementById('SaveButton').style.display = 'block';

            } else { document.getElementsByClassName('SwitchChange')[6].style.display = 'none'; }

                break;
        }

    }

function CheckOldPassword() {

    if ( document.getElementById('OldPassword').value === '<?php echo  $array_info_user['Password']; ?>' ) {

        document.getElementById('OldPasswordContainer').style.display = 'none';
        document.getElementById('ErrorChangePassword').style.display = 'none';

        document.getElementById('OldPassword').value = '';

        document.getElementById('NewPasswordContainer').style.display = 'flex';
        document.getElementById('SaveNewPassword').style.display = 'block';

        document.getElementById('InputNewPassword').value = '';

        CheckNewPassword();

    } else {

        document.getElementById('ErrorChangePassword').style.visibility = 'visible';
    }

}

function CheckNewPassword() {


    if (NewPasswordCheacker())  {

        document.getElementById('SaveNewPassword').style.visibility = 'visible';

    } else {

        document.getElementById('SaveNewPassword').style.visibility = 'hidden';
    }
}

function SaveNewPassword() {

    if (document.getElementById('InputNewPassword').value !== '<?php echo  $array_info_user['Password']; ?>') {

        document.getElementById('ChangePasswordIMG').style.display = 'initial';

        document.getElementById('backgroundForWindowChangePassword').style.display = 'none';

        document.getElementById('OldPasswordContainer').style.display = 'flex';
        document.getElementById('ErrorChangePassword').style.display = 'block';

        document.getElementById('ErrorChangePassword').style.visibility = 'hidden';

        document.getElementById('NewPasswordContainer').style.display = 'none';
        document.getElementById('SaveNewPassword').style.display = 'none';
        document.getElementById('SaveNewPassword').style.visibility = 'hidden';

        document.getElementById('WindowChangePassword').style.display = 'flex';

        document.getElementById('WindowChangePasswordStepPassword').style.display = 'none';

        document.getElementById('backgroundForWindowConfirmPassword').style.display ='flex';

        document.getElementById('PasswordID').value = document.getElementById('InputNewPassword').value;

        document.getElementById('SaveButton').style.display = 'block';

    } else {

        document.getElementById('ChangePasswordIMG').style.display = 'none';

        document.getElementById('backgroundForWindowChangePassword').style.display = 'none';

        document.getElementById('OldPasswordContainer').style.display = 'flex';
        document.getElementById('ErrorChangePassword').style.display = 'block';

        document.getElementById('ErrorChangePassword').style.visibility = 'hidden';

        document.getElementById('NewPasswordContainer').style.display = 'none';
        document.getElementById('SaveNewPassword').style.display = 'none';
        document.getElementById('SaveNewPassword').style.visibility = 'hidden';

        document.getElementById('WindowChangePassword').style.display = 'flex';

        document.getElementById('WindowChangePasswordStepPassword').style.display = 'none';


        document.getElementById('backgroundForWindowDismissOldPassword').style.display = 'flex';

        document.getElementById('PasswordID').value = document.getElementById('InputNewPassword').value;

    }

}

function NewPasswordCheacker() {

    var arrayPasssChars = document.getElementById('InputNewPassword').value;
    var Uppercasechars = 0;
    var LowCaseChars = 0;
    var Numbers = 0;
    var Repeated = 0;
    var result;

    var Password = document.getElementById('InputNewPassword');
    var PasswordIMG = document.getElementById('StatusNewPassword');

    function CheckOnChars() {

        if (/\s/.test(arrayPasssChars) || /\W/.test(arrayPasssChars) || (arrayPasssChars !== 0 && arrayPasssChars.length <= 4) ) {

            return 0;

        } else {

            for (var i = 0; i < arrayPasssChars.length; i++) {

                if (/[A-Z]/.test(arrayPasssChars[i])) {
                    Uppercasechars++;
                }

                if (/[a-z]/.test(arrayPasssChars[i])) {
                    LowCaseChars++;
                }

                if (/[0-9]/.test(arrayPasssChars[i])) {
                    Numbers++;
                }

                if (arrayPasssChars[0] === arrayPasssChars[i]) {
                    Repeated++;
                }

            }

            if (Uppercasechars === arrayPasssChars.length || Uppercasechars === 0 || LowCaseChars === 0 || Numbers === 0 || Repeated === arrayPasssChars.length) {
                return 1;
            } else {
                return 2;
            }

        }

    }

    result = CheckOnChars();

    if (result === 0) {

        if (Password.value.length === 0) {

            PasswordIMG.style.visibility = "hidden";
            return false;

        } else {
            PasswordIMG.style.visibility = "visible";
            PasswordIMG.src = "Images/0.png";
            return false;
        }


    } else if (result === 1) {

        if (Password.value.length === 0) {

            PasswordIMG.style.visibility = "hidden";
            PasswordIMG.src = "";
            return false;

        } else if (Password.value.length <= 4) {

            PasswordIMG.style.visibility = "visible";
            PasswordIMG.src = "Images/0.png";
            return false;

        } else {

            PasswordIMG.style.visibility = "visible";
            PasswordIMG.src = "Images/1.png";
            return true;
        }

    } else if (result === 2) {

        if (Password.value.length <= 6) {

            PasswordIMG.style.visibility = "visible";
            PasswordIMG.src = "Images/1.png";
            return true;

        } else if (Password.value.length <= 8) {

            PasswordIMG.style.visibility = "visible";
            PasswordIMG.src = "Images/2.png";
            return true;

        } else { PasswordIMG.src = "Images/3.png"; PasswordIMG.style.visibility = "visible"; return true; }

    }

}

function ClosePasswordChangeWindow(variable) {

    if (variable === 1) {

        document.getElementById('WindowChangePasswordStepPassword').style.display = 'none';

        document.getElementById('OldPasswordContainer').style.display = 'flex';
        document.getElementById('ErrorChangePassword').style.display = 'block';

        document.getElementById('OldPassword').value = '';

        document.getElementById('ErrorChangePassword').style.visibility = 'hidden';

        document.getElementById('NewPasswordContainer').style.display = 'none';
        document.getElementById('SaveNewPassword').style.display = 'none';
        document.getElementById('SaveNewPassword').style.visibility = 'hidden';

        document.getElementById('InputNewPassword').value = '<?php echo  $array_info_user['Password']; ?>';

        document.getElementById('WindowChangePassword').style.display = 'flex';

        return;

    }

    document.getElementById('backgroundForWindowChangePassword').style.display = 'none';

    document.getElementById('OldPasswordContainer').style.display = 'flex';
    document.getElementById('ErrorChangePassword').style.display = 'block';

    document.getElementById('ErrorChangePassword').style.visibility = 'hidden';

    document.getElementById('NewPasswordContainer').style.display = 'none';
    document.getElementById('SaveNewPassword').style.display = 'none';
    document.getElementById('SaveNewPassword').style.visibility = 'hidden';

    document.getElementById('InputNewPassword').value = '<?php echo  $array_info_user['Password']; ?>';

    document.getElementById('WindowChangePassword').style.display = 'flex';

    document.getElementById('WindowChangePasswordStepPassword').style.display = 'none';

}

</script>

<script src="EditScript.js"></script>

</body>
</html>