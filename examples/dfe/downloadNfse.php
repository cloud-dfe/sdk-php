<?php

require_once(__DIR__ . "/../../bootstrap.php");

use CloudDfe\SdkPHP\Dfe;

/**
 * Este exemplo de uma chamada a API usando este SDK
 *
 * Este metodo baixa uma NFSe tomada e já localizado em nossa base de dados
 */
try {
    $params = [
        "token" => "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbXAiOiJ0b2tlbl9leGVtcGxvIiwidXNyIjoidGsiLCJ0cCI6InRrIn0.Tva_viCMCeG3nkRYmi_RcJ6BtSzui60kdzIsuq5X-sQ",
        "ambiente" => Dfe::AMBIENTE_PRODUCAO,
        "options" => [
            "debug" => false,
            "timeout" => 60,
            "port" => 443,
            "http_version" => CURL_HTTP_VERSION_NONE
        ]
    ];
    $dfe = new Dfe($params);

    $payload = [
        "chave" => "50000000000000000000000000000000000000000000",
    ];
    $resp = $dfe->downloadNfse($payload);

    echo "<pre>";
    print_r($resp);
    echo "</pre>";

    // exemplo de implementação
    if ($resp->sucesso) {
        $xml = base64_decode($resp->doc->xml);
    }

} catch (\Exception $e) {
    echo $e->getMessage();
}
