<?php
require('init.php');

try {
    $kurs = new Kurs($dbh);
    if (isset($_POST['id']) && $_POST['nazwa'] && $_POST['opis']) {
        $kurs->zmien(intval($_POST['id']), $_POST);
    }
    $daneKursu = $kurs->pobierzDane(intval($_GET['id']));
} catch (Throwable $wyjatek) {
    Info::blad($wyjatek);
}

if (empty($daneKursu)) {
    header('Location: lista_kursow.php');
}

echo $layoutStrony->przygotujNaglowek('edycja kursu: '.$daneKursu['nazwa']);
echo $layoutStrony->przygotujTytul('Edycja kursu');

$formularz = new Formularz();
$formularz->ustawLink('');
$formularz->ustawMetoda('post');

$pole = new DanePolaFormularza();
$pole->ustawTyp('text');
$pole->ustawNazwa('nazwa');
$pole->ustawLabel('Nazwa');
$pole->ustawWartosc($daneKursu['nazwa']);
$formularz->dodajPoleFormularza($pole);

$pole = new DanePolaFormularza();
$pole->ustawTyp('text');
$pole->ustawNazwa('kod_kursu');
$pole->ustawLabel('Kod kursu');
$pole->ustawWartosc($daneKursu['kod_kursu']);
$formularz->dodajPoleFormularza($pole);

$pole = new DanePolaFormularza();
$pole->ustawTyp('text');
$pole->ustawNazwa('cena_netto');
$pole->ustawLabel('Cena netto');
$pole->ustawWartosc($daneKursu['cena_netto']);
$formularz->dodajPoleFormularza($pole);

$pole = new DanePolaFormularza();
$pole->ustawTyp('text');
$pole->ustawNazwa('cena_brutto');
$pole->ustawLabel('Cena brutto');
$pole->ustawWartosc($daneKursu['cena_brutto']);
$formularz->dodajPoleFormularza($pole);

$pole = new DanePolaFormularza();
$pole->ustawTyp('textarea');
$pole->ustawNazwa('opis');
$pole->ustawLabel('Opis');
$pole->ustawWartosc($daneKursu['opis']);
$formularz->dodajPoleFormularza($pole);

$pole = new DanePolaFormularza();
$pole->ustawTyp('select');
$pole->ustawNazwa('status');
$pole->ustawLabel('Status');
$pole->ustawWartosc($daneKursu['status']);
$pole->ustawListaOpcji(Statusy::pobierzStatusy());
$formularz->dodajPoleFormularza($pole);

$pole = new DanePolaFormularza();
$pole->ustawTyp('hidden');
$pole->ustawNazwa('id');
$pole->ustawWartosc($daneKursu['id']);
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
        ['label' => 'Lista kursów', 'link' => 'lista_kursow.php', 'styl' => 'danger'],
        ['label' => 'Szczegóły kursu', 'link' => 'kurs_szczegoly.php?id=' . $daneKursu['id'], 'styl' => 'success'],
    ]
);

echo $layoutStrony->przygotujStopke();


