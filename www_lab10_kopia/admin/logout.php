<?php
session_start(); /* Start sesji */
session_destroy(); /* Zamykanie sesji*/
header("location:login.php");  /* Przenoszenie do strony logowania */
exit;

?>