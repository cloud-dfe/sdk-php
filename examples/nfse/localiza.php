<?php

require_once(__DIR__ . "/../../bootstrap.php");

use CloudDfe\SdkPHP\Nfse;

/**
 * Este exemplo de uma chamada a API usando este SDK
 *
 * Este método consulta a prefeitura em busca de NFSe que correspondam aos paramtros
 *
 * NOTA: cada provedor limita a forma de consulta e alguns não possuem esse método
 */
try {
    $params = [
        "token" => "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbXAiOiJ0b2tlbl9leGVtcGxvIiwidXNyIjoidGsiLCJ0cCI6InRrIn0.Tva_viCMCeG3nkRYmi_RcJ6BtSzui60kdzIsuq5X-sQ",
        "ambiente" => Nfse::AMBIENTE_HOMOLOGACAO,
        "options" => [
            "debug" => false,
            "timeout" => 60,
            "port" => 443,
            "http_version" => CURL_HTTP_VERSION_NONE
        ]
    ];
    $nfse = new Nfse($params);

    //indicar os dados da busca
    $payload = [
        "data_emissao_inicial" => "2020-01-01",
        "data_emissao_final" => "2020-01-31",
        "data_competencia_inicial" => "2020-01-01",
        "data_competencia_final" => "2020-01-31",
        "tomador_cnpj" => null,
        "tomador_cpf" => null,
        "tomador_im" => null,
        "nfse_numero" => null,
        "nfse_numero_inicial" => null,
        "nfse_numero_final" => null,
        "rps_numero" => "15",
        "rps_serie" => "0",
        "rps_tipo" => "1",
        "pagina" => "1"
    ];
    $resp = $nfse->localiza($payload);

    echo "<pre>";
    print_r($resp);
    echo "</pre>";

} catch (\Exception $e) {
    echo $e->getMessage();
}
