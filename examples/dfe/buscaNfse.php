<?php

require_once(__DIR__ . "/../../bootstrap.php");

use CloudDfe\SdkPHP\Dfe;

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
        "periodo" => "2020-10",
        "data" => "2020-10-15",
        "cnpj" => "06338788000127"
    ];
    $resp = $dfe->buscaNfse($payload);

    echo "<pre>";
    print_r($resp);
    echo "</pre>";

    // exemplo de implementação
    if ($resp->sucesso) {
        foreach ($resp->docs as $doc) {
            $chave = $doc->chave;
        }
    }

} catch (\Exception $e) {
    echo $e->getMessage();
}
