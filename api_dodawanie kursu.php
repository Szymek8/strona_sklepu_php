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