<?php
require('init.php');

try {
    $daneKlienta = (new Klient($dbh))->pobierzDane(intval($_GET['id']));
} catch (Throwable $wyjatek) {
    Info::blad($wyjatek);
}

if (empty($daneKlienta)) {
    header('Location: lista_klientow.php');
}




echo $layoutStrony->przygotujNaglowek('Klient: '. $daneKlienta['imie'] . ' ' . $daneKlienta['nazwisko']);
echo $layoutStrony->przygotujTytul( $daneKlienta['imie'] . ' ' . $daneKlienta['nazwisko']);


echo $layoutStrony->przygotujSekcje(
    '<h3>id: ' . $daneKlienta['id'] . '</h3>
    <h3>login: ' . $daneKlienta['login'] . '</h3>
    <h3>email: ' . $daneKlienta['email'] . '</h3>'
);

echo $layoutStrony->przygotujListePrzyciskow(
    [
        ['label' => 'Lista klientów', 'link' => 'lista_klientow.php', 'styl' => 'danger'],
        ['label' => 'Edycja klienta', 'link' => 'klient_edycja.php?id=' . $daneKlienta['id'], 'styl' => 'success'],
    ]
);

echo $layoutStrony->przygotujStopke();
