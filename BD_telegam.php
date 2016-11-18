<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ConnectionFactory
 *
 * @author Eduardo
 */
class BD_telegam {

    public static function connect() {
        try {
            $dbh = new PDO("mysql:host=localhost;dbname=BD_telegram", "root", "");
            
            return $dbh;
        } catch (PDOException $ex) {
    print "Error!: " . $ex->getMessage() . "<br/>";
    die();
        }
    }
}