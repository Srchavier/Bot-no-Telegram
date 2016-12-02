<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of mensagem
 *
 * @author Eduardo
 */
class Send_mensage {

    public static function sendMessage($id, $texto) {
        $pon = fopen('updatetoken.txt', "r");
        while (!feof($pon)) {
            $linha = fgets($pon, 200);
        }
        try {
            $url1 = 'https://api.telegram.org/bot' . $linha . '/sendMessage?';
            file_get_contents($url1 . "chat_id=" . $id . "&text=" . $texto);
        } catch (Exception $ex) {
            print "Error message envie!: " . $ex->getMessage() . "<br/>";
        }
    }

    public static function upload() {

        $pon = fopen('updatetoken.txt', "r");
        while (!feof($pon)) {
            $linha = fgets($pon, 200);
        }
        try {
            $URL = 'https://api.telegram.org/bot' . $linha . '/getUpdates';
            $requisicao = file_get_contents($URL);
            $resultado = json_decode($requisicao, true);
            $var = count($resultado['result']) - 1;

            return $resultado;
        } catch (Exception $ex) {
            print "Error mensagem recebida!: " . $ex->getMessage() . "<br/>";
        }
    }

    public static function sendcomados($id, $chat) {
         $pon = fopen('updatetoken.txt', "r");
        while (!feof($pon)) {
            $linha = fgets($pon, 200);
        }
        
        define('API_URL', 'https://api.telegram.org/bot' . $linha . '/');
        $options = array(
            'http' => array(
                'method' => 'POST',
                'content' => json_encode($chat),
                'header' => "Content-Type: application/json\r\n" .
                "Accept: application/json\r\n"
            )
        );
        $context = stream_context_create($options);
        file_get_contents(API_URL . $id, false, $context);
        
    }

}
