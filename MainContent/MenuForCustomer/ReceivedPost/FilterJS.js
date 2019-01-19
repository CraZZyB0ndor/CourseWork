function DetermineNowDate() {

    var getNowDate = new Date();

    var getMonthVar = getNowDate.getMonth.length < 2 ? 0 + (parseInt(getNowDate.getMonth()) + 1).toString() : (parseInt(getNowDate.getMonth()) + 1).toString();

    var strNowDate = getNowDate.getFullYear() + '-' + getMonthVar + '-' + getNowDate.getDate() + 'T' + getNowDate.getHours() + ':' + getNowDate.getMinutes();

    return strNowDate;

}

function ValidationFromDate() {

    var inputFromDate = document.getElementById('FromDate').value.toString();

    var NowDate = DetermineNowDate();

    if (inputFromDate <= NowDate && inputFromDate.length !== 0 ) {

        if (ValidationToDate()) {

            document.getElementById('DateError').style.display = 'none';
            document.getElementById('FilterButton').style.display = 'flex';

            return true;
        }

    } else {

        document.getElementById('FilterButton').style.display = 'none';
        document.getElementById('DateError').style.display = 'flex';

        return false;

    }

}

function ValidationToDate() {

    var NowDate = DetermineNowDate();

    if (document.getElementById('ToDate').value.toString() >= document.getElementById('FromDate').value.toString() &&
        document.getElementById('ToDate').value.toString() <= NowDate && document.getElementById('ToDate').value.toString().length !== 0) {

        return true;


    } else {

        document.getElementById('FilterButton').style.display = 'none';
        document.getElementById('DateError').style.display = 'flex';

        return false;

    }
}

function SelectTab() {

    var indexSelected = document.getElementById('TimeSendID').selectedIndex,
        option = document.getElementById('TimeSendID').querySelectorAll('option')[indexSelected];

    var selectedId = option.getAttribute('id');

    switch (selectedId) {

        case 'AllTime':

            document.getElementById('DateBetween').style.display = 'none';
            document.getElementsByClassName('FilterMenu')[0].style.height = '173px';
            document.getElementById('DateError').style.display = 'none';
            document.getElementById('FilterButton').style.display = 'flex';

            break;
        case 'CertainTime':

            document.getElementById('FilterButton').style.display = 'none';
            document.getElementById('DateError').style.display = 'flex';
            document.getElementsByClassName('FilterMenu')[0].style.height = '253px';
            document.getElementById('DateBetween').style.display = 'flex';

            ValidationFromDate();

            break;
    }
}

function TrueOpenWindow(action) {

    var classListSort = document.getElementById('SortMenuID').className.split(/\s+/);
    var classListFilter = document.getElementById('FilterCheckerClass').className.split(/\s+/);

    if (action === 'Sort') {

        for (var i = 0; i < classListFilter.length; i++) {

            if (classListFilter[i] === 'FilterMenuDisplay') {

                $('.FilterMenu').toggleClass('FilterMenuDisplay');
                $('.SortMenu').toggleClass('SortMenuDisplay');

                return;

            } else {

                continue;
            }
        }

        $('.SortMenu').toggleClass('SortMenuDisplay');

        return;

    }

    if  (action === 'Filter') {

        for (var i = 0; i < classListSort.length; i++) {

            if (classListSort[i] === 'SortMenuDisplay') {

                $('.SortMenu').toggleClass('SortMenuDisplay');
                $('.FilterMenu').toggleClass('FilterMenuDisplay');

                return;

            } else {

                continue;
            }
        }


        $('.FilterMenu').toggleClass('FilterMenuDisplay');

        return;
    }

}