<?php
require ('init.php');

$koszyk = new Koszyk($dbh);
$koszyk->ustawIdentyfikatorKoszyka(session_id());

if(isset($_GET['opcja'])){
    switch ($_GET['opcja']){
        case 'dodaj':
            $koszyk->dodaj($_GET['id_kursu'], $_GET['ilosc']);
            break;
       case 'zmien':
            $koszyk->zmien($_GET['id_kursu'], $_GET['ilosc']);
            break;
       case 'usun':
            $koszyk->usun($_GET['id_kursu']);
            break;
       case 'czysc_koszyk':
            $koszyk->czyscKoszyk();
            break;
    }
}

header('Location: lista_koszyk.php');
