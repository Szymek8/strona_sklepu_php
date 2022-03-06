<?php

class ListaKursow implements ListaRekordow
{
    private $dbh;

    public function __construct(\PDO $dbh)
    {
        $this->dbh = $dbh;
    }

    public function pobierzListe(): array
    {
        $sth = $this->dbh->prepare("SELECT 
        id, nazwa, cena_netto, cena_brutto, status 
        FROM kursy;");
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
            'Kurs',
            'Netto / Brutto',
            'Status',
            'Opcje',
            'Koszyk'
        ];
    }

    private function przygotujRekordWyswietleniaWTabeli($rekord): array
    {
        $daneWKolumnach = [];
        $daneWKolumnach[] = $rekord['id'];
        $daneWKolumnach[] = '<a class="link-success" href="kurs_szczegoly.php?id='.$rekord['id'].'">'.$rekord['nazwa'].'</a>';
        $daneWKolumnach[] = $rekord['cena_netto'].' / '.$rekord['cena_brutto'];
        $daneWKolumnach[] = $rekord['status'];
        $daneWKolumnach[] = '<a class="btn btn-warning" href="kurs_edycja.php?id='.$rekord['id'].'">edycja</a> 
        <a class="btn btn-danger" href="?del_id='.$rekord['id'].'" onclick="if(confirm(\'Czy chcesz usunąć wpis?\')) return true; else return false;">usuń</td>';
        $daneWKolumnach[] = '<a class="btn btn-primary" href="koszyk.php?opcja=dodaj&id_kursu='.$rekord['id'].'&ilosc=1">do koszyka</a>';
        return $daneWKolumnach;
    }
}