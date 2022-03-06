<?php

require('init.php');

if(isset($_GET['del_id'])){
    try{
        $kurs = new Kurs($dbh);
        $kurs->usun(intval($_GET['del_id']));
    } catch (Throwable $wyjatek) {
        Info::blad($wyjatek);
    }
}

echo $layoutStrony->przygotujNaglowek('lista kursów');
echo $layoutStrony->przygotujTytul('Lista kursów') ;


try {
    $listaKursow = new ListaKursow($dbh);

    $htmlListy = (new Tabela())->generujHtml(
        $listaKursow->pobierzNaglowkiDoTabeli(),
        $listaKursow->pobierzWierszeDoTabeli()

    );

    echo $layoutStrony->przygotujSekcje($htmlListy);

} catch (Throwable $wyjatek) {
    Info::blad($wyjatek);
}


echo $layoutStrony->przygotujListePrzyciskow(
    [
        ['label' => 'Dodaj kurs', 'link' => 'kurs_dodaj.php', 'styl' => 'btn-primary'],
        ['label' => 'Menu', 'link' => 'index.php', 'styl' => 'btn-success']

    ]
);

echo $layoutStrony->przygotujStopke();


