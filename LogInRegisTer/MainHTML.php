<?php// ---> PHP script without refactoring.session_start();$serverName = "localhost";$userName = "root";$password = "";$nameDataBase = "PostOffice";$connectMySQL = new mysqli($serverName, $userName, $password, $nameDataBase);mysqli_query($connectMySQL, "SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");//if($connectMySQL->connect_error) { die("FAIL: " . mysqli_connect_error()); } else { echo "Successfully!"; }        $ErrorLogIn = 0;        $ErrorRegIn = 3;        $ArrayWithValuesForReg = ["", "", "", "", "", "", "", ""];        $RightOrNOT = 3;    include "SendMailFunc.php";// Login window.//print_r($_COOKIE);    if (!isset($_COOKIE['Sender-ID'])) {        if (isset($_POST['LogInSubmit'])) {            $LogIn = mysqli_real_escape_string($connectMySQL, trim($_POST['LoginAccess']));            $PasswordIn = mysqli_real_escape_string($connectMySQL, trim($_POST['PasswordAccess']));            if (!empty($LogIn) && !empty($PasswordIn)) {                $query = "SELECT `Sender-ID`, `E-mail` FROM `User` WHERE `E-mail` = '$LogIn' AND `Password` = '$PasswordIn'";                $data = mysqli_query($connectMySQL, $query);                if (mysqli_num_rows($data) === 1) {                    $row =  mysqli_fetch_assoc($data);                    $ErrorLogIn = 0;                    setcookie('Sender-ID', $row['Sender-ID'], (int)(time()+(60*60*24*30)), '/');                    setcookie('E-mail', $row['E-mail'], (int)(time()+(60*60*24*30)), '/');                    session_unset();                    session_destroy();                    mysqli_close($connectMySQL);                   header('Location: ' . "http://localhost/dashboard/CourseWork/MainContent/MenuForCustomer/CustomerMenuPHP.php");                } else {                    $ErrorLogIn = 1;                }            } else {                $ErrorLogIn = 3;            }        }    }// Registration window.    if (isset($_POST['RegistrationButton'])) {        $SecondName = mysqli_real_escape_string($connectMySQL, trim($_POST['SecondNameForm']));        $FirstName = mysqli_real_escape_string($connectMySQL, trim($_POST['FirstNameForm']));        $Patronymic = mysqli_real_escape_string($connectMySQL, trim($_POST['PatronymicForm']));        $DateOfBirth = mysqli_real_escape_string($connectMySQL, trim($_POST['DateOFBirthForm']));        $Address = mysqli_real_escape_string($connectMySQL, trim($_POST['AdressForm']));        $PhoneNumber = mysqli_real_escape_string($connectMySQL, trim($_POST['PhoneForm']));        $PassportNumSer = mysqli_real_escape_string($connectMySQL, trim($_POST['PassportNumForm']));        $Email = mysqli_real_escape_string($connectMySQL, trim($_POST['LoginRForm']));        $Password = mysqli_real_escape_string($connectMySQL, trim($_POST['PasswordRTForm']));    $_SESSION['SN'] = $ArrayWithValuesForReg[0] = $_POST['SecondNameForm'];    $_SESSION['FN'] = $ArrayWithValuesForReg[1] = $_POST['FirstNameForm'];    $_SESSION['PN'] = $ArrayWithValuesForReg[2] = $_POST['PatronymicForm'];    $ArrayWithValuesForReg[3] = $_POST['DateOFBirthForm'];    $ArrayWithValuesForReg[4] = $_POST['AdressForm'];    $ArrayWithValuesForReg[5] = $_POST['PhoneForm'];    $ArrayWithValuesForReg[6] = $_POST['PassportNumForm'];    $_SESSION['EM'] = $ArrayWithValuesForReg[7] = $_POST['LoginRForm'];    $checkOnSameEmail = mysqli_query($connectMySQL, "SELECT `E-mail` FROM `User` WHERE `E-mail` = '$Email'");    $_SESSION['insertQuery'] = $query = "INSERT INTO `User` (`SecondName`, `FirstName`, `Patronymic`, `DateOfBirth`, `Address`, `PhoneNumber`, `NSPassport`, `E-mail`, `Password`) VALUES                   ('$SecondName', '$FirstName', '$Patronymic', '$DateOfBirth', '$Address', '$PhoneNumber', '$PassportNumSer', '$Email', '$Password')";    if ( !(mysqli_num_rows($checkOnSameEmail) === 1) ) {        $ErrorRegIn = 2;        $RandomCodeForCheckEmail = "".rand(10000, 99999);        $_SESSION['RandomValue'] = $RandomCodeForCheckEmail;        $content = "<div style='width: 600px; height: 250px; background-color: #ffbe2e; font-size: 20px; color: black; text-align: center; padding: 10px; border: solid 1px black;'>Шановний(а)         <span style='font-weight: bold; '>" . $ArrayWithValuesForReg[0] . " " . $ArrayWithValuesForReg[1] . " " . $ArrayWithValuesForReg[2] .         "</span>, будь ласка, підтвердіть свій E-mail!<br /><br /><div style='text-align: center; font-size: 25px;'>Код підтвердження:         <p style='color: white; background: black; font-size: 30px; margin-top: 30px; padding: 20px; text-align: center'>" . $RandomCodeForCheckEmail . "</p></div></div>";        SendCheckEmail($content, $ArrayWithValuesForReg[7]);    } else { $ErrorRegIn = 1; }    }// Check E-mail window and INSERT.    if (isset($_POST['ButToSend'])) {        if ( strcasecmp(trim($_POST['CodeValue']), $_SESSION['RandomValue']) === 0 ) {                 $RightOrNOT = 1;                mysqli_query($connectMySQL, $_SESSION['insertQuery']);        $content = "<div style='width: 1000px; height: 300px; background-color: #ffbe2e; font-size: 20px; color: black; text-align: center; padding: 10px; border: solid 1px black;'>Шановний(а)         <span style='font-weight: bold; '>" . $_SESSION['SN'] . " " . $_SESSION['FN'] . " " . $_SESSION['PN'] ."</span>, вітаємо Вас з реєстрацією на сайті <a href='' style='cursor: pointer;'>НАША ПОШТА</a>!<br><br>НАША ПОШТА піклується про всіх своїх клієнтів,     тому надає технічну підтримку 24 години на добу.<br><a href='' style='cursor: pointer;'>...cc...</a><br>Ми робимо життя яскравішим та довшим!<br><br> З турботою про Вас! </div>";        SendCheckEmail($content, $_SESSION['EM']);            } else { $RightOrNOT = 2; }}?><!DOCTYPE html><html lang="en" xmlns="http://www.w3.org/1999/html"><head>    <meta charset="UTF-8">    <title>НАША ПОШТА</title>    <link rel="stylesheet" href="StyleLogInRegisTer.css">    <link href="https://fonts.googleapis.com/css?family=Lobster|Open+Sans+Condensed:300" rel="stylesheet">    <link href="https://fonts.googleapis.com/css?family=Russo+One" rel="stylesheet">    <link href="https://fonts.googleapis.com/css?family=Kosugi" rel="stylesheet">    <link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300" rel="stylesheet">    <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">    <link href="https://fonts.googleapis.com/css?family=Kosugi" rel="stylesheet">    <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script></head><body><header>    <div id="containerLogo">        <img id="logo" src="Images/truck.png"/>        <span id="nameCompany">наша пошта</span>    </div>    <div id="profileAbout">        <div class="aboutPost"><a href="">про пошту</a></div>        <div class="profile"><img  id="profileIMG" src="Images/avatar.png"/></div>    </div>        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="application/x-www-form-urlencoded">        <div class="topLogReg">                        <span id="ErrorLogIn" Style="color: darkred; font-size: 12px; top: 0; position: absolute; display: block;"></span>                        <p style="padding-top: 5px;">логін: </p>                        <input id="loginArea" class="F"  type="text" name="LoginAccess">                        <p>пароль:</p>                        <input id="passwordArea" class="F"  type="password" name="PasswordAccess">            <div class="sendTo">                                <a id="registerBut">реєстрація</a>                                <input type="submit" value="ВХІД" id="EnterButton" name="LogInSubmit">                <div class="AcessTo">                                        <a>забули пароль?</a>                                        <span class="socialAcess"><img src="Images/search.png"/></span>                    <span class="socialAcess"><img src="Images/outlook.png"/></span>                                    </div>            </div>        </div>    </form></header><main>    <img id="mainPoster" src="Images/ПостерПоштовогоВідділу.jpg"/>    <div id="modalWindow" class="modal">                <div class="modal-content">                        <span class="close" title="Close" about="close"><img src="Images/exit.png"/></span>                        <h3 id="regHeader">реєстрація</h3>                                    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="application/x-www-form-urlencoded">                <div class="FieldsForRegistration">                    <table>                        <tr>                            <td><span class="nameFieldReg">Прізвище<sup>*</sup></span></td>                            <td><input type="text" id="SecondName" class="StyleInputReg" name="SecondNameForm" onkeyup="Validation(1)" required></td>                            <td><img class="posANDsize" id="SecondNameIMG" ></td>                        </tr>                        <tr>                            <td><span class="nameFieldReg">Ім'я<sup>*</sup></span></td>                            <td><input type="text" id="FirstName" class="StyleInputReg" name="FirstNameForm" onkeyup="Validation(2)" required></td>                            <td><img class="posANDsize" id="FirstNameIMG"></td>                        </tr>                        <tr>                            <td><span class="nameFieldReg">Ім'я по батькові<sup>*</sup></span></td>                            <td><input type="text" id="Patronymic" class="StyleInputReg" name="PatronymicForm" onkeyup="Validation(3)" required></td>                            <td><img class="posANDsize" id="PatronymicIMG"></td>                        </tr>                        <tr>                            <td><span class="nameFieldReg">Дата народження<sup>*</sup></span></td>                            <td><input type="date" id="DateOFBirth" name="DateOFBirthForm" onchange="Validation(4)"  class="StyleInputReg" value="2000-02-15" min="1898-01-01" max="2010-01-01" required></td>                            <td><img class="posANDsize" id="DateOFBirthIMG" src="Images/checked%20(1).png"></td>                        </tr>                        <tr>                            <td><span class="nameFieldReg">Місто<sup>*</sup></span></td>                            <td><input type="text" id="Adress" name="AdressForm" onkeyup="Validation(5) " required></td>                            <td><img class="posANDsize" id="AdressIMG" ></td>                        </tr>                        <tr>                            <td><span class="nameFieldReg">Телефон<sup>*</sup></span></td>                            <td><span id="PhoneStyle"><img src="Images/ukraine.png" alt="Україна" id="FlagUkr" ><input id="Phone" name="PhoneForm" type="text" value="+380" maxlength="13" minlength="13" onkeyup="Validation(6)" required></span></td>                            <td><img class="posANDsize" id="PhoneIMG" ></td>                        </tr>                        <tr>                            <td><span class="nameFieldReg">№ паспорта та серія</span></td>                            <td><input type="text" id="PassportNum" class="StyleInputReg" name="PassportNumForm" onkeyup="Validation(7)" required></td>                            <td><img class="posANDsize" id="PassportNumIMG" ></td>                        </tr>                        <tr>                            <td style="display: flex;"><span class="nameFieldReg">E-mail<sup>*</sup></span>                                <div class="ContainerToolip HelpButtonEmail">                                    <img src="Images/information.png" class="ButtonStyle"><span class="ToolipText">Підтримуються всі <span style="color: lightgreen;">E-mail</span>, крім <span style="color: orange;">@</span>Mail<span style="color:orange">.ru</span> та <span style="color: darkred; font-size: 20px;">Я</span>ндекс.</span>                                </div>                            </td>                            <td><input type="text" id="LoginR" name="LoginRForm" class="StyleInputReg" onkeyup="Validation(8)" required></td>                            <td><img class="posANDsize" id="LoginRIMG"></td>                        </tr>                        <tr>                            <td style="display: flex;"><span class="nameFieldReg">Пароль<sup>*</sup></span>                                                                <div class="HelpButtonPassword">                                                                        <img src="Images/information.png" class="ButtonStyle ButtonStyleSecond">                                                                        <span class="ToolipTextPassword"><span style="color: #0D79B8; font-size: 18px;">Правила складання паролю</span><br>                                        пароль має містити латинські букви малого і великого реєстру, та цифри.<br>                                                                                <img src="Images/down-round-arrow.png" style="width: 25px; padding-top: 10px; padding-bottom: 10px;">                                                                                <div>                                                                                        <div class="ContainerForHelpHardPassword"><img class="HelpHardPassword" src="Images/0.png" > пароль містить меньше 5 символів (такий пароль є неприпустимим)</div>                                            <hr>                                            <div class="ContainerForHelpHardPassword"><img class="HelpHardPassword" src="Images/1.png" > символи паролю містять максимум 2 особливості, довжина є більшою за 4 символи</div>                                            <hr>                                            <div class="ContainerForHelpHardPassword"><img class="HelpHardPassword" src="Images/2.png" > символи паролю містять 3 особливості, довжина є більшою за 4 та мешною за 9 символів</div>                                            <hr>                                            <div class="ContainerForHelpHardPassword"><img class="HelpHardPassword" src="Images/3.png" > символи паролю містять 3 особливості, довжина не менше 9 символів</div>                                                                                    </div>                                                                                </span>                                </div>                                                            </td>                                                        <td><input type="password" id="PasswordR" class="StyleInputReg" onkeyup="Validation(9); Validation(10)" required></td>                            <td><img class="posANDsize" id="PasswordRIMG"></td>                        </tr>                        <tr>                            <td><span class="nameFieldReg">Перевірка паролю<sup>*</sup></span></td>                            <td><input type="password" id="PasswordRT" class="StyleInputReg" name="PasswordRTForm" onkeyup="Validation(10)" required disabled="true"></td>                            <td><img class="posANDsize" id="PasswordRTIMG"></td>                        </tr>                    </table>                                        <div style="display: flex; justify-content: center; font-family: 'Kosugi', sans-serif; "><span id="ErrorRegIn" Style="color: darkred; font-size: 15px; text-align: center; position: absolute; display: flex; justify-self: center; margin-top: 3px;"></span></div>                    <hr style="background-color: black; border: none; height: 2px; margin-top: 20px;">                    <div class="containerFields">                                                <a id="help">Допомога</a>                                                <input type="submit" value="зареєструватися" class="RegButton"  id="ButSendForm" name="RegistrationButton">                    </div>                                    </div>                            </form>        </div>            </div>        <form method="POST" id="CheckEM" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="application/x-www-form-urlencoded">                <img id='closeSMW' src="Images/exit.png"/>        <p id="CheckEMHeadText">Залишилося зовсім трошечки...</p>        <p id="CheckEMMainText">Для того, щоб забезпечити стабільну роботу поштового сайту,            ми перевіряємо E-mail нових клієнтів на валідність.            Це допомагає як клієнтам, так і працівникам.        </p>        <p id="CheckEMCare">З турботою про Вас!</p>                <span id="ErrorCheck">невірний код</span>                <input type="button" value="ВІДПРАВИТИ ЩЕ РАЗ" onclick="">                <div>                        <span>Код з E-mail: </span>                        <input id="CheckCodeEmailIput" type="text" name="CodeValue">            <input type="submit" value="SEND"  name="ButToSend">        </div>            </form>            <div id="FinalWindow">                <p class="CommonTextAfterRegistration">Дякуємо Вам за ваш вибір!</p>        <p class="CommonTextAfterRegistration"><span style="font-weight: bold">Вас успішно зареєстровано в системі</span></br>для авторизації введіть свій логін (E-mail) та пароль у форму cрава і натисніть кнопку "ВХІД"</p>                <p class="SpecialTextAfterRegistration">З думкою про Вас</p>        <p class="SpecialTextAfterRegistration WPO">НАША ПОШТА</p>        <a id="EndRegisterButton" onclick="document.getElementById('FinalWindow').style.display = 'none'; $('.topLogReg').toggleClass('topLogRegHIDE');" ><img src="Images/paper-plane.png"></a>            </div>    <div>    </div></main><footer></footer><script>    var SecondMW = document.getElementById('CheckEM');    var CloseMS = document.getElementById('closeSMW');    var Profile = document.getElementsByClassName('profile')[0];    var ErrorCheck = document.getElementById('ErrorCheck');    var InputCodeVar = document.getElementById('CheckCodeEmailIput');    var FinalWindow = document.getElementById('FinalWindow');        CloseMS.onclick = function () { SecondMW.style.display = "none"; };    Profile.onclick = function () { SecondMW.style.display = "none"; FinalWindow.style.display = "none"; };        // Error computation for E-mail code.        if ( 1 === <?php echo $RightOrNOT; ?> ) {        SecondMW.style.display = "none";        ErrorCheck.style.display = "none";        FinalWindow.style.display = "flex";    } else if ( 2 === <?php echo $RightOrNOT; ?> ) {        SecondMW.style.display = "block";        ErrorCheck.style.display = "block";        InputCodeVar.value = "";    }    </script><script src="AnimScript.js"></script><script>        jQuery(document).ready(function($) {        $('.profile').click(function Hide() {            $('.topLogReg').toggleClass('topLogRegHIDE');            document.getElementById('loginArea').value = "";            document.getElementById('passwordArea').value = "";        });    });        var ElementErrorLP = document.getElementById('ErrorLogIn');    var ElementErrorRF = document.getElementById('ErrorRegIn');    ElementErrorRF.textContent = " ";// Error handler for login window.     if ( <?php echo $ErrorLogIn; ?> === 0 ) {       ElementErrorLP.textContent=" ";    } else if ( <?php echo $ErrorLogIn; ?> === 1 ) {        ElementErrorLP.textContent='Невірний ЛОГІН або ПАРОЛЬ';        $('.topLogReg').toggleClass('topLogRegHIDE');    } else {        ElementErrorLP.textContent='Заповніть всі поля';        $('.topLogReg').toggleClass('topLogRegHIDE');    }// Error handler for registration window.    if ( 1 === <?php echo $ErrorRegIn; ?> ) {        modal.style.display = "flex";        ElementErrorRF.textContent = "Користвач з таким E-MAIL вже зареєстрований";        SecondName.value = "<?php echo $ArrayWithValuesForReg[0]; ?>";        FirstName.value = "<?php echo $ArrayWithValuesForReg[1]; ?>";        Patronymic.value = "<?php echo $ArrayWithValuesForReg[2]; ?>";        DateOfBirth.value = "<?php echo $ArrayWithValuesForReg[3]; ?>";        Adress.value = "<?php echo $ArrayWithValuesForReg[4]; ?>";        Phone.value = "<?php echo $ArrayWithValuesForReg[5]; ?>";        PassportNum.value = "<?php echo $ArrayWithValuesForReg[6]; ?>";        Login.value = "<?php echo $ArrayWithValuesForReg[7]; ?>";        CheckFieldsAfterPHP();    } else if ( 2 === <?php echo $ErrorRegIn; ?> ) {        SecondMW.style.display = "block";        InputCodeVar.value = "";    }// Function for validating fields of the registration form.    function CheckFieldsAfterPHP() {        for (var i = 1; i < 11; i++) {            Validation(i);        }    }</script></body></html>