<?php 
    if (!isset($_GET['cep'])) {
        echo json_encode(array('erro' => true));
    }

    $cep = preg_replace("/[^0-9]/", "", $_GET['cep']);
    $url = "http://viacep.com.br/ws/$cep/json/";
    // request via curl
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);
    // parse json
    $data = json_decode($response, true);
    // return
    if (isset($data['erro'])) {
        echo json_encode(array('erro' => true));
    } else {
        echo json_encode($data);
    }
?>