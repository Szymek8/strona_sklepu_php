<?php

abstract class Rekord
{
    private $dbh;
    private $nazwaTabeli = '';

    public function __construct(\PDO $dbh)
    {
        $this->dbh = $dbh;
    }

    protected function pobierzDb(): PDO
    {
        return $this->dbh;
    }

    protected function ustawNazweTabeli(string $nazwaTabeli): void
    {
        $this->nazwaTabeli = $nazwaTabeli;
    }

    protected function pobierzNazweTabeli(): string
    {
        return $this->nazwaTabeli;
    }

    public function pobierzDane(int $idRekordu): array
    {
        if($idRekordu <= 0){
            throw new Exception('Błędne ID rekordu');
        }
        $sql = 'SELECT * FROM ' . $this->pobierzNazweTabeli() . ' WHERE id = :id';
        $statement = $this->pobierzDb()->prepare($sql);
        $statement->bindParam(':id', $idRekordu);
        $statement->execute();
        return $statement->fetch();
    }

    public function usun(int $idRekordu): int
    {
        $sql = 'DELETE FROM ' . $this->pobierzNazweTabeli() . ' WHERE id = :id';
        $statement = $this->pobierzDb()->prepare($sql);
        $statement->bindParam(':id', $idRekordu);
        $statement->execute();
        return $statement->rowCount();
    }

}