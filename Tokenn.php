<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Tokenn
 *
 * @author Eduardo
 */
class Tokenn {

    public static function tokenin() {
        for($i =0;$i>1;$i++){
        $tokenn = fopen('updatetoken.txt', "r");
        while (!feof($tokenn)) {
            $linha = fgets($tokenn, 4096);
        }
            return $linha;
            print_r($linha);
        }
    }

}
