<?php

class Klient extends Rekord implements RekordDanych
{

    public function __construct(\PDO $dbh){
        $this->ustawNazweTabeli('klienci');
        parent::__construct($dbh);

    }

    public function dodaj(array $daneDoDodania): int
    {
        $sql = 'INSERT INTO '.$this->pobierzNazweTabeli().'
        (login, haslo, imie, nazwisko, telefon, email, status, data_dodania)
        VALUES
        (:login, :haslo, :imie, :nazwisko, :telefon, :email, 1, NOW());';
        $statement = $this->pobierzDb()->prepare($sql);
        $statement->bindParam(':login', $daneDoDodania['login'], PDO::PARAM_STR, 32);
        $haslo = sha1($daneDoDodania['haslo']);
        $statement->bindParam(':haslo', $haslo, PDO::PARAM_STR, 40);
        $statement->bindParam(':imie', $daneDoDodania['imie'], PDO::PARAM_STR, 32);
        $statement->bindParam(':nazwisko', $daneDoDodania['nazwisko'], PDO::PARAM_STR, 64);
        $statement->bindParam(':telefon', $daneDoDodania['telefon'], PDO::PARAM_STR, 9);
        $statement->bindParam(':email', $daneDoDodania['email'], PDO::PARAM_STR, 64);
        $statement->execute();
        return $this->pobierzDb()->lastInsertId();
    }

    public function zmien(int $idRekordu, array $daneDoZmiany): int
    {
        $sql = 'UPDATE '.$this->pobierzNazweTabeli().' 
        SET 
            imie = :imie,
            nazwisko = :nazwisko,
            telefon = :telefon,
            email = :email
        WHERE 
            id = :id;';

        $statement = $this->pobierzDb()->prepare($sql);
        $statement->bindParam(':imie', $daneDoZmiany['imie'], PDO::PARAM_STR, 32);
        $statement->bindParam(':nazwisko', $daneDoZmiany['nazwisko'], PDO::PARAM_STR, 64);
        $statement->bindParam(':telefon', $daneDoZmiany['telefon'], PDO::PARAM_STR, 9);
        $statement->bindParam(':email', $daneDoZmiany['email'], PDO::PARAM_STR, 64);
        $statement->bindParam(':id', $idRekordu, PDO::PARAM_INT, 11);
        $statement->execute();
        return $statement->rowCount();
    }


}