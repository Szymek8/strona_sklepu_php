<?php

class Info
{
    public static function blad(Exception $wyjatek): string
    {
        $text = '';
        $text .= 'plik: '.$wyjatek->getFile().PHP_EOL;
        $text .= 'linia: '.$wyjatek->getLine().PHP_EOL;
        $text .= 'błąd: '.$wyjatek->getMessage().PHP_EOL;
        echo nl2br($text);
        exit();
    }
}