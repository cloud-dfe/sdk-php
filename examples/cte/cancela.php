<?php

require_once(__DIR__ . '/../../bootstrap.php');


use CloudDfe\SdkPHP\Cte;

/**
 * Este exemplo de uma chamada a API usando este SDK
 *
 * Este método solicita o cancelamento de um CTe.
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
    $payload = [
        'chave' => '50210613188739000110570010000000661560432035',
        'justificativa' => 'teste de cancelamento'
    ];
    $resp = $cte->cancela($payload);
    echo "<pre>";
    print_r($resp);
    echo "</pre>";
} catch (\Exception $e) {
    echo $e->getMessage();
}
