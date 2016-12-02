<?php

// eduardo rodrigues fernandes
//  Matricula:201611386 
//..//
require './Data.php';
require './Send_mensage.php';
require './sorteador_numero.php';
require 'BD_txt_Mysql.php';
//
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$file = 'updateId.txt';
$str = file_get_contents($file);
$arrUpdateId = explode(',', $str);

$resultado = Send_mensage::upload();


$var = count($resultado['result']) - 1;

for ($x = $var; $x > 0; $x--) {

    $data = $resultado['result'][$x]['message']['date'];
    $dataTratada = Data::tratarData($data);
    $nome = $resultado['result'][$x] ['message']['from']['first_name'];
    //$texto = $resultado['result'][$x]['message']['text'];
    $id = $resultado ['result'] [$x] ['message']['chat']['id'];
    $updateId = $resultado ['result'][$x]['update_id']; //salva os id no arquivo text

    if (isset($resultado['result'][$x]['message']['text'])) {

        $texto = $resultado['result'][$x]['message']['text'];

        if ($texto == '/start') {
            $dados = BD_txt_Mysql::recureraselect();
            if (!in_array($updateId, $dados) && !in_array($updateId, $arrUpdateId)) {
                if ($texto == '/start') {
                    $mes = 'Parabens ' . $nome . ' acaba de ser regrista!!!!';
                    Send_mensage::sendMessage($id, $mes); //ativa a funcao mensagem.
                    BD_txt_Mysql::InsertBanco_dando($updateId, $nome, $texto,$mes);
                    file_put_contents($file, $updateId . ',', FILE_APPEND | LOCK_EX);
                }
            }
        } else if ($texto == '/MegaSena') {
            $dados = BD_txt_Mysql::recureraselect();
            if (!in_array($updateId, $dados) && !in_array($updateId, $arrUpdateId)) {
                $sort = sorteador_numero::sort_meg_sen(); //ativa a funçao sorteador
                Send_mensage::sendMessage($id, $sort); //ativa a funcao mensagem.
                BD_txt_Mysql::InsertBanco_dando($updateId, $nome, $texto,$sort);
                file_put_contents($file, $updateId . ',', FILE_APPEND | LOCK_EX);
            }
        } else if (($texto == '/Quina')) {
            $dados = BD_txt_Mysql::recureraselect();
            if (!in_array($updateId, $dados) && !in_array($updateId, $arrUpdateId)) {
                $quin = sorteador_numero::sort_quin(); //ativa a funçao sorteador
                Send_mensage::sendMessage($id, $quin); //ativa a funcao mensagem.
                BD_txt_Mysql::InsertBanco_dando($updateId, $nome, $texto,$quin);
                file_put_contents($file, $updateId . ',', FILE_APPEND | LOCK_EX);
            }
        } else if($texto){
           $dados = BD_txt_Mysql::recureraselect();
         if (!in_array($updateId, $dados) && !in_array($updateId, $arrUpdateId)) {
            $re = "'Sr.'.$nome.' insira comados validos ex:/MegaSena ou /Quina '";
            Send_mensage::sendMessage($id, $re); //ativa a funcao mensagem.
            $mens = 'mensagem';
            BD_txt_Mysql::InsertBanco_dando($updateId, $nome, $mens,$re);
            file_put_contents($file, $updateId . ',', FILE_APPEND | LOCK_EX);
        }
        }

        echo $dataTratada . "<br>" . $nome . " : " . $texto . "<br>" . "<br>";
    }
}
?>
