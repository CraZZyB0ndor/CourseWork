
var backgroundMenu = document.getElementById('backgroundForModalWindow');
var buttonDeletInputContent = document.getElementsByClassName('DeleteContentImage');

function EditMenu(row) {

    var determineEditRow = document.getElementById('NameOfEditRow');
    
    switch (row) {

        case 'Surname':

            backgroundMenu.style.display = 'flex';
            document.getElementById('SurnameStyleID').style.position = 'absolute';
            document.getElementById('EditSurnameIMG').style.display = 'none';
            document.getElementsByClassName('UserDataFromPHP')[0].style.display = 'none';
            document.getElementById('SurnameID').style.display = 'block';

            document.getElementById('SurnameID').value =  document.getElementsByClassName('UserDataFromPHP')[0].textContent;

            determineEditRow.textContent = 'Surname';

            buttonDeletInputContent[0].style.display = 'block';

            document.getElementsByClassName('SwitchChange')[0].style.display = 'none';

            break;

        case 'Name':

            backgroundMenu.style.display = 'flex';
            document.getElementById('NameStyleID').style.position = 'absolute';

            document.getElementById('NameStyleID').style.top = '290px';
            document.getElementById('NameStyleID').style.left = '660px';

            document.getElementById('EditNameIMG').style.display = 'none';
            document.getElementsByClassName('UserDataFromPHP')[1].style.display = 'none';
            document.getElementById('NameID').style.display = 'block';

            document.getElementById('NameID').value =  document.getElementsByClassName('UserDataFromPHP')[1].textContent;

            determineEditRow.textContent = 'Name';

            buttonDeletInputContent[1].style.display = 'block';

            document.getElementsByClassName('SwitchChange')[1].style.display = 'none';

            break;

        case 'Patronymic':

            backgroundMenu.style.display = 'flex';
            document.getElementById('PatronymicStyleID').style.position = 'absolute';

            document.getElementById('PatronymicStyleID').style.top = '290px';
            document.getElementById('PatronymicStyleID').style.left = '600px';

            document.getElementById('EditPatronymicIMG').style.display = 'none';
            document.getElementsByClassName('UserDataFromPHP')[2].style.display = 'none';
            document.getElementById('PatronymicID').style.display = 'block';

            document.getElementById('PatronymicID').value =  document.getElementsByClassName('UserDataFromPHP')[2].textContent;

            determineEditRow.textContent = 'Patronymic';

            buttonDeletInputContent[2].style.display = 'block';

            document.getElementsByClassName('SwitchChange')[2].style.display = 'none';

            break;

        case 'Date':

            backgroundMenu.style.display = 'flex';
            document.getElementById('DateStyleID').style.position = 'absolute';

            document.getElementById('DateStyleID').style.top = '290px';
            document.getElementById('DateStyleID').style.left = '600px';

            document.getElementById('EditDateIMG').style.display = 'none';
            document.getElementsByClassName('UserDataFromPHP')[3].style.display = 'none';
            document.getElementById('DateID').style.display = 'block';

            document.getElementById('DateID').value =  document.getElementsByClassName('UserDataFromPHP')[3].textContent;

            determineEditRow.textContent = 'Date';

            document.getElementsByClassName('SwitchChange')[3].style.display = 'none';


            break;

        case 'Address':

            backgroundMenu.style.display = 'flex';
            document.getElementById('AddressStyleID').style.position = 'absolute';

            document.getElementById('AddressStyleID').style.top = '290px';
            document.getElementById('AddressStyleID').style.left = '650px';

            document.getElementById('EditAddressIMG').style.display = 'none';
            document.getElementsByClassName('UserDataFromPHP')[4].style.display = 'none';
            document.getElementById('AddressID').style.display = 'block';

            document.getElementById('AddressID').value =  document.getElementsByClassName('UserDataFromPHP')[4].textContent;

            determineEditRow.textContent = 'Address';

            buttonDeletInputContent[3].style.display = 'block';

            document.getElementsByClassName('SwitchChange')[4].style.display = 'none';

            break;

        case 'Phone':

            backgroundMenu.style.display = 'flex';
            document.getElementById('PhoneStyleID').style.position = 'absolute';

            document.getElementById('PhoneStyleID').style.top = '290px';
            document.getElementById('PhoneStyleID').style.left = '640px';

            document.getElementById('EditPhoneIMG').style.display = 'none';
            document.getElementsByClassName('UserDataFromPHP')[5].style.display = 'none';
            document.getElementById('PhoneID').style.display = 'block';

            document.getElementById('PhoneID').value =  document.getElementsByClassName('UserDataFromPHP')[5].textContent;

            determineEditRow.textContent = 'Phone';

            buttonDeletInputContent[4].style.display = 'block';

            document.getElementsByClassName('SwitchChange')[5].style.display = 'none';

            break;

        case 'Email':

            backgroundMenu.style.display = 'flex';
            document.getElementById('EmailStyleID').style.position = 'absolute';

            document.getElementById('EmailStyleID').style.top = '290px';
            document.getElementById('EmailStyleID').style.left = '610px';
            document.getElementById('EmailID').style.width = '250px';

            document.getElementById('EditEmailIMG').style.display = 'none';
            document.getElementsByClassName('UserDataFromPHP')[6].style.display = 'none';
            document.getElementById('EmailID').style.display = 'block';

            document.getElementById('EmailID').value =  document.getElementsByClassName('UserDataFromPHP')[6].textContent;

            determineEditRow.textContent = 'Email';

            buttonDeletInputContent[5].style.display = 'block';

            document.getElementsByClassName('SwitchChange')[6].style.display = 'none';

            break;
    }

}


function CheckEnterData(nameInput) {

    switch (nameInput) {

        case 'Surname':

            FieldFST(document.getElementById('SurnameID'), document.getElementById('TFSurnameIMG'), document.getElementById('ConfirmChanges'));

            break;

        case 'Name':

            FieldFST(document.getElementById('NameID'), document.getElementById('TFNameIMG'), document.getElementById('ConfirmChanges'));

            break;

        case 'Patronymic':

            FieldFST(document.getElementById('PatronymicID'), document.getElementById('TFPatronymicIMG'), document.getElementById('ConfirmChanges'));

            break;

        case 'Date':

            Field4(document.getElementById('DateID'), document.getElementById('TFDateIMG'), document.getElementById('ConfirmChanges'));

            break;

        case 'Address':

            Field5(document.getElementById('AddressID'), document.getElementById('TFAddressIMG'), document.getElementById('ConfirmChanges'));

            break;

        case 'Phone':

            Field6(document.getElementById('PhoneID'), document.getElementById('TFPhoneIMG'), document.getElementById('ConfirmChanges'));

            break;

        case 'Email':

            Field8(document.getElementById('EmailID'), document.getElementById('TFEmailIMG'), document.getElementById('ConfirmChanges'));

            break;
    }

}

function FieldFST(Name, NameIMG, Button) {

    if ( /\s/.test(Name.value) || /[0-9]/.test(Name.value) || ((!/^[А-Яа-яіІєЄ]{2,5}'*[А-Яа-яіІєЄ]{2,15}$/.test(Name.value) || !/^[А-Яа-яіІєЄ]{2,20}'*/.test(Name.value) ) && Name.value.length !== 0) ){

        NameIMG.src = "Images/cancel%20(1).png";
        NameIMG.style.opacity = "1";
        Button.style.visibility = 'hidden';

    } else if ( Name.value.length >= 4 ) {

        NameIMG.src = "Images/checked%20(1).png";
        NameIMG.style.opacity = "1";
        Button.style.visibility = 'visible';
    } else {

        NameIMG.style.opacity = "0";
        Button.style.visibility = 'hidden';
    }

}

function Field4(DateOfBirth, NameIMG, Button) {

    var nowDate = new Date();

    if ( nowDate.getFullYear() - DateOfBirth.value.substr(0, 4) <= 120 && nowDate.getFullYear() - DateOfBirth.value.substr(0, 4) >= 8) {

        NameIMG.src = "Images/checked%20(1).png";
        NameIMG.style.opacity = "1";
        Button.style.visibility = 'visible';

    } else {

        NameIMG.src = "Images/cancel%20(1).png";
        NameIMG.style.opacity = "1";
        Button.style.visibility = 'hidden';

    }

}

function Field5(Address, NameIMG, Button) {

    var pattern = /^[а-яА-ЯіІєЄ]{2,20}\s*[а-яА-ЯіІєЄ]{0,5}$/;

    if ( pattern.test(Address.value)) {

        NameIMG.src = "Images/checked%20(1).png";
        NameIMG.style.opacity = "1";
        Button.style.visibility = 'visible';

    } else if (Address.value.length === 0) {

        NameIMG.style.opacity = "0";
        Button.style.visibility = 'hidden';

    } else {

        NameIMG.src = "Images/cancel%20(1).png";
        NameIMG.style.opacity = "1";
        Button.style.visibility = 'hidden';

    }
}

function Field6(Phone, NameIMG, Button) {

    var pattern = /^\+380\d{3}\d{2}\d{2}\d{2}$/;

    if (pattern.test(Phone.value) ) {

        NameIMG.src = "Images/checked%20(1).png";
        NameIMG.style.opacity = "1";
        Button.style.visibility = 'visible';

    } else if ( /^\+380$/.test(Phone.value) ) {

        NameIMG.style.opacity = "0";
        Button.style.visibility = 'hidden';

    } else {

        NameIMG.src = "Images/cancel%20(1).png";
        NameIMG.style.opacity = "1";
        Button.style.visibility = 'hidden';
    }

}

// Password checker.

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

function Field8(Login, NameIMG, Button) {

    var pattern  = /^(([^<>()\[\]\.,;:\s@\"]+(\.[^<>()\[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;

    if (pattern.test(Login.value)) {

        NameIMG.src = "Images/checked%20(1).png";
        NameIMG.style.opacity = "1";
        Button.style.visibility = 'visible';

    } else if (Login.value.length === 0) {

        NameIMG.style.opacity = "0";
        Button.style.visibility = 'hidden';

    } else {

        NameIMG.src = "Images/cancel%20(1).png";
        NameIMG.style.opacity = "1";
        Button.style.visibility = 'hidden';

    }

}


//---


function CancelEdit() {

    switch (document.getElementById('NameOfEditRow').textContent) {

        case 'Surname':

            document.getElementsByClassName('UserDataFromPHP')[0].style.display = 'table-cell';

            backgroundMenu.style.display = 'none';

            document.getElementById('SurnameStyleID').style.position = 'relative';
            document.getElementById('EditSurnameIMG').style.display = 'block';
            document.getElementById('SurnameID').style.display = 'none';
            document.getElementById('TFSurnameIMG').style.opacity = '0';

            document.getElementById('NameOfEditRow').textContent = '';

            buttonDeletInputContent[0].style.display = 'none';

            CheckOnChange('Surname', document.getElementsByClassName('UserDataFromPHP')[0].textContent);

            break;

        case 'Name':

            document.getElementsByClassName('UserDataFromPHP')[1].style.display = 'table-cell';

            backgroundMenu.style.display = 'none';

            document.getElementById('NameStyleID').style.position = 'relative';
            document.getElementById('EditNameIMG').style.display = 'block';
            document.getElementById('NameID').style.display = 'none';
            document.getElementById('TFNameIMG').style.opacity = '0';

            document.getElementById('NameOfEditRow').textContent = '';

            buttonDeletInputContent[1].style.display = 'none';

            CheckOnChange('Name', document.getElementsByClassName('UserDataFromPHP')[1].textContent);

            break;

        case 'Patronymic':

            document.getElementsByClassName('UserDataFromPHP')[2].style.display = 'table-cell';

            backgroundMenu.style.display = 'none';

            document.getElementById('PatronymicStyleID').style.position = 'relative';
            document.getElementById('EditPatronymicIMG').style.display = 'block';
            document.getElementById('PatronymicID').style.display = 'none';
            document.getElementById('TFPatronymicIMG').style.opacity = '0';

            document.getElementById('NameOfEditRow').textContent = '';

            buttonDeletInputContent[2].style.display = 'none';

            CheckOnChange('Patronymic', document.getElementsByClassName('UserDataFromPHP')[2].textContent);

            break;

        case 'Date':

            document.getElementsByClassName('UserDataFromPHP')[3].style.display = 'table-cell';

            backgroundMenu.style.display = 'none';

            document.getElementById('DateStyleID').style.position = 'relative';
            document.getElementById('EditDateIMG').style.display = 'block';
            document.getElementById('DateID').style.display = 'none';
            document.getElementById('TFDateIMG').style.opacity = '0';

            document.getElementById('NameOfEditRow').textContent = '';

            CheckOnChange('Date', document.getElementsByClassName('UserDataFromPHP')[3].textContent);

            break;

        case 'Address':

            document.getElementsByClassName('UserDataFromPHP')[4].style.display = 'table-cell';

            backgroundMenu.style.display = 'none';

            document.getElementById('AddressStyleID').style.position = 'relative';
            document.getElementById('EditAddressIMG').style.display = 'block';
            document.getElementById('AddressID').style.display = 'none';
            document.getElementById('TFAddressIMG').style.opacity = '0';

            document.getElementById('NameOfEditRow').textContent = '';

            buttonDeletInputContent[3].style.display = 'none';

            CheckOnChange('Address', document.getElementsByClassName('UserDataFromPHP')[4].textContent);

            break;

        case 'Phone':

            document.getElementsByClassName('UserDataFromPHP')[5].style.display = 'table-cell';

            backgroundMenu.style.display = 'none';

            document.getElementById('PhoneStyleID').style.position = 'relative';
            document.getElementById('EditPhoneIMG').style.display = 'block';
            document.getElementById('PhoneID').style.display = 'none';
            document.getElementById('TFPhoneIMG').style.opacity = '0';

            document.getElementById('NameOfEditRow').textContent = '';

            buttonDeletInputContent[4].style.display = 'none';

            CheckOnChange('Phone', document.getElementsByClassName('UserDataFromPHP')[5].textContent);

            break;

        case 'Email':

            document.getElementsByClassName('UserDataFromPHP')[6].style.display = 'table-cell';

            backgroundMenu.style.display = 'none';

            document.getElementById('EmailStyleID').style.position = 'relative';
            document.getElementById('EditEmailIMG').style.display = 'block';
            document.getElementById('EmailID').style.display = 'none';
            document.getElementById('TFEmailIMG').style.opacity = '0';

            document.getElementById('NameOfEditRow').textContent = '';

            buttonDeletInputContent[5].style.display = 'none';

            CheckOnChange('Email', document.getElementsByClassName('UserDataFromPHP')[6].textContent);

            break;
    }


}

function AcceptEdit() {

    switch (document.getElementById('NameOfEditRow').textContent) {

        case 'Surname':

            document.getElementsByClassName('UserDataFromPHP')[0].style.display = 'table-cell';

            document.getElementsByClassName('UserDataFromPHP')[0].textContent = document.getElementById('SurnameID').value;

            backgroundMenu.style.display = 'none';

            document.getElementById('SurnameStyleID').style.position = 'relative';
            document.getElementById('EditSurnameIMG').style.display = 'block';
            document.getElementById('SurnameID').style.display = 'none';
            document.getElementById('TFSurnameIMG').style.opacity = '0';

            buttonDeletInputContent[0].style.display = 'none';

            CheckOnChange('Surname', document.getElementsByClassName('UserDataFromPHP')[0].textContent);

            break;

        case 'Name':

            document.getElementsByClassName('UserDataFromPHP')[1].style.display = 'table-cell';

            document.getElementsByClassName('UserDataFromPHP')[1].textContent = document.getElementById('NameID').value;

            backgroundMenu.style.display = 'none';

            document.getElementById('NameStyleID').style.position = 'relative';
            document.getElementById('EditNameIMG').style.display = 'block';
            document.getElementById('NameID').style.display = 'none';
            document.getElementById('TFNameIMG').style.opacity = '0';

            buttonDeletInputContent[1].style.display = 'none';

            CheckOnChange('Name', document.getElementsByClassName('UserDataFromPHP')[1].textContent);

            break;

        case 'Patronymic':

            document.getElementsByClassName('UserDataFromPHP')[2].style.display = 'table-cell';

            document.getElementsByClassName('UserDataFromPHP')[2].textContent = document.getElementById('PatronymicID').value;

            backgroundMenu.style.display = 'none';

            document.getElementById('PatronymicStyleID').style.position = 'relative';
            document.getElementById('EditPatronymicIMG').style.display = 'block';
            document.getElementById('PatronymicID').style.display = 'none';
            document.getElementById('TFPatronymicIMG').style.opacity = '0';

            buttonDeletInputContent[2].style.display = 'none';

            CheckOnChange('Patronymic', document.getElementsByClassName('UserDataFromPHP')[2].textContent);

            break;

        case 'Date':

            document.getElementsByClassName('UserDataFromPHP')[3].style.display = 'table-cell';

            document.getElementsByClassName('UserDataFromPHP')[3].textContent = document.getElementById('DateID').value;

            backgroundMenu.style.display = 'none';

            document.getElementById('DateStyleID').style.position = 'relative';
            document.getElementById('EditDateIMG').style.display = 'block';
            document.getElementById('DateID').style.display = 'none';
            document.getElementById('TFDateIMG').style.opacity = '0';

            CheckOnChange('Date', document.getElementsByClassName('UserDataFromPHP')[3].textContent);

            break;

        case 'Address':

            document.getElementsByClassName('UserDataFromPHP')[4].style.display = 'table-cell';

            document.getElementsByClassName('UserDataFromPHP')[4].textContent = document.getElementById('AddressID').value;

            backgroundMenu.style.display = 'none';

            document.getElementById('AddressStyleID').style.position = 'relative';
            document.getElementById('EditAddressIMG').style.display = 'block';
            document.getElementById('AddressID').style.display = 'none';
            document.getElementById('TFAddressIMG').style.opacity = '0';

            buttonDeletInputContent[3].style.display = 'none';

            CheckOnChange('Address', document.getElementsByClassName('UserDataFromPHP')[4].textContent);

            break;

        case 'Phone':

            document.getElementsByClassName('UserDataFromPHP')[5].style.display = 'table-cell';

            document.getElementsByClassName('UserDataFromPHP')[5].textContent = document.getElementById('PhoneID').value;

            backgroundMenu.style.display = 'none';

            document.getElementById('PhoneStyleID').style.position = 'relative';
            document.getElementById('EditPhoneIMG').style.display = 'block';
            document.getElementById('PhoneID').style.display = 'none';
            document.getElementById('TFPhoneIMG').style.opacity = '0';

            buttonDeletInputContent[4].style.display = 'none';

            CheckOnChange('Phone', document.getElementsByClassName('UserDataFromPHP')[5].textContent);

            break;

        case 'Email':

            document.getElementsByClassName('UserDataFromPHP')[6].style.display = 'table-cell';

            document.getElementsByClassName('UserDataFromPHP')[6].textContent = document.getElementById('EmailID').value;

            backgroundMenu.style.display = 'none';

            document.getElementById('EmailStyleID').style.position = 'relative';
            document.getElementById('EditEmailIMG').style.display = 'block';
            document.getElementById('EmailID').style.display = 'none';
            document.getElementById('TFEmailIMG').style.opacity = '0';

            buttonDeletInputContent[5].style.display = 'none';

            CheckOnChange('Email', document.getElementsByClassName('UserDataFromPHP')[6].textContent);

            break;
    }

}