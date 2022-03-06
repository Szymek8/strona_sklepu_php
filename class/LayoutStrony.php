<?php

class LayoutStrony
{
    public function przygotujNaglowek(string $tytulStrony): string
    {
        return '<!DOCTYPE html>
        <html lang="en">
        <head>
        <meta charset="UTF-8">
        <title>'.$tytulStrony.'</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
              integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link href="css/style.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        </head>
        <body>';
    }

    public function przygotujTytul(string $tytul):string
    {
        return $this->przygotujSekcje('<h1>'.$tytul.'</h1>');
    }

    public function przygotujStopke(): string
    {
        return '<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
        </body>
        </html>';
    }

    public function przygotujSekcje(string $htmlSekcji): string
    {
        return '<div class="container">'.$htmlSekcji.'</div>';
    }

    public function przygotujListePrzyciskow(array $listaPrzyciskow): string
    {
        $html = '<ul class="nav justify-content-center">';
        foreach ($listaPrzyciskow as $key => $przycisk){
            $html .= '<li class="nav-item">
                <a class="nav-link';
            if(!empty($przycisk['styl'])){
                $html .= ' link-'.$przycisk['styl'];
            }
            $html .= '" href="'.$przycisk['link'].'">'.$przycisk['label'].'</a>
            </li>';
        }
        $html .= '</ul>';
        return $this->przygotujSekcje($html);
    }
}