<?php
require('init.php');

try {
    $kurs = new Klient($dbh);
    if (isset($_POST['id']) && $_POST['imie'] && $_POST['nazwisko']) {
        $kurs->zmien(intval($_POST['id']), $_POST);
    }
    $daneKlienta = $kurs->pobierzDane(intval($_GET['id']));
} catch (Throwable $wyjatek) {
    Info::blad($wyjatek);
}

if (empty($daneKlienta)) {
    header('Location: lista_klientow.php');
}

echo $layoutStrony->przygotujNaglowek('edycja klienta: '.$daneKlienta['imie'].' '.$daneKlienta['nazwisko']);
echo $layoutStrony->przygotujTytul('Edycja klienta');

$formularz = new Formularz();
$formularz->ustawLink('');
$formularz->ustawMetoda('post');

$pole = new DanePolaFormularza();
$pole->ustawTyp('text');
$pole->ustawNazwa('imie');
$pole->ustawLabel('Imię');
$pole->ustawWartosc($daneKlienta['imie']);
$formularz->dodajPoleFormularza($pole);

$pole = new DanePolaFormularza();
$pole->ustawTyp('text');
$pole->ustawNazwa('nazwisko');
$pole->ustawLabel('Nazwisko');
$pole->ustawWartosc($daneKlienta['nazwisko']);
$formularz->dodajPoleFormularza($pole);

$pole = new DanePolaFormularza();
$pole->ustawTyp('text');
$pole->ustawNazwa('login');
$pole->ustawLabel('Login');
$pole->ustawWartosc($daneKlienta['login']);
$formularz->dodajPoleFormularza($pole);

$pole = new DanePolaFormularza();
$pole->ustawTyp('text');
$pole->ustawNazwa('telefon');
$pole->ustawLabel('Telefon');
$pole->ustawWartosc($daneKlienta['telefon']);
$formularz->dodajPoleFormularza($pole);

$pole = new DanePolaFormularza();
$pole->ustawTyp('text');
$pole->ustawNazwa('email');
$pole->ustawLabel('Email');
$pole->ustawWartosc($daneKlienta['email']);
$formularz->dodajPoleFormularza($pole);

$pole = new DanePolaFormularza();
$pole->ustawTyp('hidden');
$pole->ustawNazwa('id');
$pole->ustawWartosc($daneKlienta['id']);
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
        ['label' => 'Szczegóły klienta', 'link' => 'klient_szczegoly.php?id=' . $daneKlienta['id'], 'styl' => 'success'],
    ]
);

echo $layoutStrony->przygotujStopke();