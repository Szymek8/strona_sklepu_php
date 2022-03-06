<?php
require('init.php');

header('Access-Control-Allow-Origin: *');
header('Content-type: text/xml; charset=UTF-8');


try {
    $listaKursow = new ListaKursow($dbh);
    $kursy = $listaKursow->pobierzListe();

    echo '<kursy>';
    foreach ($kursy as $key => $kurs){
        echo '<kurs';
        foreach($kurs as $kolumna => $wartosc){
            echo ' '.$kolumna.'="'.$wartosc.'"';
        }
        echo ' />';
    }
    echo '</kursy>';

} catch (Throwable $wyjatek) {
    Info::blad($wyjatek);
}