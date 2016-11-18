<?php

class recebendo_mensagem {

    public static function upload() {
        
        $pon = fopen('updatetoken.txt', "r");
    while (!feof($pon)) {
        $linha = fgets($pon, 200);
    }
        try {
            $URL = 'https://api.telegram.org/bot'.$linha.'/getUpdates';
            $requisicao = file_get_contents($URL);
            $resultado = json_decode($requisicao, true);
            $var = count($resultado['result']) - 1;

            return $resultado;
        } catch (Exception $ex) {
            print "Error mensagem recebida!: " . $ex->getMessage() . "<br/>";
        }
    }

}
