<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of token
 *
 * @author Eduardo
 */
class token {
    public static function tratartoken($token){
        $ponteiro = fopen('updatetoken.txt', "r");
while (!feof($ponteiro)) {
    $linha = fgets($ponteiro, 4096);
        
    }
    
    $token=$linha;
    }
    
}
?>