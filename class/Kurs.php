<?php

class Kurs extends Rekord implements RekordDanych
{

    public function __construct(\PDO $dbh){
        $this->ustawNazweTabeli('kursy');
        parent::__construct($dbh);

    }

    public function dodaj(array $daneDoDodania): int
    {
        $sql = 'INSERT INTO kursy
        (nazwa, kod_kursu, cena_netto, cena_brutto, opis, status, data_dodania)
        VALUES
        (:nazwa, :kod_kursu, :cena_netto, :cena_brutto, :opis, :status, NOW());';
        $statement = $this->pobierzDb()->prepare($sql);
        $statement->bindParam(':nazwa', $daneDoDodania['nazwa'], PDO::PARAM_STR, 128);
        $statement->bindParam(':kod_kursu', $daneDoDodania['kod_kursu'], PDO::PARAM_STR, 8);
        $statement->bindParam(':cena_netto', $daneDoDodania['cena_netto'], PDO::PARAM_STR, 11);
        $statement->bindParam(':cena_brutto', $daneDoDodania['cena_brutto'], PDO::PARAM_STR, 11);
        $statement->bindParam(':status', $daneDoDodania['status'], PDO::PARAM_STR, 1);
        $statement->bindParam(':opis', $daneDoDodania['opis'], PDO::PARAM_STR);
        $statement->execute();
        return $this->pobierzDb()->lastInsertId();
    }

    public function zmien(int $idRekordu, array $daneDoZmiany): int
    {
        $sql = 'UPDATE '.$this->pobierzNazweTabeli().' 
        SET 
            nazwa = :nazwa,
            kod_kursu = :kod_kursu,
            cena_netto = :cena_netto,
            cena_brutto = :cena_brutto,
            opis = :opis,
            status = :status,
            data_modyfikacji = NOW()
        WHERE 
            id = :id;';

        $statement = $this->pobierzDb()->prepare($sql);
        $statement->bindParam(':nazwa', $daneDoZmiany['nazwa'], PDO::PARAM_STR, 128);
        $statement->bindParam(':kod_kursu', $daneDoZmiany['kod_kursu'], PDO::PARAM_STR, 8);
        $statement->bindParam(':cena_netto', $daneDoZmiany['cena_netto'], PDO::PARAM_STR, 11);
        $statement->bindParam(':cena_brutto', $daneDoZmiany['cena_brutto'], PDO::PARAM_STR, 11);
        $statement->bindParam(':opis', $daneDoZmiany['opis'], PDO::PARAM_STR);
        $statement->bindParam(':status', $daneDoZmiany['status'], PDO::PARAM_INT, 1);
        $statement->bindParam(':id', $idRekordu, PDO::PARAM_INT, 11);
        $statement->execute();
        return $statement->rowCount();
    }


}