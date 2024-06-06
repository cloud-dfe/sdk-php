<?php

require_once(__DIR__. "/../../bootstrap.php");

use CloudDfe\SdkPHP\Nfce;

/**
 * Este exemplo de uma chamada a API usando este SDK
 *
 * Este método consulta o status da SEFAZ de NFe
 *
 */
try {
    $params = [
        "token" => "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbXAiOiJ0b2tlbl9leGVtcGxvIiwidXNyIjoidGsiLCJ0cCI6InRrIn0.Tva_viCMCeG3nkRYmi_RcJ6BtSzui60kdzIsuq5X-sQ",
        "ambiente" => Nfce::AMBIENTE_HOMOLOGACAO,
        "options" => [
            "debug" => false,
            "timeout" => 60,
            "port" => 443,
            "http_version" => CURL_HTTP_VERSION_NONE
        ]
    ];
    $nfe = new Nfce($params);

    $payload = [
        "xml" => base64_encode(file_get_contents("caminho_do_arquivo.xml"))
    ];
    $resp = $nfe->importa($payload);

    echo "<pre>";
    print_r($resp);
    echo "</pre>";

} catch (\Exception $e) {
    echo $e->getMessage();
}
