<?php

require_once(__DIR__ . "/../../bootstrap.php");

use CloudDfe\SdkPHP\Base;
use CloudDfe\SdkPHP\Nfe;

/**
 * Este exemplo de uma chamada a API usando este SDK
 *
 * Este método recupera o backup da NFe emitidas para o período informado
 *
 * NOTA: os backup tem a finalidade de garantir mais uma camada de segurança na guarda dos documentos para a softhouse.
 * NOTA: os backups são gerados no primeiro domingo de cada mês, e não estarão disponíveis até serem gerados.
 */
try {
    $params = [
        "token" => "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbXAiOiJ0b2tlbl9leGVtcGxvIiwidXNyIjoidGsiLCJ0cCI6InRrIn0.Tva_viCMCeG3nkRYmi_RcJ6BtSzui60kdzIsuq5X-sQ",
        "ambiente" => Nfe::AMBIENTE_HOMOLOGACAO,
        "options" => [
            "debug" => false,
            "timeout" => 60,
            "port" => 443,
            "http_version" => CURL_HTTP_VERSION_NONE
        ]
    ];
    $nfe = new Nfe($params);
    $payload = [
        //"numero_inicial" => 1710,
        //"numero_final" => 101002,
        //"serie" => 1,
        "data_inicial" => "2021-04-01",
        "data_final" => "2021-04-31",
        //"cancel_inicial" => "2019-12-01", // Cancelamento
        //"cancel_final" => "2019-12-31"
    ];
    //payload é sempre um ARRAY
    $resp = $nfe->busca($payload);

    echo "<pre>";
    print_r($resp);
    echo "</pre>";

} catch (\Exception $e) {
    echo $e->getMessage();
}
