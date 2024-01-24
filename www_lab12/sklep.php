<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sklep Online</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 3px;
            text-align: center;
        }

        main {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #333;
        }

        ul {
            list-style: none;
            padding: 0;
        }

        li {
            border-bottom: 1px solid #ddd;
            padding: 10px 0;
        }

        form {
            display: inline-block;
        }

        #koszyk {
            position: fixed;
            top: 10px;
            right: 10px;
            background-color: #333;
            color: #fff;
            padding: 10px;
            border-radius: 5px;
        }

        #koszyk a {
            color: #fff;
            text-decoration: none;
            margin-left: 10px;
        }

        #glowna-link {
            position: fixed;
            top: 10px;
            right: 10px;
            background-color: #333;
            color: #fff;
            padding: 10px;
            border-radius: 5px;
            text-decoration: none;
        }
    </style>
</head>

<body>
<header>
    <h1>Sklep Online</h1>
</header>
<main>
    <?php
    if (isset($_POST['action']) && $_POST['action'] === 'add_to_cart') {
        $produktId = $_POST['produkt_id'];
        Dodajprodukt($produktId);
        header("Location: sklep.php");
    }
    function PokazProdukty()
    {
        $mysqli = new mysqli("localhost", "root", "", "moja_strona");
        if ($mysqli->connect_error) {
            die("Błąd połączenia z bazą danych: " . $mysqli->connect_error);
        }
        $query = "SELECT * FROM produkty";
        $result = mysqli_query($mysqli, $query);
        if ($result === false) {
            die("Błąd zapytania SQL: " . $mysqli->error);
        }
        echo '<div style="text-align: center; margin-top: 20px;">
        <h2>Produkty do kupienia:</h2></div>';
        echo "<ul>";
        while ($produkt = $result->fetch_assoc()) {
            echo "<li>";
            echo "ID: " . $produkt['id'] . "<br>";
            echo "Tytuł: " . $produkt['tytul'] . "<br>";
            echo "Opis: " . $produkt['opis'] . "<br>";
            echo "Cena Netto: " . $produkt['cena_netto'] . "<br>";
            echo '<form method="post" action="sklep.php">';
            echo '<input type="hidden" name="action" value="add_to_cart">';
            echo '<input type="hidden" name="produkt_id" value="' . $produkt['id'] . '">';
            echo '<input type="submit" value="Dodaj do koszyka">';
            echo '</form>';
            echo "</li>";
        }
        echo "</ul>";
        $mysqli->close();
    }

    function Dodajprodukt($produktId)
    {
        session_start();
        $mysqli = new mysqli("localhost", "root", "", "moja_strona");
        $querySprawdzProdukt = "SELECT * FROM produkty WHERE id='$produktId'";
        $resultSprawdzProdukt = mysqli_query($mysqli, $querySprawdzProdukt);
        if ($resultSprawdzProdukt && mysqli_num_rows($resultSprawdzProdukt) > 0) {
            $rowProdukt = mysqli_fetch_assoc($resultSprawdzProdukt);
            $ilosc_dostepnych_sztuk = $rowProdukt['ilosc_dostepnych_sztuk'];
            if ($ilosc_dostepnych_sztuk > 0) {
                if (isset($_SESSION['koszyk'][$produktId])) {
                    $_SESSION['koszyk'][$produktId]['ilosc'] += 1;
                } else {
                    $_SESSION['koszyk'][$produktId] = array(
                        'ilosc' => 1,
                        'cenaBrutto' => ($rowProdukt['cena_netto'] * $rowProdukt['podatek_vat'] / 100) + $rowProdukt['cena_netto']);
                }
                $nowailosc_dostepnych_sztuk = $ilosc_dostepnych_sztuk - 1;
                $queryAktualizujIlosc = "UPDATE produkty SET ilosc_dostepnych_sztuk='$nowailosc_dostepnych_sztuk' WHERE id='$produktId'";
                $resultAktualizujIlosc = mysqli_query($mysqli, $queryAktualizujIlosc);

            }
        } else {
            echo "Nie ma wybranego produktu.";
        }
        $mysqli->close();
    }

    function Koszyk()
    {
        session_start();
        $mysqli = new mysqli("localhost", "root", "", "moja_strona");
        echo '<div style="text-align: center; margin-top: 20px;">
        <h2>Koszyk:</h2></div>';
        if (!isset($_SESSION['koszyk']) || empty($_SESSION['koszyk'])) {
            echo "Nie masz jeszcze produktow w koszyku.";
            return;
        }
        echo '<ul>';
        $doZaplaty = 0;
        foreach ($_SESSION['koszyk'] as $produktId => $produkt) {
            $queryProdukt = "SELECT * FROM produkty WHERE id='$produktId'";
            $produkty = mysqli_query($mysqli, $queryProdukt);
            if ($produkty && mysqli_num_rows($produkty) > 0) {
                $rowProdukt = mysqli_fetch_assoc($produkty);
                $ilosc = $produkt['ilosc'];
                $brutto = $produkt['cenaBrutto'];
                $calkowita = $ilosc * $brutto;
                $doZaplaty += $calkowita;
                echo '<li>' . ' ' . htmlspecialchars($rowProdukt['tytul']);
                echo ' , Ilość sztuk: ' . $ilosc . '';
                echo ' , Cena brutto: ' . $brutto;
                echo ' , Całkowity Koszt: ' . $calkowita;
                echo ' <a href="?remove=' . $produktId . '">Usuń produkt</a>';
                echo '</li>';
            } else {
                echo "Nie udalo sie dodac do koszyka! .";
            }
        }
        echo '<p>Całkowity koszt zakupów: ' . $doZaplaty . ' zl</p>';
        echo '</ul>';
        $mysqli->close();
        echo '<div style="text-align: center; margin-top: 20px;">
        <p><a href="?clear">Usun produkty w koszyku</a>  ||  <a href="?buy">KUPUJE</a></p>
        </div>';
    }

    function UsunProdukt($produktId)
    {
        session_start();
        $mysqli = new mysqli("localhost", "root", "", "moja_strona");
        if (isset($_SESSION['koszyk'][$produktId])) {
            $queryProdukt = "SELECT * FROM produkty WHERE id='$produktId'";
            $resultProdukt = mysqli_query($mysqli, $queryProdukt);
            if ($resultProdukt && mysqli_num_rows($resultProdukt) > 0) {
                $rowProdukt = mysqli_fetch_assoc($resultProdukt);
                $ilosc_w_koszyku = $_SESSION['koszyk'][$produktId]['ilosc'];
                $nowa_ilosc_dostepnych_sztuk = $rowProdukt['ilosc_dostepnych_sztuk'] + $ilosc_w_koszyku;
                $queryAktualizujIlosc = "UPDATE produkty SET ilosc_dostepnych_sztuk='$nowa_ilosc_dostepnych_sztuk' WHERE id='$produktId'";
                $resultAktualizujIlosc = mysqli_query($mysqli, $queryAktualizujIlosc);
                unset($_SESSION['koszyk'][$produktId]);
            } else {
                echo "Błąd przy usuwaniu produktu.";
            }
        }
        $mysqli->close();
    }

    function UsunZawartoscKoszyka()
    {
        session_start();
        foreach ($_SESSION['koszyk'] as $produktId => $produkt) {
            UsunProdukt($produktId);
        }
        unset($_SESSION['koszyk']);
    }

    function WyczyscZakupy()
    {
        unset($_SESSION['koszyk']);
    }

    function Kupuj()
    {
        $mysqli = new mysqli("localhost", "root", "", "moja_strona");

        if (!isset($_SESSION['koszyk']) || empty($_SESSION['koszyk'])) {
            echo "Dodaj produkty aby dokonać zakupu.";
            return;
        }

        foreach ($_SESSION['koszyk'] as $produktId => $produkt) {
            $queryProdukt = "SELECT * FROM produkty WHERE id='$produktId'";
            $resultProdukt = mysqli_query($mysqli, $queryProdukt);

            if ($resultProdukt && mysqli_num_rows($resultProdukt) > 0) {
                $rowProdukt = mysqli_fetch_assoc($resultProdukt);
                $ilosc_dostepnych_sztuk = isset($rowProdukt['ilosc_dostepnych_sztuk']) ? $rowProdukt['ilosc_dostepnych_sztuk'] : 0;
                $ilosc = 0;
                if ($ilosc <= $ilosc_dostepnych_sztuk) {
                    $queryAktualizacja = "UPDATE produkty SET ilosc_dostepnych_sztuk = $ilosc_dostepnych_sztuk WHERE id = '$produktId'";
                    mysqli_query($mysqli, $queryAktualizacja);
                }
            }
        }

        WyczyscZakupy();
        $mysqli->close();
    }

    Koszyk();
    if (isset($_GET['add'])) {
        $produktId = $_GET['add'];
        Dodajprodukt($produktId);
        header("Location: sklep.php");
    } elseif (isset($_GET['remove'])) {
        $produktId = $_GET['remove'];
        UsunProdukt($produktId);
        header("Location: sklep.php");
    } elseif (isset($_GET['clear'])) {
        UsunZawartoscKoszyka();
        header("Location: sklep.php");
    } elseif (isset($_GET['buy'])) {
        Kupuj();
        header("Location: sklep.php");
    } else {
        PokazProdukty();
    }

    ?>
</main>
<a href="index.php" id="glowna-link">Strona główna</a>
</body>

</html>
</div>