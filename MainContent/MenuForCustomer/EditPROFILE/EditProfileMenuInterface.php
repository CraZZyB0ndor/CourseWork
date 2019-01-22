<?php

$serverName = "localhost";
$userName = "root";
$password = "";
$nameDataBase = "PostOffice";

$connectMySQL = new mysqli($serverName, $userName, $password, $nameDataBase);

mysqli_query($connectMySQL, "SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");

include 'GetDataFromDB.php';

$array_info_user = GetData($connectMySQL);

if (!$array_info_user) {

    echo 'ERROR DB';

    exit();
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

<a href="" title="До головного меню"><img src="Images/restart.png"></a>

<img src="Images/question.png" id="HelpIMG" title="Допомога">

<main>

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

                                    <span class="UserDataFromPHP"><?php echo $array_info_user['SecondName']; ?></span>

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
                    <td><input type="text" name="NameUser" id="NameID" onkeyup="CheckEnterData('Name');"><img src="Images/delete.png" class="DeleteContentImage" onclick="document.getElementById('NameID').value = ''; CheckEnterData('Name');"></td>
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
                    <td><input type="text" name="PatronymicUser" id="PatronymicID" onkeyup="CheckEnterData('Patronymic');"><img src="Images/delete.png" class="DeleteContentImage" onclick="document.getElementById('PatronymicID').value = ''; CheckEnterData('Patronymic');"></td>
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
                    <td><input type="date" name="DateUser" id="DateID" onchange="CheckEnterData('Date');"></td>
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
                    <td><input type="text" name="AddressUser" id="AddressID" onkeyup="CheckEnterData('Address');"><img src="Images/delete.png" class="DeleteContentImage" onclick="document.getElementById('AddressID').value = ''; CheckEnterData('Address');"></td>
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
                    <td><input type="text" name="PhoneUser" id="PhoneID" onkeyup="CheckEnterData('Phone');"><img src="Images/delete.png" class="DeleteContentImage" onclick="document.getElementById('PhoneID').value = '+380'; CheckEnterData('Phone');"></td>
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
                    <td><input type="text" name="EmailUser" id="EmailID" onkeyup="CheckEnterData('Email');"><img src="Images/delete.png" class="DeleteContentImage" onclick="document.getElementById('EmailID').value = ''; CheckEnterData('Email');"></td>
                    <td class="ImageConfirmEditData"><img id="TFEmailIMG"></td>

                </tr>

                <tr>

                    <td class="NameCell">пароль: </td>
                    <td style="text-align: center;"><button id="ChangePassword" onclick="">змінити пароль</button></td>

                </tr>

            </table>

        </div>

    </div>

    <hr style="height: 1px; border: none; background-color: black; width: 900px; margin-top: 20px;">

    <input type="submit" value="ЗБЕРЕГТИ" id="SaveButton">


</main>


<div id="backgroundForModalWindow">

    <div id="ModalWindowForEditUserData">



        <input type="button" value="підтвердити" id="ConfirmChanges" onclick="AcceptEdit();">
        <input type="button" value="відмінити" id="DismissChanges" onclick="CancelEdit();">

        <span id="NameOfEditRow"></span>
    </div>

</div>


<div>

    <div>

        Modal window for changing password

    </div>

</div>

<script>

function CheckOnChange(name, element) {

        switch (name) {

            case 'Surname':

                if ( !('<?php echo $array_info_user['SecondName']; ?>' === element) ) {

                document.getElementsByClassName('SwitchChange')[0].style.display = 'inherit';

            } else { document.getElementsByClassName('SwitchChange')[0].style.display = 'none'; }

                break;

            case 'Name':

                if ( !('<?php echo $array_info_user['FirstName']; ?>' === element) ) {

                document.getElementsByClassName('SwitchChange')[1].style.display = 'inherit';

            } else { document.getElementsByClassName('SwitchChange')[1].style.display = 'none'; }

                break;

            case 'Patronymic':

                if ( !('<?php echo $array_info_user['Patronymic']; ?>' === element) ) {

                document.getElementsByClassName('SwitchChange')[2].style.display = 'inherit';

            } else { document.getElementsByClassName('SwitchChange')[2].style.display = 'none'; }

                break;

            case 'Date':

                if ( !('<?php echo $array_info_user['DateOfBirth']; ?>' === element) ) {

                document.getElementsByClassName('SwitchChange')[3].style.display = 'inherit';

            } else { document.getElementsByClassName('SwitchChange')[3].style.display = 'none'; }

                break;

            case 'Address':

                if ( !('<?php echo $array_info_user['Address']; ?>' === element) ) {

                document.getElementsByClassName('SwitchChange')[4].style.display = 'inherit';

            } else { document.getElementsByClassName('SwitchChange')[4].style.display = 'none'; }

                break;

            case 'Phone':

                if ( !('<?php echo $array_info_user['PhoneNumber']; ?>' === element) ) {

                document.getElementsByClassName('SwitchChange')[5].style.display = 'inherit';

            } else { document.getElementsByClassName('SwitchChange')[5].style.display = 'none'; }

                break;

            case 'Email':

                if ( !('<?php echo $array_info_user['E-mail']; ?>' === element) ) {

                document.getElementsByClassName('SwitchChange')[6].style.display = 'inherit';

            } else { document.getElementsByClassName('SwitchChange')[6].style.display = 'none'; }

                break;
        }

    }

</script>

<script src="EditScript.js"></script>

</body>
</html>