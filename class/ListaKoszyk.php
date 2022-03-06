<?php

class ListaKoszyk implements ListaRekordow
{

    private $identyfikatorKoszyka = '';
    private $dbh;

    public function __construct(\PDO $dbh)
    {
        $this->dbh = $dbh;
    }

    protected function pobierzIdentyfikatorKoszyka(): string
    {
        return $this->identyfikatorKoszyka;
    }

    public function ustawIdentyfikatorKoszyka(string $identyfikatorKoszyka): void
    {
        $this->identyfikatorKoszyka = $identyfikatorKoszyka;
    }

    public function pobierzListe(): array
    {
        $this->usunPusteWpisy();

        $sth = $this->dbh->prepare("SELECT 
        ku.nazwa AS nazwa,
        ku.id AS id_kursu,
        ko.ilosc AS ilosc,
        ku.cena_netto * ko.ilosc AS cena_netto, 
        ku.cena_brutto * ko.ilosc AS cena_brutto
        FROM 
            koszyk as ko JOIN kursy as ku ON ko.id_kursu = ku.id
        WHERE
            identyfikator = :identyfikator
        ORDER BY 
            ku.nazwa ASC;");
        $identyfikatorKoszyka = $this->pobierzIdentyfikatorKoszyka();
        $sth->bindParam(':identyfikator', $identyfikatorKoszyka, PDO::PARAM_STR, 40);
        $sth->execute();
        return $sth->fetchAll();
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
            'Kurs',
            'Ilość',
            'Netto / Brutto',
            'Usuń',
        ];
    }

    private function przygotujRekordWyswietleniaWTabeli($rekord): array
    {
        $daneWKolumnach = [];
        $daneWKolumnach[] = '<a class="link-success" href="kurs_szczegoly.php?id='.$rekord['id_kursu'].'">'.$rekord['nazwa'].'</a>';
        $daneWKolumnach[] = '<a class="btn btn-secondary" href="koszyk.php?opcja=zmien&id_kursu='.$rekord['id_kursu'].'&ilosc=-1">-</a>
        '. $rekord['ilosc'] .'
        <a class="btn btn-secondary" href="koszyk.php?opcja=zmien&id_kursu='.$rekord['id_kursu'].'&ilosc=1">+</a>';
        $daneWKolumnach[] = $rekord['cena_netto'].' / '.$rekord['cena_brutto'];
        $daneWKolumnach[] = '<a class="btn btn-danger" href="koszyk.php?opcja=usun&id_kursu='.$rekord['id_kursu'].'" onclick="if(confirm(\'Czy chcesz usunąć kurs z koszyka?\')) return true; else return false;">usuń</td>';
        return $daneWKolumnach;
    }

    private function usunPusteWpisy(){
        $sql = 'DELETE FROM koszyk 
        WHERE identyfikator = :identyfikator AND ilosc <= 0';
        $statement = $this->dbh->prepare($sql);
        $identyfikatorKoszyka = $this->pobierzIdentyfikatorKoszyka();
        $statement->bindParam(':identyfikator', $identyfikatorKoszyka, PDO::PARAM_STR, 40);
        $statement->execute();
    }
}