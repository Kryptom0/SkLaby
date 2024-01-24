<?php
//Ustawienia dostepu do bazy danych
$dbhost = '';
$dbuser = 'root';
$dbpass = '';
$baza = 'moja_strona';
$login = 'user';
$pass = 'haselko';

//Nawiazanie polaczenia z baza danych
$link = mysqli_connect($dbhost, $dbuser, $dbpass);
if (!$link) echo '<b>Połączenie zostało przerwane.</b>';
if (!mysqli_select_db($link, $baza)) echo 'Nie wybrano bazy';
?>