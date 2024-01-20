<?php
//-----------------------------------------------//
// Wysylanie danych poprzez formularz kontaktowy //
// ----------------------------------------------//
// przesyla dane z formularza kontaktowego
include "cfg.php";
PokazKontakt();
if (isset($_POST['Wyslij'])) {
    WyslijMailKontakt('krysd246@gmail.com');
}
if (isset($_POST['PrzypomnijHaslo'])) {
    PrzypomnijHaslo('krysd246@gmail.com');
}

/*
Funkcja WyslijMailKontakt przetwarza dane z formularza kontaktowego, sprawdzając,
czy pola tematu, treści i e-maila są wypełnione. Jeżeli są, to funkcja wysyła e-mail na
podany adres odbiorcy ($odbiorca) zawierający temat, treść i nadawcę.
Dane z formularza są zabezpieczane przed potencjalnym atakiem typu
CODE INJECTION przy użyciu funkcji htmlspecialchars.
*/
function WyslijMailKontakt($odbiorca)
{
    if (empty($_POST['temat']) || empty($_POST['tresc']) || empty($_POST['email'])) {
        echo '[nie_wypelniles_pola]';
        echo PokazKontakt(); //ponowne wysylanie formularza
    } else {
        $temat = htmlspecialchars($_POST['temat']);
        $tresc = htmlspecialchars($_POST['tresc']);
        $email = htmlspecialchars($_POST['email']);
        $mail['subject'] = $temat;
        $mail['body'] = $tresc;
        $mail['sender'] = $email;
        $mail['reciptient'] = $odbiorca; //czyli my jesesmy odbiorca jeżeli tworzymy formularz kontaktowy
        $header = "From: Formularz kontaktowy <" . $mail['sender'] . ">\n";
        $header .= "MIME-Version; 1.0\nContent-Type: text/plain; charset=utf-8\nContent-Transfer-Encoding: 8bit\n";
        $header .= "X-Sender: <" . $mail['sender'] . ">\n";
        $header .= "X-Mailer: PRapWWW mail 1.2\n";
        $header .= "X-Priority: 3\n";
        $header .= "Return-Path: <" . $mail['sender'] . ">\n";
        mail($mail['reciptient'], $mail['subject'], $mail['body'], $header);
        echo '<script>window.alert("Wysłano!")</script>';
    }
}

/*
Funkcja PokazKontakt wyświetla formularz kontaktowy zawierający pola na temat, treść i adres e-mail,
oraz przycisk "Wyślij". Dodatkowo, formularz zawiera drugi przycisk "Przypomnij hasło",
który pozwala na przypomnienie hasła.
*/
function PokazKontakt()
{
    echo '<form method="post" action=""><label for="temat">Temat:</label>';
    echo '<input type="text" name="temat" required><br>';
    echo '<label for="tresc">Treść:</label>';
    echo '<textarea name="tresc" required></textarea><br><label for="email">Twój e-mail:</label>';
    echo '<input type="email" name="email" required><br><br>';
    echo '<input type="submit" name="Wyslij" value="Wyslij"><br><br>';
    echo '</form>';
    echo '<form method="post" action="">';
    echo '<input type="submit" name="PrzypomnijHaslo" value="Przypomnij haslo"><br><br>';
    echo '</form>';
}

/*
Funkcja PrzypomnijHaslo przypomina hasło poprzez wysłanie e-maila z hasłem do
podanego adresu odbiorcy ($odbiorca). Hasło jest pobierane z globalnej zmiennej $pass.
*/
function PrzypomnijHaslo($odbiorca)
{
    global $pass;
    $mail['subject'] = 'Przypomnienie hasla';
    $mail['body'] = "Haslo: " . $pass;
    $mail['reciptient'] = $odbiorca;
    $mail['sender'] = $odbiorca;
    $header = "From: Formularz kontaktowy <" . $mail['sender'] . ">\n";
    $header .= "MIME-Version; 1.0\nContent-Type: text/plain; charset=utf-8\nContent-Transfer-Encoding: 8bit\n";
    $header .= "X-Sender: <" . $mail['sender'] . ">\n";
    $header .= "X-Mailer: PRapWWW mail 1.2\n";
    $header .= "X-Priority: 3\n";
    $header .= "Return-Path: <" . $mail['sender'] . ">\n";
    mail($mail['reciptient'], $mail['subject'], $mail['body'], $header);
    echo '<script>window.alert("Wysłano!")</script>';
}

?>
