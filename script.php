<?php

// eduardo rodrigues fernandes
//  Matricula:201611386 
//..//
require './Data.php';
require './BD_telegam.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$ponteiro = fopen('updatetoken.txt', "r");
while (!feof($ponteiro)) {
    $linha = fgets($ponteiro, 4096);
}

$file = 'updateId.txt';
$str = file_get_contents($file);
$arrUpdateId = explode(',', $str);

function sendMessage($id, $texto) {
    $ponteiro = fopen('updatetoken.txt', "r");
    while (!feof($ponteiro)) {
        $linha = fgets($ponteiro, 4096);
    }
    $token = $linha;
    $url1 = 'https://api.telegram.org/bot' . $token . '/sendMessage?';
    file_get_contents($url1 . "chat_id=" . $id . "&text=" . $texto);
}

$URL = 'https://api.telegram.org/bot' . $linha . '/getUpdates';
$requisicao = file_get_contents($URL);
$resultado = json_decode($requisicao, true);
$var = count($resultado['result']) - 1;

$idsuniq = array();
$y = 0;
for ($x = $var; $x > -1; $x--) {

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
    $updateId = $resultado ['result'][$x]['update_id'];
    echo "<br>";


    $idsuniq[$y] = $id;
    $y = $y + 1;

    $ins = "insert into" . " BD_resposta(id,nome,mensagem)" . " VALUES(?, ?, ?)";
    $stmt = BD_telegam::connect()->prepare($ins);
    $stmt->bindParam(1, $updateId);
    $stmt->bindParam(2, $nome);
    $stmt->bindParam(3, $texto);
    $stmt->execute();

    $texto1 = preg_match('/^.*\/megasena$/', $texto);
    if (!in_array($updateId, $arrUpdateId)) {
        if ($texto1 == 1) {
            print ("Seus Numeros da mega : ");
            echo "<br>";

            for ($w = 1; $w <= 6; $w++) {
                $n[$w - 1] = str_pad(rand(1, 60), 2, '0', STR_PAD_LEFT);
            }
            sort($n);
            $resultadomegasena = implode(' - ', $n);
            $teste = sendMessage($id, $resultadomegasena);
            echo $resultadomegasena;
            file_put_contents($file, $updateId . ',', FILE_APPEND);
            echo "<br>";
        }
    }
}
