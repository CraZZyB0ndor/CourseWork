DetermineSelectIndex();



function DetermineSelectIndex() {

    var letter = document.getElementsByClassName('ForLetter')[0];
    var money = document.getElementsByClassName('ForCash')[0];
    var box = document.getElementsByClassName('ForBox')[0];

    var indexSelected = document.getElementById('SelectChoose').selectedIndex,
        option = document.getElementById('SelectChoose').querySelectorAll('option')[indexSelected];

    var selectedId = option.getAttribute('id');


    switch (selectedId) {

        case '1L':

            letter.style.display = "flex";
            money.style.display = "none";
            box.style.display = "none";
            break;

        case '2B':

            letter.style.display = "none";
            money.style.display = "none";
            box.style.display = "flex";
            break;

        case '3C':

            letter.style.display = "none";
            money.style.display = "flex";
            box.style.display = "none";
            break;
    }

}



