<?php
require('init.php');

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

try {
    $listaKursow = new ListaKursow($dbh);

    $kursy = $listaKursow->pobierzListe();

    echo json_encode($kursy);

} catch (Throwable $wyjatek) {
    Info::blad($wyjatek);
}