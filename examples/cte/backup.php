<?php

require_once(__DIR__ . '/../../bootstrap.php');

use CloudDfe\SdkPHP\Cte;

/**
 * Este exemplo de uma chamada a API usando este SDK
 *
 * Este método recupera o backup da CTe emitidas para o período informado
 *
 * NOTA: os backup tem a finalidade de garantir mais uma camada de segurança na guarda dos documentos para a softhouse.
 * NOTA: os backups são gerados no primeiro domingo de cada mês, e não estarão disponíveis até serem gerados.
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
        'ano' => '2021',
        'mes' => '2'
    ];
    //os payloads são sempre ARRAYS
    $resp = $cte->backup($payload);

    echo "<pre>";
    print_r($resp);
    echo "</pre>";

} catch (\Exception $e) {
    echo $e->getMessage();
}
