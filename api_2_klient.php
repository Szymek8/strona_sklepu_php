<?php
require('init.php');

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

try {
    $listaklientow = new ListaKlientow($dbh);

    $klient = $listaklientow->pobierzListe();

    echo json_encode($klient);

} catch (Throwable $wyjatek) {
    Info::blad($wyjatek);
}