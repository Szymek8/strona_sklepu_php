<?php
require('init.php');

$urlApi = 'http://localhost/zajecia6/api_1_prosty_json.php';

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $urlApi);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$pobraneDane = curl_exec($curl);
if (!$pobraneDane) {
    die("Problem z pobraniem danych");
}
curl_close($curl);

$daneKursow = json_decode($pobraneDane, true);


echo $layoutStrony->przygotujNaglowek('client JSON API przez cURL');
echo $layoutStrony->przygotujTytul('client JSON API przez cURL');

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
