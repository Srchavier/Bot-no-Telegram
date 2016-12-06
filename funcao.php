<?php


class funcao {
 
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
public static function sort_meg_sen(){
         for ($w = 1; $w <= 6; $w++) {
                    $n[$w - 1] = str_pad(rand(1, 60), 2, '0', STR_PAD_LEFT);
                }
                sort($n);
                $resultadomegasena = implode(' - ', $n);
                
                return $resultadomegasena;
                
                
    }
      public static function sort_quin(){
         for ($w = 1; $w <= 5; $w++) {
                    $n[$w - 1] = str_pad(rand(1, 25), 2, '0', STR_PAD_LEFT);
                }
                sort($n);
                $resultlot = implode(' - ', $n);
                return $resultlot;         
    }
}
?>