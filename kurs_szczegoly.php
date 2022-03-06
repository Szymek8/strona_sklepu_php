<?php
require('init.php');

try {
    $daneKursu = (new Kurs($dbh))->pobierzDane(intval($_GET['id']));
} catch (Throwable $wyjatek) {
    Info::blad($wyjatek);
}

if (empty($daneKursu)) {
    header('Location: lista_kursow.php');
}

echo $layoutStrony->przygotujNaglowek('Kurs: '.$daneKursu['nazwa']);
echo $layoutStrony->przygotujTytul($daneKursu['nazwa']);


echo $layoutStrony->przygotujSekcje(
    '<h3>id: ' . $daneKursu['id'] . '</h3>
    <h3>kod: ' . $daneKursu['kod_kursu'] . '</h3>
    <h3>netto: ' . $daneKursu['cena_netto'] . ' PLN</h3>
    <h3>brutto: ' . $daneKursu['cena_brutto'] . ' PLN</h3>
    <p>' . $daneKursu['opis'] . '</p>'

);




$formularz = new Formularz();
$formularz->ustawLink('koszyk.php');
$formularz->ustawMetoda('get');

$pole = new DanePolaFormularza();
$pole->ustawTyp('text');
$pole->ustawNazwa('ilosc');
$pole->ustawLabel('Ilość');
$pole->ustawWartosc(1);
$formularz->dodajPoleFormularza($pole);

$pole = new DanePolaFormularza();
$pole->ustawTyp('hidden');
$pole->ustawNazwa('id_kursu');
$pole->ustawWartosc($daneKursu['id']);
$formularz->dodajPoleFormularza($pole);

$pole = new DanePolaFormularza();
$pole->ustawTyp('hidden');
$pole->ustawNazwa('opcja');
$pole->ustawWartosc('dodaj');
$formularz->dodajPoleFormularza($pole);

$pole = new DanePolaFormularza();
$pole->ustawTyp('submit');
$pole->ustawNazwa('submit');
$pole->ustawLabel('Dodaj do koszyka');
$formularz->dodajPoleFormularza($pole);

echo $layoutStrony->przygotujSekcje(
    $formularz->pobierzFormularz()
);





echo $layoutStrony->przygotujListePrzyciskow(
    [
        ['label' => 'Lista kursów', 'link' => 'lista_kursow.php', 'styl' => 'danger'],
        ['label' => 'Edycja kursu', 'link' => 'kurs_edycja.php?id=' . $daneKursu['id'], 'styl' => 'success'],
    ]
);

echo $layoutStrony->przygotujStopke();

