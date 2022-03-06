<?php

interface ListaRekordow
{
    public function pobierzListe(): array;

    public function pobierzWierszeDoTabeli(): array;

    public function pobierzNaglowkiDoTabeli(): array;
}