<?php
session_start(); //Start sesji
if (!isset($_SESSION['UserData']['Username'])) {
    header("location:login.php");
    exit;
} else {
    echo "Gratulacje, zostałeś zalogowany!<br /> <a href=logout.php>Kliknij tutaj</a> aby się wylogować. <br /> ";
    //Strony
    /*$mysqli = new mysqli("localhost", "root", "", "moja_strona");
    $query = "SELECT * FROM page_list";
    $result = mysqli_query($mysqli, $query);
    if (empty($row['id'])) {
        $web = '[nie_znaleziono_strony]';
    } else {
        $web = $row['page_content'];
    }
    echo("<br>");
    echo 'STRONY:';
    echo '<form action="" method="post">';
    while ($row = mysqli_fetch_array($result)) {
        echo '<div class="page-entry" style="display: flex;align-items: center;">
            <p>' . htmlspecialchars($row['id']) . ' ' . htmlspecialchars($row['page_title']) . '        
            <form action="" method="post" style="margin-left: 10px">
                <input type="hidden" name="id_zmiana" value="' . htmlspecialchars($row['id']) . '">
                <input type=submit name=edytuj value=edytuj> 
                <input type=submit name=usun value=usuń>
            </form>
            </p></div>';
    }
    echo '</form>';
    echo '<form method="post"><input type="submit" name="Dodaj" value="Dodaj"></form>';
    if (isset($_POST['Dodaj'])) {
        DodajNowaPodstrone();
    }
    if (isset($_POST['edytuj'])) {
        $id = $_POST['id_zmiana'];
        EdytujPodstrone($id);
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['zapisz'])) {
        $mysqli = new mysqli("localhost", "root", "", "moja_strona");
        $title = htmlspecialchars($_POST['title']);
        $content = htmlspecialchars_decode($_POST['content']);
        $status = isset($_POST["active"]) ? 1 : 0;
        $id = htmlspecialchars($_POST['id']);
        $query = "UPDATE page_list SET page_title = '" . $title . "', page_content = '" . addslashes($content) . "', status = " . $status . " WHERE id = " . $id;
        $result = mysqli_query($mysqli, $query);
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['Dodaj_nowa_podstrone'])) {
        $mysqli = new mysqli("localhost", "root", "", "moja_strona");
        $nowy_tytul = htmlspecialchars($_POST["nowy_Tytul"]);
        $nowa_zawartosc = htmlspecialchars_decode($_POST["nowa_Zawartosc"]);
        $status_nowej_podstrony = 1;
        $query = "INSERT INTO page_list (page_title, page_content, status) VALUES ('$nowy_tytul','$nowa_zawartosc',$status_nowej_podstrony)";
        $result = mysqli_query($mysqli, $query);
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['usun'])) {
        $id_Delete = $_POST['id_zmiana'];
        UsunPodstrone($id_Delete);
    }
    */
    //Sklep z kategoriami i podkategoriami
    //
    #POCZATEK
    $mysqli = new mysqli("localhost", "root", "", "moja_strona");
    $query = "SELECT * FROM category_data";
    $result = mysqli_query($mysqli, $query);
    if (empty($row['id'])) {
        $web = '[nie_znaleziono_strony]';
    } else {
        $web = $row['page_content'];
    }
    function echoCategory($category, $categories)
    {
        echo '<div class="page-entry" style="display: flex;align-items: center;">
            <p>' . htmlspecialchars($category['id']) . ' ' . htmlspecialchars($category['nazwa']) . '
            <form action="" method="post" style="margin-left: 10px">
                <input type="hidden" name="id_zmiana2" value="' . htmlspecialchars($category['id']) . '">
                <input type="submit" name="edytuj2" value="edytuj"> 
                <input type="submit" name="usun2" value="usuń">
            </form>
            </p></div>';
        // Sprawdź i wyświetl podkategorie
        if (isset($categories[$category['id']])) {
            foreach ($categories[$category['id']] as $subcategory) {
                echoCategory($subcategory, $categories);
            }
        }
    }

    echo("<br>");
    echo 'KATEGORIE:';
    echo '<form action="" method="post">';
// Pobranie wszystkich kategorii
    $categories = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $categories[$row['matka']][] = $row;
    }

// Wyświetlanie kategorii i podkategorii
    echo '<form action="" method="post">';
    foreach ($categories[0] as $category) {
        echoCategory($category, $categories);
    }
    echo '</form>';
    #
    echo '<form method="post"><input type="submit" name="Dodaj2" value="Dodaj"></form>';
    if (isset($_POST['Dodaj2'])) {
        DodajNowaKategorie();
    }
    if (isset($_POST['edytuj2'])) {
        $id = $_POST['id_zmiana2'];
        EdytujKategorie($id);
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['zapisz2'])) {
        $mysqli = new mysqli("localhost", "root", "", "moja_strona");
        $nowa_matka = htmlspecialchars($_POST['nowa_matka']);
        $nowa_nazwa = htmlspecialchars($_POST['nowa_nazwa']);
        $id = htmlspecialchars($_POST['id']);
        $query = "UPDATE category_data SET matka = '" . $nowa_matka . "', nazwa = '" . $nowa_nazwa . "' WHERE id = " . $id;
        $result = mysqli_query($mysqli, $query);
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['Dodaj_nowa_kategorie'])) {
        $mysqli = new mysqli("localhost", "root", "", "moja_strona");
        $nowa_matka = htmlspecialchars($_POST["nowa_matka"]);
        $nowa_nazwa = htmlspecialchars($_POST["nowa_nazwa"]);
        $query = "INSERT INTO category_data (matka, nazwa) VALUES ('$nowa_matka','$nowa_nazwa')";
        $result = mysqli_query($mysqli, $query);
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['usun2'])) {
        $id_Delete2 = $_POST['id_zmiana2'];
        UsunKategorie($id_Delete2);
    }
    //
}
echo("<br>");
#KONIEC
/*
Funkcja EdytujPodstrone wyświetla formularz umożliwiający edycję istniejącej podstrony.
Pobiera dane z bazy danych dla podstrony o podanym identyfikatorze $id i umożliwia
zmianę tytułu, treści oraz statusu aktywności.


function EdytujPodstrone($id)
{
    $mysqli = new mysqli("localhost", "root", "", "moja_strona");
    $query = "SELECT * FROM page_list WHERE id=$id LIMIT 1";
    $result = mysqli_query($mysqli, $query);
    $row = mysqli_fetch_array($result);
    echo '<form action="admin.php" method="post">';
    echo 'Tytuł: <input type="text" name="title" value="' . $row['page_title'] . '"><br>';
    echo 'Treść: <textarea name="content" style="width: 500px; height: 400px;">' . $row['page_content'] . '</textarea><br>';
    echo '<input type="checkbox" name="active" ' . ($row['status'] ? 'checked' : '') . '> Aktywna<br>';
    echo '<input type="submit" name="zapisz" value="Zapisz">';
    echo '<input type="hidden" name="id" value="' . $row['id'] . '"><br>';
    echo '</form>';
}

/*
Funkcja DodajNowaPodstrone wyświetla formularz umożliwiający dodanie nowej podstrony.
Pozwala na wprowadzenie nowego tytułu i treści dla podstrony, które są następnie dodawane do bazy danych.

function DodajNowaPodstrone()
{
    echo '<form action="" method="post" style="text-align: left">';
    echo '<label for="nowy_Tytul">Nowy Tytuł:</label>';
    echo '<input type="text" id="nowy_Tytul" name="nowy_Tytul" required><p></p>';
    echo '<label for="nowa_Zawartosc">Nowa Treść:</label><p></p>';
    echo '<textarea id="nowa_Zawartosc" name="nowa_Zawartosc" rows="15" cols="60" required></textarea><p></p>';
    echo '<input type="submit" name="Dodaj_nowa_podstrone" value="Dodaj Nową Podstronę">';
    echo '</form>';
}

/*
Funkcja UsunPodstrone usuwa podstronę o podanym identyfikatorze $id z bazy danych.
Po wykonaniu operacji wyświetla komunikat informujący o usunięciu podstrony.

function UsunPodstrone($id)
{
    $mysqli = new mysqli("localhost", "root", "", "moja_strona");
    $query = "DELETE FROM page_list WHERE id = $id LIMIT 1";
    mysqli_query($mysqli, $query);
    echo "Usunięto podstrone o ID: $id.";
}
*/
// Sklep z katerogirami i podkategoriami metody
//
function EdytujKategorie($id)
{
    $mysqli = new mysqli("localhost", "root", "", "moja_strona");
    $query = "SELECT * FROM category_data WHERE id=$id LIMIT 1";
    $result = mysqli_query($mysqli, $query);
    $row = mysqli_fetch_array($result);
    echo '<form action="admin.php" method="post">';
    echo 'Matka: <input type="text" name="nowa_matka" value="' . $row['matka'] . '"><br>';
    echo 'Nazwa: <textarea name="nowa_nazwa" style="width: 100px; height: 100px;">' . $row['nazwa'] . '</textarea><br>';
    echo '<input type="submit" name="zapisz2" value="Zapisz">';
    echo '<input type="hidden" name="id" value="' . $row['id'] . '"><br>';
    echo '</form>';
}

function DodajNowaKategorie()
{
    echo '<form action="" method="post" style="text-align: left">';
    echo '<label for="nowa_matka">Matka:</label>';
    echo '<input type="text" id="nowa_matka" name="nowa_matka" required><p></p>';
    echo '<label for="nowa_nazwa">Nazwa:</label>';
    echo '<input type="text" id="nowa_nazwa" name="nowa_nazwa" required><p></p>';
    echo '<input type="submit" name="Dodaj_nowa_kategorie" value="Dodaj Nową Kategorie">';
    echo '</form>';
}

function UsunKategorie($id)
{
    $mysqli = new mysqli("localhost", "root", "", "moja_strona");
    $query = "DELETE FROM category_data WHERE id = $id LIMIT 1";
    mysqli_query($mysqli, $query);
    echo "Usunięto kategorie o ID: $id.";
}

?>
