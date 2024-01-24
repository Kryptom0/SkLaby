<?php
session_start(); //Start sesji
if (!isset($_SESSION['UserData']['Username'])) {
    header("location:login.php");
    exit;
} else {
    echo "Gratulacje, zostałeś zalogowany!<br /> <a href=logout.php>Kliknij tutaj</a> aby się wylogować. <br /> ";
    //
    //Strony i podstrony
    //
    /*
    Funkcja EdytujPodstrone wyświetla formularz umożliwiający edycję istniejącej podstrony.
    Pobiera dane z bazy danych dla podstrony o podanym identyfikatorze $id i umożliwia
    zmianę tytułu, treści oraz statusu aktywności.
    */

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
    */

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
    */

    function UsunPodstrone($id)
    {
        $mysqli = new mysqli("localhost", "root", "", "moja_strona");
        $query = "DELETE FROM page_list WHERE id = $id LIMIT 1";
        mysqli_query($mysqli, $query);
        echo "Usunięto podstrone o ID: $id.";
    }

    $mysqli = new mysqli("localhost", "root", "", "moja_strona");
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
    //
    //Sklep z kategoriami i podkategoriami
    //
    //
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

    $mysqli = new mysqli("localhost", "root", "", "moja_strona");
    $query = "SELECT * FROM category_data";
    $result = mysqli_query($mysqli, $query);
    if (empty($row['id'])) {
        $web = '[nie_znaleziono_strony]';
    } else {
        $web = $row['page_content'];
    }
    function echoCategory($category, $categories, $depth = 0)
    {
        echo '<div class="page-entry" style="display: flex; align-items: center; margin-left: ' . $depth * 20 . 'px;">
            <p>' . htmlspecialchars($category['id']) . ' ' . htmlspecialchars($category['nazwa']) . '
            <form action="" method="post" style="margin-left: 10px">
                <input type="hidden" name="id_zmiana2" value="' . htmlspecialchars($category['id']) . '">
                <input type="submit" name="edytuj2" value="edytuj"> 
                <input type="submit" name="usun2" value="usuń">
            </form>
            </p></div>';
        if (isset($categories[$category['id']])) {         // Sprawdź i wyświetl podkategorie
            foreach ($categories[$category['id']] as $subcategory) {
                echoCategory($subcategory, $categories, $depth + 1);
            }
        }
    }

    echo("<br>");
    echo 'KATEGORIE:';
    echo '<form action="" method="post">';
    $categories = array(); // Pobranie wszystkich kategorii
    while ($row = mysqli_fetch_assoc($result)) {
        $categories[$row['matka']][] = $row;
    }
    echo '<form action="" method="post">'; // Wyświetlanie kategorii i podkategorii
    foreach ($categories[0] as $category) {
        echoCategory($category, $categories);
    }
    echo '</form>';
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
    //Produkty
    //
    echo("<br>");
    echo("PRODUKTY: ");
    function echoProduct($product)
    {
        echo '</div>';
        echo '<div class="product-entry" style="margin-left: 20px;">';
        echo '   <p style="margin-left: -20px;">ID: ' . htmlspecialchars($product['id']) . '</p>';
        echo '   <p>Tytuł: ' . htmlspecialchars($product['tytul']) . '</p>';
        echo '   <p>Opis: ' . htmlspecialchars($product['opis']) . '</p>';
        echo '   <p>Data utworzenia: ' . htmlspecialchars($product['data_utworzenia']) . '</p>';
        echo '   <p>Data_wygasniecia: ' . htmlspecialchars($product['data_wygasniecia']) . '</p>';
        echo '   <p>Cena Netto: ' . htmlspecialchars($product['cena_netto']) . '</p>';
        echo '   <p>Podatek_vat	: ' . htmlspecialchars($product['podatek_vat']) . '</p>';
        echo '   <p>Ilosc dostepnych sztuk: ' . htmlspecialchars($product['ilosc_dostepnych_sztuk']) . '</p>';
        echo '   <p>Status dostepnosci: ' . htmlspecialchars($product['status_dostepnosci']) . '</p>';
        echo '   <p>Kategoria: ' . htmlspecialchars($product['kategoria']) . '</p>';
        echo '   <p>Gabaryt produktu: ' . htmlspecialchars($product['gabaryt_produktu']) . '</p>';
        echo '   <p>Zdjecie: <img src="' . htmlspecialchars($product['zdjecie']) . '" alt="Product Image" style="width: 100px; height: auto;"></p>';
        echo '   <form action="" method="post">';
        echo '       <p style="margin-left: -20px;"><input type="hidden" name="id_zmiana_produktu" value="' . htmlspecialchars($product['id']) . '">';
        echo '       <input type="submit" name="edytuj_produkt" value="Edytuj">';
        echo '       <input type="submit" name="usun_produkt" value="Usuń">';
        echo '   </form>';
        echo '</div>';
        if ($product['status_dostepnosci'] == 'Dostępny' && $product['ilosc_dostepnych_sztuk'] > 0 && strtotime($product['data_wygasniecia']) > time()) {
            echo '   <p>Status dostepnosci: Dostępny</p>';
        } else {
            echo '   <p>Status dostepnosci: Niedostępny</p>';
        }
    }

    function listProducts()
    {
        $mysqli = new mysqli("localhost", "root", "", "moja_strona");
        $query = "SELECT * FROM produkty";
        $result = mysqli_query($mysqli, $query);
        echo '<div class="product-list">';
        while ($row = mysqli_fetch_assoc($result)) {
            echoProduct($row);
        }
        echo '</div>';
    }

    echo '<form action="" method="post">
    <input type="submit" name="pokaz_produkty" value="Pokaż Produkty"></form>';
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['pokaz_produkty'])) {
        listProducts();
    }
    echo '<form action="" method="post"></form>';
    echo '<form action="" method="post">
        <label for="tytul">Tytuł:</label>
        <input type="text" name="tytul" required><br>
        <label for="opis">Opis:</label>
        <textarea name="opis"></textarea><br>
        <label for="data_utworzenia	">Data utworzenia:</label>
        <input type="date" name="data_utworzenia"><br>
        <label for="data_wygasniecia">Data wygaśnięcia:</label>
        <input type="date" name="data_wygasniecia"><br>
        <label for="cena_netto">Cena Netto:</label>
        <input type="text" name="cena_netto" required><br>
        <label for="podatek_vat">Podatek VAT:</label>
        <input type="text" name="podatek_vat"><br>
        <label for="ilosc_dostepnych_sztuk">Ilość dostępnych sztuk:</label>
        <input type="text" name="ilosc_dostepnych_sztuk"><br>
        <label for="status_dostepnosci">Status dostępności:</label>
        <input type="text" name="status_dostepnosci"><br>
        <label for="kategoria">Kategoria:</label>
        <input type="text" name="kategoria"><br>
        <label for="gabaryt_produktu">Gabaryt produktu:</label>
        <input type="text" name="gabaryt_produktu"><br>
        <label for="zdjecie">Zdjecie:</label>
        <input type="text" name="zdjecie"><br>
        <input type="submit" name="Dodaj_produkt" value="DodajProdukt">
      </form>';
    function DodajProdukt($tytul, $opis, $data_utworzenia, $data_wygasniecia, $cena_netto, $podatek_vat, $ilosc_dostepnych_sztuk, $status_dostepnosci, $kategoria, $gabaryt_produktu, $zdjecie)
    {
        $mysqli = new mysqli("localhost", "root", "", "moja_strona");
        $query = "INSERT INTO produkty (tytul, opis, data_utworzenia, data_wygasniecia,  cena_netto, podatek_vat, ilosc_dostepnych_sztuk, status_dostepnosci, kategoria, gabaryt_produktu, zdjecie) 
              VALUES ('$tytul', '$opis', '$data_utworzenia', '$data_wygasniecia', $cena_netto, $podatek_vat, $ilosc_dostepnych_sztuk, '$status_dostepnosci', '$kategoria', '$gabaryt_produktu', '$zdjecie')";
        $result = mysqli_query($mysqli, $query);
        if ($result) {
            echo " Dodano produkt.";
        } else {
            echo " Błąd podczas dodawania produktu: " . mysqli_error($mysqli);
        }
    }

    function EdytujProdukt($id, $tytul, $opis, $data_utworzenia, $data_wygasniecia, $cena_netto, $podatek_vat, $ilosc_dostepnych_sztuk, $status_dostepnosci, $kategoria, $gabaryt_produktu, $zdjecie)
    {
        $mysqli = new mysqli("localhost", "root", "", "moja_strona");
        $query = "UPDATE produkty SET tytul = '$tytul', opis = '$opis', data_utworzenia = '$data_utworzenia', data_wygasniecia = '$data_wygasniecia', cena_netto = $cena_netto, podatek_vat ='$podatek_vat', ilosc_dostepnych_sztuk = '$ilosc_dostepnych_sztuk', status_dostepnosci ='$status_dostepnosci', kategoria ='$kategoria', gabaryt_produktu ='$gabaryt_produktu', zdjecie='$zdjecie' WHERE id = $id";
        $result = mysqli_query($mysqli, $query);
        if ($result) {
            echo "Edycja produktu zakończona pomyślnie.";
        } else {
            echo "Błąd podczas edycji produktu: " . mysqli_error($mysqli);
        }
    }

    function UsunProdukt($id)
    {
        $mysqli = new mysqli("localhost", "root", "", "moja_strona");
        $query = "DELETE FROM produkty WHERE id = $id LIMIT 1";
        $result = mysqli_query($mysqli, $query);
        if ($result) {
            echo "Usunięto produkt o ID: $id.";
        } else {
            echo "Błąd podczas usuwania produktu: " . mysqli_error($mysqli);
        }
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['zapisz_edycje_produktu'])) {
        $id_produktu_do_edycji = $_POST['id_produktu_do_edycji'];
        $tytul = htmlspecialchars($_POST['tytul']);
        $opis = htmlspecialchars($_POST['opis']);
        $data_utworzenia = isset($_POST['data_utworzenia']) ? htmlspecialchars($_POST['data_utworzenia']) : null;
        $data_wygasniecia = isset($_POST['data_wygasniecia']) ? htmlspecialchars($_POST['data_wygasniecia']) : null;
        $cena_netto = htmlspecialchars($_POST['cena_netto']);
        $podatek_vat = isset($_POST['podatek_vat']) ? htmlspecialchars($_POST['podatek_vat']) : null;
        $ilosc_dostepnych_sztuk = isset($_POST['ilosc_dostepnych_sztuk']) ? htmlspecialchars($_POST['ilosc_dostepnych_sztuk']) : null;
        $status_dostepnosci = isset($_POST['status_dostepnosci']) ? htmlspecialchars($_POST['status_dostepnosci']) : null;
        $kategoria = isset($_POST['kategoria']) ? htmlspecialchars($_POST['kategoria']) : null;
        $gabaryt_produktu = isset($_POST['gabaryt_produktu']) ? htmlspecialchars($_POST['gabaryt_produktu']) : null;
        $zdjecie = isset($_POST['zdjecie']) ? htmlspecialchars($_POST['zdjecie']) : null;
        EdytujProdukt($id_produktu_do_edycji, $tytul, $opis, $data_utworzenia, $data_wygasniecia, $cena_netto, $podatek_vat, $ilosc_dostepnych_sztuk, $status_dostepnosci, $kategoria, $gabaryt_produktu, $zdjecie);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['Dodaj_produkt'])) {
        $tytul = htmlspecialchars($_POST['tytul']);
        $opis = htmlspecialchars($_POST['opis']);
        $data_utworzenia = isset($_POST['data_utworzenia']) ? htmlspecialchars($_POST['data_utworzenia']) : null;
        $data_wygasniecia = isset($_POST['data_wygasniecia']) ? htmlspecialchars($_POST['data_wygasniecia']) : null;
        $cena_netto = htmlspecialchars($_POST['cena_netto']);
        $podatek_vat = isset($_POST['podatek_vat']) ? htmlspecialchars($_POST['podatek_vat']) : null;
        $ilosc_dostepnych_sztuk = isset($_POST['ilosc_dostepnych_sztuk']) ? htmlspecialchars($_POST['ilosc_dostepnych_sztuk']) : null;
        $status_dostepnosci = isset($_POST['status_dostepnosci']) ? htmlspecialchars($_POST['status_dostepnosci']) : null;
        $kategoria = isset($_POST['kategoria']) ? htmlspecialchars($_POST['kategoria']) : null;
        $gabaryt_produktu = isset($_POST['gabaryt_produktu']) ? htmlspecialchars($_POST['gabaryt_produktu']) : null;
        $zdjecie = isset($_POST['zdjecie']) ? htmlspecialchars($_POST['zdjecie']) : null;
        echo "Tytuł: $tytul, Opis: $opis, Data wygaśnięcia: $data_wygasniecia, Cena Netto: $cena_netto, Podatek VAT: $podatek_vat, Ilość dostępnych sztuk: $ilosc_dostepnych_sztuk, Status dostępności: $status_dostepnosci, Kategoria: $kategoria, Gabaryt produktu: $gabaryt_produktu";
        DodajProdukt($tytul, $opis, $data_utworzenia, $data_wygasniecia, $cena_netto, $podatek_vat, $ilosc_dostepnych_sztuk, $status_dostepnosci, $kategoria, $gabaryt_produktu, $zdjecie);
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['edytuj_produkt'])) {
        $id_produktu = $_POST['id_zmiana_produktu'];
        $mysqli = new mysqli("localhost", "root", "", "moja_strona");
        $query = "SELECT * FROM produkty WHERE id = $id_produktu LIMIT 1";
        $result = mysqli_query($mysqli, $query);
        if ($result && $row = mysqli_fetch_assoc($result)) {
            echo '<form action="" method="post">
            <input type="hidden" name="id_produktu_do_edycji" value="' . htmlspecialchars($row['id']) . '">
            <label for="tytul">Tytuł:</label>
            <input type="text" name="tytul" value="' . htmlspecialchars($row['tytul']) . '" required><br>
            <label for="opis">Opis:</label>
            <textarea name="opis">' . htmlspecialchars($row['opis']) . '</textarea><br>
            <label for="data_utworzenia">Data utworzenia:</label>
            <textarea name="data_utworzenia">' . htmlspecialchars($row['data_utworzenia']) . '</textarea><br>
            <label for="data_wygasniecia">Data wygasniecia:</label>
            <textarea name="data_wygasniecia">' . htmlspecialchars($row['data_wygasniecia']) . '</textarea><br>
            <label for="cena_netto">Cena netto:</label>
            <input type="text" name="cena_netto" value="' . htmlspecialchars($row['cena_netto']) . '" required><br>
            <label for="podatek_vat">Podatek vat:</label>
            <input type="text" name="podatek_vat" value="' . htmlspecialchars($row['podatek_vat']) . '" required><br>
            <label for="ilosc_dostepnych_sztuk">Ilosc dostepnych sztuk:</label>
            <input type="text" name="ilosc_dostepnych_sztuk" value="' . htmlspecialchars($row['ilosc_dostepnych_sztuk']) . '" required><br>
            <label for="status_dostepnosci">Status dostepnosci:</label>
            <input type="text" name="status_dostepnosci" value="' . htmlspecialchars($row['status_dostepnosci']) . '" required><br>
            <label for="kategoria">Kategoria:</label>
            <input type="text" name="kategoria" value="' . htmlspecialchars($row['kategoria']) . '" required><br>
            <label for="gabaryt_produktu">Gabaryt produktu:</label>
            <input type="text" name="gabaryt_produktu" value="' . htmlspecialchars($row['gabaryt_produktu']) . '" required><br>
            <label for="zdjecie">Zdjecie:</label>
            <input type="text" name="zdjecie" value="' . htmlspecialchars($row['zdjecie']) . '" required><br>
            <input type="submit" name="zapisz_edycje_produktu" value="Zapisz">
          </form>';
        } else {
            echo "Błąd podczas pobierania danych produktu: " . mysqli_error($mysqli);
        }
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['usun_produkt'])) {
        $id_produktu_do_usuniecia = $_POST['id_zmiana_produktu'];
        UsunProdukt($id_produktu_do_usuniecia);
    }
}
?>
