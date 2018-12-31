DetermineSelectIndex();


function DetermineSelectIndex() {

    var indexSelected = document.getElementById('SelectChoose').selectedIndex,
        option = document.getElementById('SelectChoose').querySelectorAll('option')[indexSelected];

    var selectedId = option.getAttribute('id');


    switch (selectedId) {

        case '1L':


            break;

        case '2B':


            break;

        case '3C':


            break;
    }

}



