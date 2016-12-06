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
$pon = fopen('updatetoken.txt', "r");
        while (!feof($pon)) {
            $linha = fgets($pon, 100);
        }
define('API_URL', 'https://api.telegram.org/bot' . $linha . '/');

class Send_mensage {
    public static function upload() {

        try {
            $URL =API_URL.'getUpdates';
            $update_response = file_get_contents($URL);
            $update = json_decode($update_response, true);
            //$var = count($update['result']) - 1;
            return $update;
        } catch (Exception $ex) {
            print "Error mensagem recebida!: " . $ex->getMessage() . "<br/>";
        }      
    }
    public static function sendcomados($id, $chat) {     
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
