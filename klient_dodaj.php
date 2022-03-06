<?php
require('init.php');

if(isset($_POST['submit'])){
    try{
        $kurs = new Klient($dbh);
        $idDodanegoKlienta = $kurs->dodaj($_POST);
        header('Location: klient_szczegoly.php?id='.$idDodanegoKlienta);
    }catch (Throwable $wyjatek){
        Info::blad($wyjatek);
    }


}
echo $layoutStrony->przygotujNaglowek('dodanie klienta');
echo $layoutStrony->przygotujTytul('Dodanie klienta');

$formularz = new Formularz();
$formularz->ustawLink('');
$formularz->ustawMetoda('post');

$pole = new DanePolaFormularza();
$pole->ustawTyp('text');
$pole->ustawNazwa('imie');
$pole->ustawLabel('Imię');
$formularz->dodajPoleFormularza($pole);

$pole = new DanePolaFormularza();
$pole->ustawTyp('text');
$pole->ustawNazwa('nazwisko');
$pole->ustawLabel('Nazwisko');
$formularz->dodajPoleFormularza($pole);

$pole = new DanePolaFormularza();
$pole->ustawTyp('text');
$pole->ustawNazwa('login');
$pole->ustawLabel('Login');
$formularz->dodajPoleFormularza($pole);

$pole = new DanePolaFormularza();
$pole->ustawTyp('text');
$pole->ustawNazwa('telefon');
$pole->ustawLabel('Telefon');
$formularz->dodajPoleFormularza($pole);

$pole = new DanePolaFormularza();
$pole->ustawTyp('text');
$pole->ustawNazwa('email');
$pole->ustawLabel('Email');
$formularz->dodajPoleFormularza($pole);

$pole = new DanePolaFormularza();
$pole->ustawTyp('hidden');
$pole->ustawNazwa('id');
$formularz->dodajPoleFormularza($pole);

$pole = new DanePolaFormularza();
$pole->ustawTyp('submit');
$pole->ustawNazwa('submit');
$pole->ustawLabel('Zapisz');
$formularz->dodajPoleFormularza($pole);

echo $layoutStrony->przygotujSekcje(
    $formularz->pobierzFormularz()
);

echo $layoutStrony->przygotujListePrzyciskow(
    [
        ['label' => 'Lista klientów', 'link' => 'lista_klientow.php', 'styl' => 'danger'],
    ]
);

echo $layoutStrony->przygotujStopke();