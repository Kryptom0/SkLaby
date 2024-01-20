<form action="" method="post" name="Login_Form">
    <table width="400" border="0" align="center" cellpadding="5" cellspacing="1" class="Table">
        <tr>
            <td colspan="2" align="left" valign="top"><h3>Login</h3></td>
        </tr>
        <tr>
            <td align="right" valign="top">Username</td>
            <td><input name="Username" type="text" class="Input"></td>
        </tr>
        <tr>
            <td align="right">Password</td>
            <td><input name="Password" type="password" class="Input"></td>
        </tr>
        <tr>
            <td></td>
            <td><input name="Submit" type="submit" value="Login" class="Button3"></td>
        </tr>
    </table>
</form>
<?php
session_start(); /* Start sesji */
include "../cfg.php";

/* Sprawdzenie logowania */
if (isset($_POST['Submit'])) {
    $Username = isset($_POST['Username']) ? $_POST['Username'] : '';
    $Password = isset($_POST['Password']) ? $_POST['Password'] : '';

    $Username = htmlspecialchars($Username);
    $Password = htmlspecialchars($Password);
    if ((isset($login) && $Username == $login) and (isset($pass) && $Password == $pass)) {
        $_SESSION['UserData']['Username'] = $login;
        header("location:admin.php");
        exit;
    } else {
        echo '<div style="text-align: center;">Błąd! Logowanie nie powiodło się</div>'; /* Nieprawidlowe logowanie, wiadomosc */
    }
}
?>