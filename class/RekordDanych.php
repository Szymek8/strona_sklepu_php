<?php

interface RekordDanych
{
    public function dodaj(array $daneDoDodania): int;

    public function zmien(int $idRekordu, array $daneDoZmiany): int;

    public function pobierzDane(int $idRekordu): array;

    public function usun(int $idRekordu): int;
}