<?php

class DanePolaFormularza
{
    private $typ = '';
    private $nazwa = '';
    private $label = '';
    private $wartosc = '';
    private $style = '';
    private $listaOpcji = [];

    public function pobierzTyp(): string
    {
        return $this->typ;
    }

    public function ustawTyp(string $typ): void
    {
        $this->typ = $typ;
    }

    public function pobierzNazwa(): string
    {
        return $this->nazwa;
    }

    public function ustawNazwa(string $nazwa): void
    {
        $this->nazwa = $nazwa;
    }

    public function pobierzLabel(): string
    {
        return $this->label;
    }

    public function ustawLabel(string $label): void
    {
        $this->label = $label;
    }

    public function pobierzWartosc(): string
    {
        return $this->wartosc;
    }

    public function ustawWartosc(string $wartosc): void
    {
        $this->wartosc = $wartosc;
    }

    public function ustawWartoscIZamienNaGrosze(string $wartosc): void
    {
        $this->wartosc = floatval($wartosc) * 100;
    }

    public function pobierzStyle(): string
    {
        return $this->style;
    }

    public function ustawStyle(string $style): void
    {
        $this->style = $style;
    }

    public function pobierzListaOpcji(): array
    {
        return $this->listaOpcji;
    }

    public function ustawListaOpcji(array $listaOpcji): void
    {
        $this->listaOpcji = $listaOpcji;
    }
}