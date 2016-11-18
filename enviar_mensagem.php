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
class mensagem {
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
}
