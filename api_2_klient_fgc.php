<?php
require('init.php');

$urlApi = 'http://localhost/zajecia6/api_2_prosty_xml1.php';

$pobraneDane = file_get_contents($urlApi);

$xml = new DOMDocument('1.0', 'utf-8');
$xml->loadXML($pobraneDane);
$daneKursow = [];

foreach($xml->getElementsByTagName('kurs') as $kurs) {
    $daneKursu = [];
    if ($kurs->hasAttributes()) {
        foreach ($kurs->attributes as $atrybut) {
            $kolumna = $atrybut->nodeName;
            $wartosc = $atrybut->nodeValue;
            $daneKursu[$kolumna] = $wartosc;
        }
    }
    $daneKursow[] = $daneKursu;
}

echo $layoutStrony->przygotujNaglowek('client XML API przez file_get_contents()');
echo $layoutStrony->przygotujTytul('client XML API przez file_get_contents()');

$htmlListy = (new Tabela())->generujHtml(
    ['id', 'nazwa', 'cena_netto', 'cena_brutto', 'status'],
    $daneKursow
);
echo $layoutStrony->przygotujSekcje($htmlListy);

echo $layoutStrony->przygotujListePrzyciskow(
    [
        ['label' => 'Lista API', 'link' => 'lista_api.php', 'styl' => 'btn-success']
    ]
);
