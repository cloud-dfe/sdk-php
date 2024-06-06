<?php

require_once(__DIR__ . "/../../bootstrap.php");


use CloudDfe\SdkPHP\CteOS;

/**
 * Este exemplo de uma chamada a API usando este SDK
 *
 * Solicita o evento de manifestação de desacordo da operação
 */
try {
    $params = [
        "token" => "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbXAiOiJ0b2tlbl9leGVtcGxvIiwidXNyIjoidGsiLCJ0cCI6InRrIn0.Tva_viCMCeG3nkRYmi_RcJ6BtSzui60kdzIsuq5X-sQ",
        "ambiente" => CteOS::AMBIENTE_HOMOLOGACAO,
        "options" => [
            "debug" => false,
            "timeout" => 60,
            "port" => 443,
            "http_version" => CURL_HTTP_VERSION_NONE
        ]
    ];

    $cte = new CteOS($params);

    $payload = [
        "chave" => "50000000000000000000000000000000000000000000",
        "justificativa" => "nao contratei esse servico"
    ];
    $resp = $cte->desacordo($payload);

    echo "<pre>";
    print_r($resp);
    echo "</pre>";

} catch (\Exception $e) {
    echo $e->getMessage();
}
