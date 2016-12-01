<?php

class BD_txt_Mysql {

        public static function connect() {
        try {
            $dbh = new PDO("mysql:host=localhost;dbname=Scrip_telegram", "root", "");
            
            return $dbh;
        } catch (PDOException $ex) {
    print "Error!: " . $ex->getMessage() . "<br/>";
    die();
        }
    }

}
?>