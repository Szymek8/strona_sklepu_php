<?php
require('init.php');

$urlApi = 'http://localhost/zajecia6/api_1_prosty_json.php';

$pobraneDane = file_get_contents($urlApi);

$daneKursow = json_decode($pobraneDane, true);

echo $layoutStrony->przygotujNaglowek('client JSON API przez file_get_contents()');
echo $layoutStrony->przygotujTytul('client JSON API przez file_get_contents()');

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
