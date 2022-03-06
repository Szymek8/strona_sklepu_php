<?php
require('init.php');

if(isset($_POST['submit'])){
    try{
        $kurs = new Kurs($dbh);
        $idDodanegoKursu = $kurs->dodaj($_POST);
        header('Location: kurs_szczegoly.php?id='.$idDodanegoKursu);
    }catch (Throwable $wyjatek){
        Info::blad($wyjatek);
    }
}

echo $layoutStrony->przygotujNaglowek('dodanie kursu');
echo $layoutStrony->przygotujTytul('Dodanie kursu');

$formularz = new Formularz();
$formularz->ustawLink('');
$formularz->ustawMetoda('post');

$pole = new DanePolaFormularza();
$pole->ustawTyp('text');
$pole->ustawNazwa('nazwa');
$pole->ustawLabel('Nazwa');
$formularz->dodajPoleFormularza($pole);

$pole = new DanePolaFormularza();
$pole->ustawTyp('text');
$pole->ustawNazwa('kod_kursu');
$pole->ustawLabel('Kod kursu');
$formularz->dodajPoleFormularza($pole);

$pole = new DanePolaFormularza();
$pole->ustawTyp('text');
$pole->ustawNazwa('cena_netto');
$pole->ustawLabel('Cena netto');
$formularz->dodajPoleFormularza($pole);

$pole = new DanePolaFormularza();
$pole->ustawTyp('text');
$pole->ustawNazwa('cena_brutto');
$pole->ustawLabel('Cena brutto');
$formularz->dodajPoleFormularza($pole);

$pole = new DanePolaFormularza();
$pole->ustawTyp('textarea');
$pole->ustawNazwa('opis');
$pole->ustawLabel('Opis');
$formularz->dodajPoleFormularza($pole);

$pole = new DanePolaFormularza();
$pole->ustawTyp('select');
$pole->ustawNazwa('status');
$pole->ustawLabel('Status');
$pole->ustawListaOpcji(Statusy::pobierzStatusy());
$formularz->dodajPoleFormularza($pole);

$pole = new DanePolaFormularza();
$pole->ustawTyp('submit');
$pole->ustawNazwa('submit');
$pole->ustawLabel('Dodaj');
$formularz->dodajPoleFormularza($pole);

echo $layoutStrony->przygotujSekcje(
    $formularz->pobierzFormularz()
);

echo $layoutStrony->przygotujListePrzyciskow(
    [
        ['label' => 'Lista kursów', 'link' => 'lista_kursow.php', 'styl' => 'danger'],
    ]
);

echo $layoutStrony->przygotujStopke();
