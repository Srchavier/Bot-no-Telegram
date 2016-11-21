<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of newPHPClass
 *
 * @author Eduardo
 */
class sorteador_numero {
    //put your code here
    
    public static function sort_meg_sen(){
    
         for ($w = 1; $w <= 6; $w++) {
                    $n[$w - 1] = str_pad(rand(1, 60), 2, '0', STR_PAD_LEFT);
                }
                sort($n);
                $resultadomegasena = implode(' - ', $n);
                
                return $resultadomegasena;
                
                
    }
      public static function sort_lot_facil(){
    
         for ($w = 1; $w <= 5; $w++) {
                    $n[$w - 1] = str_pad(rand(1, 25), 2, '0', STR_PAD_LEFT);
                }
                sort($n);
                $resultlot = implode(' - ', $n);
                
                return $resultlot;
                
                
    }
    
}