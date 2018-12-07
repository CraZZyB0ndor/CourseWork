// Variables for displaying reg window.

var modal = document.getElementById('modalWindow');
var btn = document.getElementById('registerBut');
var span = document.getElementsByClassName('close')[0];
var mainWindow = document.getElementsByName('main');
var LogInWindow = document.getElementsByClassName('topLogReg');

// Functions for displaying reg window.

btn.onclick = function () { modal.style.display = "flex"; };
span.onclick = function () { modal.style.display = "none"; ClearFields(); ElementErrorRF.textContent = " "; };
window.onclick = function (event) { if (event.target === modal) { modal.style.display = "none"; ClearFields(); ElementErrorRF.textContent = " "; } };



// Variables for validating registry form.

var SecondName = document.getElementById('SecondName');
var SecondNameIMG = document.getElementById('SecondNameIMG');
var FirstName = document.getElementById('FirstName');
var FirstNameIMG = document.getElementById('FirstNameIMG');
var Patronymic = document.getElementById('Patronymic');
var PatronymicIMG = document.getElementById('PatronymicIMG');
var DateOfBirth = document.getElementById('DateOFBirth');
var DateOfBirthIMG = document.getElementById('DateOFBirthIMG');

var Adress = document.getElementById('Adress');
var AdressIMG = document.getElementById('AdressIMG');

var Phone = document.getElementById('Phone');
var PhoneIMG = document.getElementById('PhoneIMG');
var PassportNum = document.getElementById('PassportNum');
var PassportNumIMG = document.getElementById('PassportNumIMG');
var Login = document.getElementById('LoginR');
var LoginIMG = document.getElementById('LoginRIMG');
var Password = document.getElementById('PasswordR');
var PasswordIMG = document.getElementById('PasswordRIMG');
var PasswordR = document.getElementById('PasswordRT');
var PasswordRIMG = document.getElementById('PasswordRTIMG');

var ButtonForSendingForm = document.getElementById('ButSendForm');


function Validation(numField) {

    switch (numField) {

        case 1:
            FieldFST(SecondName, SecondNameIMG);
            break;
        case 2:
            FieldFST(FirstName, FirstNameIMG);
            break;
        case 3:
            FieldFST(Patronymic, PatronymicIMG);
            break;
        case 4:
            Field4();
            break;
        case 5:
            Field5();
            break;
        case 6:
            Field6();
            break;
        case 7:
            Field7();
            break;
        case 8:
            Field8();
            break;
        case 9:
            if (Field9()) {
                PasswordR.disabled = false;
                PasswordR.value = "";
            } else {
                PasswordR.disabled = true;
                PasswordR.value = "";
            }
            break;
        case 10:
            Field10();
            break;


    }

    CheckFields();

    function FieldFST(Name, NameIMG) {

        if ( /\s/.test(Name.value) || /[0-9]/.test(Name.value) || ((!/^[А-Яа-яіІєЄ]{2,5}'*[А-Яа-яіІєЄ]{2,15}$/.test(Name.value) || !/^[А-Яа-яіІєЄ]{2,20}'*/.test(Name.value) ) && Name.value.length !== 0) ){
            NameIMG.src = "Images/cancel%20(1).png";
        } else if ( Name.value.length >= 4 ) {
            NameIMG.src = "Images/checked%20(1).png";
        } else {
            NameIMG.src = "";
        }

    }

    function Field4() {

        var nowDate = new Date();

        if ( nowDate.getFullYear() - DateOfBirth.value.substr(0, 4) <= 120 && nowDate.getFullYear() - DateOfBirth.value.substr(0, 4) >= 8) {
            DateOfBirthIMG.src = "Images/checked (1).png";
        } else {  DateOfBirthIMG.src = "Images/cancel (1).png";  }

    }

    function Field5() {

        var pattern = /^[а-яА-ЯіІєЄ]{2,20}\s*[а-яА-ЯіІєЄ]{0,5}$/;

        if ( pattern.test(Adress.value)) {
            AdressIMG.src = "Images/checked (1).png";
        } else if (Adress.value.length === 0) {
            AdressIMG.src = "";
        } else {
            AdressIMG.src = "Images/cancel (1).png";
        }
    }

    function Field6() {

        var pattern = /^\+380\d{3}\d{2}\d{2}\d{2}$/;

        if (pattern.test(Phone.value) ) {
            PhoneIMG.src = "Images/checked (1).png";
        } else if ( /^\+380$/.test(Phone.value) ) {
            PhoneIMG.src = "";
        } else {
            PhoneIMG.src = "Images/cancel (1).png";
        }

    }

    function Field7() {

        var pattern = /^[A-ZА-ЯІ]{2}\d{6}$/;

        if (pattern.test(PassportNum.value)) {
            PassportNumIMG.src = "Images/checked (1).png";
        } else if ( PassportNum.value.length === 0 ) {
            PassportNumIMG.src = "";
        } else {
            PassportNumIMG.src = "Images/cancel (1).png";
        }
    }

    function Field8() {

        var pattern  = /^(([^<>()\[\]\.,;:\s@\"]+(\.[^<>()\[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;

        if (pattern.test(Login.value)) {
            LoginIMG.src = "Images/checked (1).png";
        } else if (Login.value.length === 0) {
            LoginIMG.src = "";
        } else {
            LoginIMG.src = "Images/cancel (1).png";
        }

    }

    function Field9() {

        var arrayPasssChars = Password.value;
        var Uppercasechars = 0;
        var LowCaseChars = 0;
        var Numbers = 0;
        var Repeated = 0;
        var result;

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

                PasswordIMG.src = "";
                return false;

            } else {
                PasswordIMG.src = "Images/0.png";
                return false;
            }


        } else if (result === 1) {

            if (Password.value.length === 0) {

                PasswordIMG.src = "";
                return false;

            } else if (Password.value.length <= 4) {

                PasswordIMG.src = "Images/0.png";
                return false;

            } else {

                PasswordIMG.src = "Images/1.png";
                return true;
            }

        } else if (result === 2) {

            if (Password.value.length <= 6) {

                PasswordIMG.src = "Images/1.png";
                return true;

            } else if (Password.value.length <= 8) {

                PasswordIMG.src = "Images/2.png";
                return true;

            } else { PasswordIMG.src = "Images/3.png"; return true; }

        }

    }

    function Field10() {

        if (PasswordR.value.length === 0) {

            PasswordRIMG.src = "";

        } else if (Password.value === PasswordR.value) {

            PasswordRIMG.src = "Images/checked (1).png";

        } else { PasswordRIMG.src = "Images/cancel (1).png"; }

    }
}

function ClearFields() {

    SecondName.value = "";
    FirstName.value = "";
    Patronymic.value = "";
    DateOfBirth.value = "2000-02-15";
    Adress.value = "";
    Phone.value = "+380";
    PassportNum.value = "";
    Login.value = "";
    Password.value = "";
    PasswordR.value = "";

    for (var i = 1; i < 11; i++) {
        Validation(i);
    }

}

function CheckFields() {

    var arrayIMG = [SecondNameIMG, FirstNameIMG, PatronymicIMG, DateOfBirthIMG, AdressIMG, PhoneIMG, PassportNumIMG, LoginIMG, PasswordRIMG];
    var count = 0;

    for (var i = 0; i < arrayIMG.length; i++) {
        if (/checked%20\(1\).png/.test(arrayIMG[i].src) ) {
            count++;
        } else {
            ButtonForSendingForm.style.display = 'none';
            return;
        }
    }

        ButtonForSendingForm.style.display = 'block';
}
