<?php

class BD_txt_Mysql {

    public static function connect() {
        try {
            $dbh = new PDO("mysql:host=localhost;dbname=Script_telegram", "root", "");

            return $dbh;
        } catch (PDOException $ex) {
            print "Error!: " . $ex->getMessage() . "<br/>";
            die();
        }
    }

    public static function InsertBanco_dando($updateId, $nome, $texto) {
        $comando='0';
        switch ($texto) { case '/start':$comando = 1;break;
            case '/MegaSena':$comando = 2;break;
            case '/Quina':$comando = 3;break;
            case '/photo':$comando = 4;break;
            case 'mensagem':$comando = 5;break;
            
            default  :
                echo $texto;
        }
        $ins = "insert into" . " BD_resposta(uploadid,nome,mens_cod)" . " VALUES(?, ?, ?)";
        $BD = BD_txt_Mysql::connect()->prepare($ins);
        $BD->bindParam(1, $updateId);
        $BD->bindParam(2, $nome);
        $BD->bindParam(3, $comando);
        $BD->execute();
    }
    public static function recureraselect() {

        $sth = BD_txt_Mysql::connect()->prepare("SELECT uploadid from BD_resposta");
        $sth->execute();
          $result=array();
        try {
            while ($resulto = $sth->fetch(PDO::FETCH_OBJ)) {
                $result[] = $resulto->uploadid;
            }
            return $result;
        } catch (PDOException $e) {
            print $e->getMessage();
        }
    }

}

?>