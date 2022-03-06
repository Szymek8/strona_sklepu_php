<?php

require('init.php');


echo $layoutStrony->przygotujNaglowek('lista API');
echo $layoutStrony->przygotujTytul('Lista API');


$htmlListy = '<div class="list-group">
<a href="api_1_prosty_json.php" class="list-group-item list-group-item-action">API 1 - zwracające listę kursów jako JSON</a>
<a href="api_1_klient_fgc.php" class="list-group-item list-group-item-action">API 1 - klient pobierający JSON przez file_get_contents()</a>
<a href="api_1_klient_curl.php" class="list-group-item list-group-item-action">API 1 - klient pobierający JSON przez cURL</a>
<a href="api_2_prosty_xml1.php" class="list-group-item list-group-item-action">API 2 - zwracające listę kursów jako XML v1</a>
<a href="api_2_prosty_xml2.php" class="list-group-item list-group-item-action">API 2 - zwracające listę kursów jako XML v2</a>
<a href="api_2_klient_fgc.php" class="list-group-item list-group-item-action">API 2 - klient pobierający XML przez file_get_contents()</a>
<a href="api_2_klient_curl.php" class="list-group-item list-group-item-action">API 2 - klient pobierający XML przez cURL</a>

</div>';

echo $layoutStrony->przygotujSekcje($htmlListy);

echo $layoutStrony->przygotujListePrzyciskow(
    [
        ['label' => 'Menu', 'link' => 'index.php', 'styl' => 'btn-success']
    ]
);

echo $layoutStrony->przygotujStopke();


