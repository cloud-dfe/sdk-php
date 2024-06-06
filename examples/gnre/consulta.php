<?php

require_once(__DIR__ . "/../../bootstrap.php");

use CloudDfe\SdkPHP\Gnre;
/**
 * Este exemplo de uma chamada a API usando este SDK
 *
 * Este método consulta a situação de uma GNRe na nossa base de dados, é realizada após a criação da GNRe (processo ASSINCRONO) e em caso de sucesso serão retornados os dados da CTE autorizada.
 *
 * Porém em caso de falha o GNRe será removido de nossa base de dados para que assim que os dados incorretos sejam corrigidos pelo emitente ele posa criar outro CTe.
 */
try {
    $params = [
        "token" => "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbXAiOiJ0b2tlbl9leGVtcGxvIiwidXNyIjoidGsiLCJ0cCI6InRrIn0.Tva_viCMCeG3nkRYmi_RcJ6BtSzui60kdzIsuq5X-sQ",
        "ambiente" => Gnre::AMBIENTE_HOMOLOGACAO,
        "options" => [
            "debug" => false,
            "timeout" => 60,
            "port" => 443,
            "http_version" => CURL_HTTP_VERSION_NONE
        ]
    ];
    $gnre = new Gnre($params);
    $payload = [
        "chave" => "50000000000000000000000000000000000000000000"
    ];
    $resp = $gnre->consulta($payload);
    echo "<pre>";
    print_r($resp);
    echo "</pre>";
} catch (\Exception $e) {
    echo $e->getMessage();
}
