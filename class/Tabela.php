<?php

class Tabela
{
    public function generujHtml(array $naglowkiKolumn, array $wiersze): string
    {
        $html = '<table class="table">';
        $html .= $this->przygotujNaglowkiTabeli($naglowkiKolumn);
        $html .= $this->przygotujWierszeTabeli($wiersze);
        $html .= '</table>';
        return $html;
    }

    private function przygotujNaglowkiTabeli(array $naglowkiKolumn): string
    {
        $html = '<thead>
        <tr>';
        foreach ($naglowkiKolumn as $key => $etykietaNaglowka){
            $html .= '<th scope="col">'.$etykietaNaglowka.'</th>';
        }
        $html .= '</tr>
        </thead>';
        return $html;
    }

    private function przygotujWierszeTabeli(array $wiersze): string
    {
        $html = '<tbody>';
        foreach($wiersze as $key => $wiersz){
            $html .= $this->przygotujWiersz($wiersz);
        }
        $html .= '</tbody>';
        return $html;
    }

    private function przygotujWiersz(array $wiersz): string
    {
        $html = '<tr>';
        foreach($wiersz as $key => $wartosc){
            $html .= '<td>'.$wartosc.'</td>';
        }
        $html .= '</tr>';
        return $html;
    }
}