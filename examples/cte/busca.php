<?php

require_once(__DIR__ . '/../../bootstrap.php');

use CloudDfe\SdkPHP\Cte;

/**
 * Este exemplo de uma chamada a API usando este SDK
 *
 * Este método realiza uma busca de CTe sobre nossa base de dados baseado nos critérios de busca fornecidos.
 */
try {
    $params = [
        'token' => 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbXAiOjgsInVzciI6NiwidHAiOjIsImlhdCI6MTU3MjU0NzkyOX0.lTh431ejzV13RybU9Mck2OrgQnofhsePwvZttn3kZig',
        'ambiente' => Cte::AMBIENTE_HOMOLOGACAO,
        'options' => [
            'debug' => false,
            'timeout' => 60,
            'port' => 443,
            'http_version' => CURL_HTTP_VERSION_NONE
        ]
    ];
    $cte = new Cte($params);
    $resp = $cte->busca([
        "numero_inicial" => 1214,
        "numero_final" => 101002,
        "serie" => 1,
        //"data_inicial" => "2019-12-01",
        //"data_final" => "2019-12-31",
        //"cancel_inicial" => "2019-12-01", // Cancelamento
        //"cancel_final" => "2019-12-31"
    ]);
    echo "<pre>";
    print_r($resp);
    echo "</pre>";
} catch (\Exception $e) {
    echo $e->getMessage();
}
