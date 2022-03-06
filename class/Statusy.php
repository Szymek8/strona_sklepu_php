<?php

class Statusy
{
    public static function pobierzStatusy(): array
    {
        return [
            ['value'=>'0', 'label' => 'nieaktywny'],
            ['value'=>'1', 'label' => 'aktywny'],
            ['value'=>'2', 'label' => 'szkic'],
            ['value'=>'3', 'label' => 'wstrzymany'],
            ['value'=>'4', 'label' => 'do akceptacji'],

        ];
    }
}