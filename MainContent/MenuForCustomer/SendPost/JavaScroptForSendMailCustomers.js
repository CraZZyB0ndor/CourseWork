DetermineSelectIndex();


function DetermineSelectIndex() {

    var indexSelected = document.getElementById('SelectChoose').selectedIndex,
        option = document.getElementById('SelectChoose').querySelectorAll('option')[indexSelected];

    var selectedId = option.getAttribute('id');

    var WriteTo = document.getElementById('HeaderForTextForChooseType');

    switch (selectedId) {

        case '1L':

            WriteTo.textContent = 'ЛИСТ';
            break;

        case '2B':

            WriteTo.textContent = 'ПОСИЛКА';
            break;

        case '3C':

            WriteTo.textContent = 'ГРОЩІ';
            break;
    }

}

