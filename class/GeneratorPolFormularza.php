<?php

class GeneratorPolFormularza
{
    public function generujPole(DanePolaFormularza $danePola): string
    {
        switch ($danePola->pobierzTyp()){
            case 'hidden':
                $html = $this->przygotujHidden($danePola);
                break;
            case 'submit':
                $html = $this->przygotujSubmit($danePola);
                break;
            case 'select':
                $html = $this->przygotujSelect($danePola);
                break;
            case 'text':
                $html = $this->przygotujInputText($danePola);
                break;
            case 'textarea':
                $html = $this->przygotujTextarea($danePola);
                break;
            default:
                throw new Exception('Nieobsługiwany typ pola formularza');
        }
        return $html;
    }

    private function przygotujSubmit(DanePolaFormularza $pole): string
    {
        return '<button type="submit" id="'.$pole->pobierzNazwa().'" 
        name="'.$pole->pobierzNazwa().'" class="btn btn-primary">'.$pole->pobierzLabel().'</button>';
    }

    private function przygotujInputText(DanePolaFormularza $pole): string
    {
        return '<div class="mb-3">
        <label for="'.$pole->pobierzNazwa().'" class="form-label">'.$pole->pobierzLabel().'</label>
        <input type="text" class="form-control" id="'.$pole->pobierzNazwa().'" name="'.$pole->pobierzNazwa().'" 
        value="'.$pole->pobierzWartosc().'">
        </div>';
    }

    private function przygotujTextarea(DanePolaFormularza $pole): string
    {
        return '<div class="mb-3">
        <label for="'.$pole->pobierzNazwa().'" class="form-label">'.$pole->pobierzLabel().'</label>
        <textarea class="form-control" id="'.$pole->pobierzNazwa().'" name="'.$pole->pobierzNazwa().'" 
        style="height: 100px">'.$pole->pobierzWartosc().'</textarea>
        </div>';
    }

    private function przygotujHidden(DanePolaFormularza $pole)
    {
        return '<input type="hidden" id="'.$pole->pobierzNazwa().'" name="'.$pole->pobierzNazwa().'" 
        value="'.$pole->pobierzWartosc().'">';
    }

    private function przygotujSelect(DanePolaFormularza $pole): string
    {
        $html = '<div class="mb-3">
        <label for="'.$pole->pobierzNazwa().'" class="form-label">'.$pole->pobierzLabel().'</label>';
        $html .= '<select class="form-select" id="'.$pole->pobierzNazwa().'" name="'.$pole->pobierzNazwa().'">';
        foreach ($pole->pobierzListaOpcji() as $key => $opcja){
            $html .= '<option value="'.$opcja['value'].'"';
            if($opcja['value'] == $pole->pobierzWartosc()){
                $html .= ' selected';
            }
            $html .= '>'.$opcja['label'].'</option>';
        }
        $html .= '</select>';
        $html .= '</div>';

        return $html;
    }
}