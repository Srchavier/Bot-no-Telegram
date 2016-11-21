<?php

// eduardo rodrigues fernandes
//  Matricula:201611386 
//..//
require './Data.php';
require './enviar_mensagem.php';
require './tokenn.php';
require './recebendo_mensagem.php';
require './sorteador_numero.php';
require './BD_txt_Mysql.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$file = 'updateId.txt';
$str = file_get_contents($file);
$arrUpdateId = explode(',', $str);

$resultado = recebendo_mensagem::upload();


$var = count($resultado['result']) - 1;

for ($x = $var; $x > 0; $x--) {

    $data = $resultado ['result'][$x]['message']['date'];
    echo "<br>";
    $dataTratada = Data::tratarData($data);
    echo $dataTratada;
    echo "<br>";
    $nome = $resultado['result'][$x] ['message']['from']['first_name'];
    echo $nome . " : ";
    $texto = $resultado['result'][$x]['message']['text'];
    echo $texto;
    $id = $resultado ['result'] [$x] ['message']['chat']['id'];
    echo "<br>";
    $updateId = $resultado ['result'][$x]['update_id']; //salva os id no arquivo text
    echo "<br>";


//------------------------------------BD--------------------------------------
    $var = null;//inicia null para bd sem sort
    $lot= null;
//---------------------------------------------------------------------------------------------------------

    if ($texto == '/start') {
        $texto1 = preg_match('/^.*\/start$/', $texto);
        if (!in_array($updateId, $arrUpdateId)) {
            if ($texto1 == 1) {
                $mesangem = 'Parabens ' . $nome . ' acaba de ser regrista!!!!';
                mensagem::sendMessage($id, $mesangem); //ativa a funcao mensagem.
            }
        }
    } else if ($texto == '/megasena') {
        $texto1 = preg_match('/^.*\/megasena$/', $texto);
        if (!in_array($updateId, $arrUpdateId)) {
            if ($texto1 == 1) {
                print ("Seus Numeros da mega : ");
                echo "<br>";
                $sort = sorteador_numero::sort_meg_sen(); //ativa a funçao sorteador
                mensagem::sendMessage($id, $sort); //ativa a funcao mensagem.
                echo $sort; //tras o resultando.
                $var = $sort;
                echo "<br>";
            }
        }
    } else if ($texto == '/Lotofacil') {
        $texto1 = preg_match('/^.*\/Lotofacil$/', $texto);
        if (!in_array($updateId, $arrUpdateId)) {
            if ($texto1 == 1) {
                print ("Seus Numeros da Lotofacil : ");
                echo "<br>";
               $men_lot_facil = sorteador_numero::sort_lot_facil(); //ativa a funçao sorteador
                mensagem::sendMessage($id, $men_lot_facil); //ativa a funcao mensagem.
                echo $men_lot_facil; //tras o resultando.
                $lot = $men_lot_facil;
                echo "<br>";
               
            }
        }
    }
    if (!in_array($updateId, $arrUpdateId)) {
        $conteudo = "$updateId,$nome,$texto,$var \r\n";
        BD_txt_Mysql::BD_txt($conteudo, $updateId);
        file_put_contents($file, $updateId . ',', FILE_APPEND | LOCK_EX);
    }

    //-----------------------------------BD Mysql GUARDANDO OS LOGS--------------------------------------------
    $ins = "insert into" . " BD_resposta(id,nome,mens_rec,num_mega,num_lotf)" . " VALUES(?, ?, ?, ?, ?)";
    $BD = BD_txt_Mysql::connect()->prepare($ins);
    $BD->bindParam(1, $updateId);
    $BD->bindParam(2, $nome);
    $BD->bindParam(3, $texto);
    $BD->bindParam(4, $var);
    $BD->bindParam(5, $lot);
    $BD->execute();
    //------------------------------------BD Txt caso o primeiro der erro--------------------------------------
    
}
?>