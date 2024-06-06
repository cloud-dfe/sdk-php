<?php

require_once(__DIR__ . "/../../bootstrap.php");

use CloudDfe\SdkPHP\Mdfe;

try {
    $params = [
        "token" => "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbXAiOiJ0b2tlbl9leGVtcGxvIiwidXNyIjoidGsiLCJ0cCI6InRrIn0.Tva_viCMCeG3nkRYmi_RcJ6BtSzui60kdzIsuq5X-sQ",
        "ambiente" => Mdfe::AMBIENTE_HOMOLOGACAO,
        "options" => [
            "debug" => false,
            "timeout" => 60,
            "port" => 443,
            "http_version" => CURL_HTTP_VERSION_NONE
        ]
    ];
    $mdfe = new Mdfe($params);

    $payload = [
        "chave" => "50000000000000000000000000000000000000000000",
        "codigo_municipio_carregamento" => "2408003",
        "nome_municipio_carregamento" => "Mossoró",
        "codigo_municipio_descarregamento" => "5200050",
        "nome_municipio_descarregamento" => "Abadia de Goiás",
        "chave_nfe" => "50000000000000000000000000000000000000000001"
    ];
    $resp = $mdfe->nfe($payload);

    echo "<pre>";
    print_r($resp);
    echo "</pre>";

} catch (\Exception $e) {
    echo $e->getMessage();
}
