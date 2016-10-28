<?php
$token ='249947960:AAHi7NCj1ONM1idNjM1pN2XZnc6Eq_vBWas';

$URL = 'https://api.telegram.org/bot249947960:AAHi7NCj1ONM1idNjM1pN2XZnc6Eq_vBWas/getUpdates';
$requisicao = file_get_contents($URL);
$resultado = json_decode($requisicao, true);
$var = count($resultado['result']) - 1;

$ids = array();
$y = 0;
for ($x = $var; $x > -1; $x--) {

    $date = $resultado ['result'][$x]['message']['date'];
    echo "<br>";

    print gmdate('d/m/Y-H:i', $date);

    echo "<br>";
    $nome = $resultado['result'][$x] ['message']['from']['first_name'];
    echo $nome . " : ";
    $texto = $resultado['result'][$x]['message']['text'];
    echo $texto;
    $id = $resultado ['result'] [$x] ['message']['chat']['id'];
    echo "<br>";
    echo "<br>";


    $id1[$y] = $id;
    $y = $y + 1;
}



$Array = array_unique($id1);

function sendMessage($ID, $menssagem) {
  // echo "sending message to " . $Array. "\n";
    
    $menssagem = urlencode($menssagem);
    $url = "https://api.telegram.org/bot249947960:AAHi7NCj1ONM1idNjM1pN2XZnc6Eq_vBWas/sendMessage?chat_id=" . $ID . "&text=" . $menssagem;
    
    
    
    $ch = curl_init();
    $optArray = array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_SSL_VERIFYPEER => false
    );
    curl_setopt_array($ch, $optArray);
    $result = curl_exec($ch);
    curl_close($ch);
}

if (isset($_GET['mensagem'])) {
    $menssagem = $_GET['mensagem'];

    foreach ($Array as $key => $value) {
        sendMessage($value, $menssagem);
    }
}