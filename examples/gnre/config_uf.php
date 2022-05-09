<?php

require_once(__DIR__ . '/../../bootstrap.php');

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
        'token' => 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbXAiOjgsInVzciI6NiwidHAiOjIsImlhdCI6MTU3MjU0NzkyOX0.lTh431ejzV13RybU9Mck2OrgQnofhsePwvZttn3kZig',
        'ambiente' => Gnre::AMBIENTE_HOMOLOGACAO,
        'options' => [
            'debug' => false,
            'timeout' => 60,
            'port' => 443,
            'http_version' => CURL_HTTP_VERSION_NONE
        ]
    ];
    $gnre = new Gnre($params);
    $payload = [
        "uf_favoverida" => "RR",
        "codigo_receita" => null,
        "curier" => null
    ];
    $resp = $gnre->configUf($payload);
    echo "<pre>";
    print_r($resp);
    echo "</pre>";
} catch (\Exception $e) {
    echo $e->getMessage();
}
