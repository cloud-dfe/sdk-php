<?php

require_once(__DIR__. "/../../bootstrap.php");

use CloudDfe\SdkPHP\Nfcom;

try {
    $params = [
        "token" => "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbXAiOiJ0b2tlbl9leGVtcGxvIiwidXNyIjoidGsiLCJ0cCI6InRrIn0.Tva_viCMCeG3nkRYmi_RcJ6BtSzui60kdzIsuq5X-sQ",
        "ambiente" => Nfcom::AMBIENTE_HOMOLOGACAO,
        "options" => [
            "debug" => false,
            "timeout" => 60,
            "port" => 443,
            "http_version" => CURL_HTTP_VERSION_NONE
        ]
    ];
    $nfcom = new Nfcom($params);

    $payload = [
        "xml" => base64_encode(file_get_contents("caminho_do_arquivo.xml"))
    ];
    $resp = $nfcom->importa($payload);

    echo "<pre>";
    print_r($resp);
    echo "</pre>";

} catch (\Exception $e) {
    echo $e->getMessage();
}
