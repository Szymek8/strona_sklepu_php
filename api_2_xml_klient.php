<?php
require('init.php');

header('Access-Control-Allow-Origin: *');
header('Content-type: text/xml; charset=UTF-8');


try {
    $ListaKlientow = new ListaKlientow($dbh);
    $klienci = $ListaKlientow->pobierzListe();

    echo '<klienci>';
    foreach ($klienci as $key => $klienci){
        echo '<klienci';
        foreach($klienci as $kolumna => $wartosc){
            echo ' '.$kolumna.'="'.$wartosc.'"';
        }
        echo ' />';
    }
    echo '</klienci>';

} catch (Throwable $wyjatek) {
    Info::blad($wyjatek);
}