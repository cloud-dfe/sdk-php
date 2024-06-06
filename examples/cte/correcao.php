<?php

require_once(__DIR__ . "/../../bootstrap.php");

use CloudDfe\SdkPHP\Cte;
/**
 * Este exemplo de uma chamada a API usando este SDK
 *
 * Este método solicita a criação de uma carta de correção
 */
try {
    $params = [
        "token" => "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbXAiOiJ0b2tlbl9leGVtcGxvIiwidXNyIjoidGsiLCJ0cCI6InRrIn0.Tva_viCMCeG3nkRYmi_RcJ6BtSzui60kdzIsuq5X-sQ",
        "ambiente" => Cte::AMBIENTE_HOMOLOGACAO,
        "options" => [
            "debug" => false,
            "timeout" => 60,
            "port" => 443,
            "http_version" => CURL_HTTP_VERSION_NONE
        ]
    ];
    $cte = new Cte($params);
    $payload = [
        "chave" => "50000000000000000000000000000000000000000000",
        "correcoes" => [
            [
                "grupo_corrigido" => "ide",
                "campo_corrigido" => "natOp",
                "valor_corrigido" => "PRESTACAO DE SERVIÇO"
            ]
        ]
    ];
    $resp = $cte->correcao($payload);
    echo "<pre>";
    print_r($resp);
    echo "</pre>";
} catch (\Exception $e) {
    echo $e->getMessage();
}
