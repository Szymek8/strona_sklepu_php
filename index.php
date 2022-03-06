<?php
require('init.php');

echo $layoutStrony->przygotujNaglowek('zajęcia 6');

echo $layoutStrony->przygotujListePrzyciskow(
    [
        [
            'label' => 'Lista kursów',
            'link' => 'lista_kursow.php',
            'styl' => 'primary'
        ],
        [
            'label' => 'Lista klientów',
            'link' => 'lista_klientow.php',
            'styl' => 'success'
        ],
        [
            'label' => 'Lista API',
            'link' => 'lista_api.php',
            'styl' => 'secondary'
        ]
    ]
);

echo $layoutStrony->przygotujStopke();
