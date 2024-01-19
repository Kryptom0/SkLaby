<?php
/*
Funkcja PokazPodstrone przyjmuje identyfikator strony jako argument, wykonuje zapytanie do
bazy danych MySQLw celu pobrania zawartości strony o podanym identyfikatorze, a następnie
zabezpiecza otrzymane dane przed atakami XSS. Jeśli strona o danym identyfikatorze istnieje
i jej status wynosi 1,funkcja zwraca jej zawartość; w przeciwnym razie zwraca
komunikat '[nie_znaleziono_strony]'.
*/
function PokazPodstrone($id)
{
    $id_clear = htmlspecialchars($id);
    $mysqli = new mysqli("localhost", "root", "", "moja_strona");
    $query = "SELECT * FROM page_list WHERE id='$id_clear' and status=1 LIMIT 1";
    $result = mysqli_query($mysqli, $query);
    $row = mysqli_fetch_array($result);
    if (empty($row['id'])) {
        $web = '[nie_znaleziono_strony]';
    } else {
        $web = $row['page_content'];
    }
    return $web;
}

?>