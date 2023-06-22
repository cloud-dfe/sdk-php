<?php

require_once(__DIR__ . '/../../bootstrap.php');

use CloudDfe\SdkPHP\Averbacao;

/**
 * Este exemplo de uma chamada a API usando este SDK
 *
 * Este método averbação na ATM usando um xml de documento
 */
try {
    $params = [
        'token' => 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbXAiOjgsInVzciI6NiwidHAiOjIsImlhdCI6MTU3MjU0NzkyOX0.lTh431ejzV13RybU9Mck2OrgQnofhsePwvZttn3kZig',
        'ambiente' => Averbacao::AMBIENTE_HOMOLOGACAO,
        'options' => [
            'debug' => false,
            'timeout' => 60,
            'port' => 443,
            'http_version' => CURL_HTTP_VERSION_NONE
        ]
    ];
    $averbacao = new Averbacao($params);
    $payload = [
        "xml" => base64_encode(file_get_contents('/home/Downloads/41200627954257000139570260000000121705491695-procCTe.xml')),
        "usuario" => "login",
        "senha" => "senha",
        "codigo" => "codigo",
        "chave" => ""
    ];
    //os payloads são sempre ARRAYS
    $resp = $averbacao->atm($payload);
    echo "<pre>";
    print_r($resp);
    echo "</pre>";
} catch (\Exception $e) {
    echo $e->getMessage();
}
