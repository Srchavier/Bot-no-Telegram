<?php


class data {
 
    public static function tratarData($data) {
        date_default_timezone_set('America/Sao_Paulo');

        $dataFormato = 'd/m/y - (H:i:s)';

        $offsetUTC = date('Z');
        $offsetClean = (int) preg_replace('/[^0-9]/', '', $offsetUTC);
        if (preg_match('/^-.*/', $offsetUTC) == 1) {
            $dataTratada = $data - $offsetClean;
            return gmdate($dataFormato, $dataTratada);
        } else {
            $dataTratada = $data + $offsetClean;
            return gmdate($dataFormato, $dataTratada);
        }
    }

}

?>