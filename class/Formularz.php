<?php

class Formularz
{
    private $metoda = 'post';
    private $link = '';
    private $polaFormularza = [];

    public function dodajPoleFormularza(DanePolaFormularza $danePola): void
    {
        $this->polaFormularza[] = $danePola;
    }
    private function pobierzPolaFormularza(): array
    {
        return $this->polaFormularza;
    }

    private function pobierzMetoda(): string
    {
        return $this->metoda;
    }

    public function ustawMetoda(string $metoda): void
    {
        $this->metoda = $metoda;
    }

    private function pobierzLink(): string
    {
        return $this->link;
    }

    public function ustawLink(string $link): void
    {
        $this->link = $link;
    }


    public function pobierzFormularz(): string
    {
        $html = '';
        $html .= $this->pobierzPoczatekFormularza();
        $html .= $this->generujPolaFormularza();
        $html .= $this->pobierzKoniecFormularza();
        return $html;
    }


    private function pobierzPoczatekFormularza(): string
    {
        return '<form method="' . $this->pobierzMetoda() . '" action="' . $this->pobierzLink() . '">';
    }

    private function pobierzKoniecFormularza(): string
    {
        return '</form>';
    }

    private function generujPolaFormularza(): string
    {
        $html = '';
        foreach ($this->pobierzPolaFormularza() as $key => $danePola)
        {
            $html .= $this->generujPole($danePola);
        }
        return $html;
    }

    private function generujPole(DanePolaFormularza $danePola): string
    {
        return (new GeneratorPolFormularza())->generujPole($danePola);
    }
}