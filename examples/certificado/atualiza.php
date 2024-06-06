<?php

require_once(__DIR__ . "/../../bootstrap.php");

use CloudDfe\SdkPHP\Certificado;

/**
 * Este exemplo de uma chamada a API usando este SDK
 *
 * Este método atualiza o certificado do emitente, enviando o novo certificado para substituir o anterior
 * vencido ou a vencer
 */
try {
    $params = [
        "token" => "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbXAiOiJ0b2tlbl9leGVtcGxvIiwidXNyIjoidGsiLCJ0cCI6InRrIn0.Tva_viCMCeG3nkRYmi_RcJ6BtSzui60kdzIsuq5X-sQ",
        "ambiente" => Certificado::AMBIENTE_HOMOLOGACAO,
        "options" => [
            "debug" => false,
            "timeout" => 60,
            "port" => 443,
            "http_version" => CURL_HTTP_VERSION_NONE
        ]
    ];
    $certificado = new Certificado($params);
    $payload = [
        "certificado" => base64_encode(file_get_contents("caminho_do_arquivo.pfx")),
        "senha" => "associacao"
    ];
    //os payloads são sempre ARRAYS
    $resp = $certificado->atualiza($payload);
    echo "<pre>";
    print_r($resp);
    echo "</pre>";
} catch (\Exception $e) {
    echo $e->getMessage();
}
