<?php

require_once(__DIR__ . "/../../bootstrap.php");

use CloudDfe\SdkPHP\Averbacao;

/**
 * Este exemplo de uma chamada a API usando este SDK
 *
 * Este método averbação na ATM usando um xml de documento
 */
try {
    $params = [
        "token" => "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbXAiOiJ0b2tlbl9leGVtcGxvIiwidXNyIjoidGsiLCJ0cCI6InRrIn0.Tva_viCMCeG3nkRYmi_RcJ6BtSzui60kdzIsuq5X-sQ",
        "ambiente" => Averbacao::AMBIENTE_HOMOLOGACAO,
        "options" => [
            "debug" => false,
            "timeout" => 60,
            "port" => 443,
            "http_version" => CURL_HTTP_VERSION_NONE
        ]
    ];
    $averbacao = new Averbacao($params);
    $payload = [
        "xml" => base64_encode(file_get_contents("caminho_do_arquivo.xml")),
        "usuario" => "login",
        "senha" => "senha",
        "codigo" => "codigo",
        "chave" => "50000000000000000000000000000000000000000000"
    ];
    //os payloads são sempre ARRAYS
    $resp = $averbacao->atm($payload);
    echo "<pre>";
    print_r($resp);
    echo "</pre>";
} catch (\Exception $e) {
    echo $e->getMessage();
}
