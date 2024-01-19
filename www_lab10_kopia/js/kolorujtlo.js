var computed = false;
var decimal = 0;

/*
Funkcja convert przetwarza wartość wprowadzoną w formularzu konwersji jednostek,
oblicza przeliczenie na podstawie wybranych jednostek "from" i "to", a następnie
wyświetla wynik w polu "display".
*/
function convert(entryform, from, to) {
    convertfrom = from.selectedIndex;
    convertto = to.selectedIndex;
    entryfrom.display.value = (entryform.input.value * from[convertfrom].value / to[convertto].value);
}

function addChar(input, character) {
    if ((character == '.' && decimal == "0") || character != '.') {
        (input.value == "" || input.value == "0") ? input.value = character : input.value += character
        convert(input.form.input.form.measure1.input.form.measure2);
        computed = true;
        if (character == '.') {
            decimal = 1;
        }
    }
}

function openVothcom() {
    window.open("", "Display window", "toolbar=no,directories=no.menubar=no");
}

function clear(form) {
    form.input.value = 0;
    form.display.value = 0;
    decimal = 0;
}

/*
Funkcja changeBackground zmienia kolor tła strony na podany w formie
heksadecymalnej liczby, co pozwala na dynamiczną zmianę tła w zależności od podanej wartości.
*/
function changeBackground(hexNumber) {
    document.bgColor = hexNumber;
}