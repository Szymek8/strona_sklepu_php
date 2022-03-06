<?php
require('init.php');

$urlApi = 'http://localhost/zajecia6/api_2_prosty_xml2.php';

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $urlApi);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$pobraneDane = curl_exec($curl);
if (!$pobraneDane) {
    die("Problem z pobraniem danych");
}
curl_close($curl);

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

echo $layoutStrony->przygotujNaglowek('client XML API przez cURL');
echo $layoutStrony->przygotujTytul('client XML API przez cURL');

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
