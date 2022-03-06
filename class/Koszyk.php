<?php

class Koszyk
{
    private $identyfikatorKoszyka = '';
    private $dbh;

    public function __construct(\PDO $dbh)
    {
        $this->dbh = $dbh;
    }

    protected function pobierzDb(): PDO
    {
        return $this->dbh;
    }

    protected function pobierzIdentyfikatorKoszyka(): string
    {
        return $this->identyfikatorKoszyka;
    }

    public function ustawIdentyfikatorKoszyka(string $identyfikatorKoszyka): void
    {
        $this->identyfikatorKoszyka = $identyfikatorKoszyka;
    }

    public function dodaj(int $idKursu, int $ilosc): void
    {
        if($this->czyKursIstniejeWKoszyku($idKursu)){
            $this->aktualizujWBazie($idKursu, $ilosc);
        }else{
            $this->dodajDoBazy($idKursu, $ilosc);
        }

    }

    public function czyscKoszyk(): void
    {
        $sql = 'DELETE FROM koszyk 
        WHERE identyfikator = :identyfikator';
        $statement = $this->pobierzDb()->prepare($sql);
        $identyfikatorKoszyka = $this->pobierzIdentyfikatorKoszyka();
        $statement->bindParam(':identyfikator', $identyfikatorKoszyka, PDO::PARAM_STR, 40);
        $statement->execute();
    }

    public function zmien(int $idKursu, int $zmianaIlosci): void
    {
        $this->aktualizujWBazie($idKursu, $zmianaIlosci);
    }

    public function usun(int $idKursu): void
    {
        $sql = 'DELETE FROM koszyk 
       WHERE 
           identyfikator = :identyfikator AND 
           id_kursu = :id_kursu';
        $statement = $this->pobierzDb()->prepare($sql);
        $identyfikatorKoszyka = $this->pobierzIdentyfikatorKoszyka();
        $statement->bindParam(':identyfikator', $identyfikatorKoszyka, PDO::PARAM_STR, 40);
        $statement->bindParam(':id_kursu', $idKursu, PDO::PARAM_INT, 11);
        $statement->execute();
    }

    private function czyKursIstniejeWKoszyku(int $idKursu): bool
    {
        $sql = 'SELECT id FROM koszyk 
          WHERE 
            identyfikator = :identyfikator AND 
            id_kursu = :id_kursu';
        $statement = $this->pobierzDb()->prepare($sql);
        $identyfikatorKoszyka = $this->pobierzIdentyfikatorKoszyka();
        $statement->bindParam(':identyfikator', $identyfikatorKoszyka, PDO::PARAM_STR, 40);
        $statement->bindParam(':id_kursu', $idKursu, PDO::PARAM_INT, 11);
        $statement->execute();
        return !empty($statement->fetch());
    }

    private function dodajDoBazy(int $idKursu, int $ilosc): int
    {
        $sql = 'INSERT INTO koszyk
        (identyfikator, id_kursu, ilosc, data_dodania)
        VALUES
        (:identyfikator, :id_kursu, :ilosc, NOW());';
        $statement = $this->pobierzDb()->prepare($sql);
        $identyfikatorKoszyka = $this->pobierzIdentyfikatorKoszyka();
        $statement->bindParam(':identyfikator', $identyfikatorKoszyka, PDO::PARAM_STR, 40);
        $statement->bindParam(':id_kursu', $idKursu, PDO::PARAM_INT, 11);
        $statement->bindParam(':ilosc', $ilosc, PDO::PARAM_INT, 11);
        $statement->execute();
        return $this->pobierzDb()->lastInsertId();
    }

    private function aktualizujWBazie(int $idKursu, int $ilosc): int
    {
        $sql = 'UPDATE koszyk 
        SET 
            ilosc = ilosc + :ilosc
        WHERE 
            identyfikator = :identyfikator AND 
            id_kursu = :id_kursu;';
        $statement = $this->pobierzDb()->prepare($sql);
        $statement->bindParam(':ilosc', $ilosc, PDO::PARAM_INT, 11);
        $identyfikatorKoszyka = $this->pobierzIdentyfikatorKoszyka();
        $statement->bindParam(':identyfikator', $identyfikatorKoszyka, PDO::PARAM_STR, 40);
        $statement->bindParam(':id_kursu', $idKursu, PDO::PARAM_INT, 11);
        $statement->execute();
        return $statement->rowCount();
    }

}