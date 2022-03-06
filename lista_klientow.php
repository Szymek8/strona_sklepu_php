<?php

require('init.php');

if(isset($_GET['del_id'])){
    try {
        $klient = new Klient($dbh);
        $klient->usun(intval($_GET['del_id']));
    } catch (Throwable $wyjatek) {
        Info::blad($wyjatek);
    }
}

echo $layoutStrony->przygotujNaglowek('lista klientów');
echo $layoutStrony->przygotujTytul('Lista klientów');


$listaKlientow = new ListaKlientow($dbh);

try {
    $htmlListy = (new Tabela())->generujHtml(
        $listaKlientow->pobierzNaglowkiDoTabeli(),
        $listaKlientow->pobierzWierszeDoTabeli()
    );
    echo $layoutStrony->przygotujSekcje($htmlListy);

} catch (Throwable $wyjatek) {
    Info::blad($wyjatek);
}
echo $layoutStrony->przygotujListePrzyciskow(
    [
        ['label' => 'Dodaj klienta', 'link' => 'klient_dodaj.php', 'styl' => 'btn-primary'],
        ['label' => 'Menu', 'link' => 'index.php', 'styl' => 'btn-success']
    ]
);

echo $layoutStrony->przygotujStopke();