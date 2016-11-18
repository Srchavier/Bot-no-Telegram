<?php

// eduardo rodrigues fernandes
//  Matricula:201611386 
//..//
require './Data.php';
require './BD_telegam.php';
require './enviar_mensagem.php';
require './tokenn.php';
require './recebendo_mensagem.php';
require './sorteador_numero.php';


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
    $updateId = $resultado ['result'][$x]['update_id'];//salva os id no arquivo text
    echo "<br>";
//-----------------------------------BD GUARDANDO OS LOGS--------------------------------------------
    $ins = "insert into" . " BD_resposta(id,nome,mensagem)" . " VALUES(?, ?, ?)";
    $stmt = BD_telegam::connect()->prepare($ins);
    $stmt->bindParam(1, $updateId);
    $stmt->bindParam(2, $nome);
    $stmt->bindParam(3, $texto);
    $stmt->execute();
    
//----------------------------------------------------------------------------------------------------
    
    if ($texto == '/start') {
        $texto1 = preg_match('/^.*\/start$/', $texto);
        if (!in_array($updateId, $arrUpdateId)) {
            if ($texto1 == 1) {
                $mesangem = 'Parabens ' . $nome . ' acaba de ser regrista!!!!';
                mensagem::sendMessage($id, $mesangem); //ativa a funcao mensagem.
                file_put_contents($file, $updateId . ',', FILE_APPEND | LOCK_EX);
            }
        }
    } else if ($texto == '/megasena') {
        $texto1 = preg_match('/^.*\/megasena$/', $texto);
        if (!in_array($updateId, $arrUpdateId)) {
            if ($texto1 == 1) {
                print ("Seus Numeros da mega : ");
                echo "<br>";
                $sort=  sorteador_numero::sorteador();//ativa a funçaosorteador
                mensagem::sendMessage($id, $sort); //ativa a funcao mensagem.
                echo $sort; //tras o resultando.
                file_put_contents($file, $updateId . ',', FILE_APPEND);
                echo "<br>";
            }
        }
    }
}



