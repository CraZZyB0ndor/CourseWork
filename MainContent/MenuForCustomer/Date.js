

// Date for display day, number day, month and year.

var DayMonthYear = document.getElementById('DayYearMonth');

var currentData = new Date();
var day = ["Неділя", "Понеділок", "Вівторок", "Середа", "Четверг", "П'ятниця", "Субота"];
var month = ["Січня", "Лютого", "Березня", "Квітня", "Травня", "Червня", "Липня", "Серпня", "Вересня", "Жовтня", "Листопада", "Грудня"];

DayMonthYear.textContent = day[currentData.getDay()] + " " + currentData.getDate()
    + " " + month[currentData.getMonth()] + " " + currentData.getFullYear() + " p.";


// Date for display time.

function startTime()
{
    var time = document.getElementById('ClockTime');

    var currentData = new Date();

    var h = currentData.getHours();
    var m = currentData.getMinutes();
    var s = currentData.getSeconds();

    m =checkTime(m);
    s =checkTime(s);

    time.innerHTML = h + ":" + m + ":" + s;

    t = setTimeout('startTime()',500);
}


function checkTime(i)
{

    if ( i < 10)
    {
        i="0" + i;
    }

    return i;

}

