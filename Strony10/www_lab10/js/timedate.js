/*
Funkcja gettheDate pobiera aktualną datę i formatuje ją w postaci miesiąc/dzień/rok,
a następnie wyświetla w elemencie HTML o identyfikatorze "data".
*/
function gettheDate() {
    Todays = new Date();
    TheDate = "" + (Todays.getMonth() + 1) + "/" + Todays.getDate() + " /" + (Todays.getYear() - 100);
    document.getElementById("data").innerHTML = TheDate;
}

var timerID = null;
var timerRunning = false;

/*
Funkcja stopclock zatrzymuje działanie zegara poprzez czyszczenie
identyfikatora czasomierza, jeśli ten był uruchomiony.
*/
function stopclock() {
    if (timerRunning)
        clearTimeout(timerID);
    timerRunning = false;
}

/*
Funkcja startclock zatrzymuje obecny zegar, pobiera aktualną datę za pomocą funkcji
gettheDate(), a następnie uruchamia funkcję showtime() do wyświetlania aktualnego czasu.
*/
function startclock() {
    stopclock();
    gettheDate();
    showTime();
}

/*
Funkcja showtime pobiera aktualny czas i formatuje go w postaci godziny:minuty:sekundy AM/PM,
a następnie wyświetla w elemencie HTML o identyfikatorze "zegarek". Funkcja jest
wywoływana co sekundę za pomocą setTimeout.
*/
function showtime() {
    var now = new Date();
    var hours = now.getHours();
    var minutes = now.getMinutes();
    var seconds = now.getSeconds();
    var timevalue = "" + ((hours > 12) ? hours - 12 : hours)
    timevalue += ((minutes < 10) ? ":0" : ":") + minutes
    timevalue += ((seconds < 10) ? ":0" : ":") + seconds
    timevalue += (hours >= 12) ? "P.M." : "A.M."
    document.getElementById("zegarek").innerHTML = timevalue;
    timerID = setTimeout("showtime()", 1000);
    timerRunning = true;
}