<?php

class ListaKlientow implements ListaRekordow
{
    private $dbh;

    public function __construct(\PDO $dbh)
    {
        $this->dbh = $dbh;
    }

    public function pobierzListe(): array
    {
        $sth = $this->dbh->prepare("SELECT 
        id, login, status, imie, nazwisko, telefon, email 
        FROM klienci;");
        $sth->execute();
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    public function pobierzWierszeDoTabeli(): array
    {
        $wierszeDoTabeli = [];
        $rekordy = $this->pobierzListe();
        foreach ($rekordy as $key => $rekord){
            $wierszeDoTabeli[] = $this->przygotujRekordWyswietleniaWTabeli($rekord);
        }

        return $wierszeDoTabeli;
    }


    public function pobierzNaglowkiDoTabeli(): array
    {
        return [
            'ID',
            'Nazwisko i imię',
            'Login',
            'Telefon',
            'Email',
            'Status',
            'Edycja',
            'Usuń'
        ];
    }

    private function przygotujRekordWyswietleniaWTabeli($rekord): array
    {
        $daneWKolumnach = [];
        $daneWKolumnach[] = $rekord['id'];
        $daneWKolumnach[] = $rekord['nazwisko'].' '.$rekord['imie'];
        $daneWKolumnach[] = '<a class="link-success" href="klient_szczegoly.php?id='.$rekord['id'].'">'.$rekord['login'].'</a>';
        $daneWKolumnach[] = $rekord['telefon'];
        $daneWKolumnach[] = $rekord['email'];
        $daneWKolumnach[] = $rekord['status'];
        $daneWKolumnach[] = '<a class="btn btn-warning" href="klient_edycja.php?id='.$rekord['id'].'">edycja</a>';
        $daneWKolumnach[] = '<a class="btn btn-danger" href="?del_id='.$rekord['id'].'" onclick="if(confirm(\'Czy chcesz usunąć wpis?\')) return true; else return false;">usuń</td>';
        return $daneWKolumnach;
    }
}