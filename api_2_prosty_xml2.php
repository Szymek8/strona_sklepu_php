<?php
require('init.php');

header('Access-Control-Allow-Origin: *');
header('Content-type: text/xml; charset=UTF-8');

try {
    $listaKursow = new ListaKursow($dbh);
    $kursy = $listaKursow->pobierzListe();

    $xml = new DOMDocument('1.0', 'utf-8');

    $kursyXml = $xml->createElement('kursy');
    $xml->appendChild($kursyXml);

    foreach ($kursy as $key => $kurs) {
        $kursXml = $xml->createElement('kurs');
        foreach ($kurs as $kolumna => $wartosc) {
            $kursXml->setAttribute($kolumna, $wartosc);
        }
        $kursyXml->appendChild($kursXml);
    }

    print $xml->saveXML();
} catch (Throwable $wyjatek) {
    Info::blad($wyjatek);
}