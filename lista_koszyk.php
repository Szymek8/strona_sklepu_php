<?php
require ('init.php');

if(isset($_GET['sesja']) && $_GET['sesja'] == 'nowa'){
    session_regenerate_id();
}
echo $layoutStrony->przygotujNaglowek('koszyk');
echo $layoutStrony->przygotujTytul('Zawartość koszyka');

echo $layoutStrony->przygotujSekcje('identyfikator sesji: '.session_id());


$koszyk = new ListaKoszyk($dbh);
$koszyk->ustawIdentyfikatorKoszyka(session_id());

$htmlListy = (new Tabela())->generujHtml(
    $koszyk->pobierzNaglowkiDoTabeli(),
    $koszyk->pobierzWierszeDoTabeli()
);
echo $layoutStrony->przygotujSekcje($htmlListy);

echo $layoutStrony->przygotujSekcje('
<a class="btn btn-danger" href="koszyk.php?opcja=czysc_koszyk" onclick="if(confirm(\'Czy chcesz usunąć zawartość koszyka?\')) return true; else return false;">czyść koszyk</a>
<a class="btn btn-primary" href="?sesja=nowa">generuj nowy identyfikator sesji</a>
');


echo $layoutStrony->przygotujListePrzyciskow(
    [
        ['label' => 'Lista kursów', 'link' => 'lista_kursow.php', 'styl' => 'danger'],
    ]
);

echo $layoutStrony->przygotujStopke();