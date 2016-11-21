<?php

class BD_txt_Mysql {

    public static function BD_txt($conteudo, $updateId) {

        $arquivo = "BD_Backup.txt";
        $abrir = fopen("BD_Backup.txt", "a+");
       
            if (!fwrite($abrir, $conteudo)) {
                print "Erro escrevendo no arquivo ($arquivo)";
                exit;
            }
            fclose($abrir);
        
    }
    
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
?>