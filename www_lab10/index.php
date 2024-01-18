<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="Author" content="Krystian Drząszcz"/>
    <title>Strona główna</title>
    <script src="js/kolorujtlo.js" type="text/javascript"></script>
    <script src="js/timedate.js" type="text/javascript"></script>
    <link rel="stylesheet" href="css/style.css"/>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <style>
    </style>
</head>
<body onload="startclock()">
<table style="width:100%">
    <tr>
        <td><a href="index.php">Strona Główna</a></td>
        <td><a href="?idp=2">Ranking</a></td>
        <td><a href="?idp=3">Galeria</a></td>
        <td><a href="?idp=4">Informacje</a></td>
        <td><a href="?idp=5">Kontakt</a></td>
        <td><a href="?idp=6">Filmy</a></td>
    </tr>
</table>

<?php
include 'cfg.php';
include 'showpage.php';
if (isset($_GET['idp'])) {
    echo PokazPodstrone($_GET['idp']);
} else {
    echo PokazPodstrone(1);
}
?>
<p style="text-align: center; padding: 10px;">
    <?php
    $nr_indeksu = '164361';
    $nrGrupy = '1 ISI';
    echo 'Krystian Drząszcz ' . $nr_indeksu . ' grupa ' . $nrGrupy;
    ?>
</p>
</body>
</html>
