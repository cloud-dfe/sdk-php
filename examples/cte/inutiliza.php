<?php

require_once(__DIR__ . '/../../bootstrap.php');

use CloudDfe\SdkPHP\Cte;
/**
 * Este exemplo de uma chamada a API usando este SDK
 *
 * Este método solicita a inutilização de faixa de numeros de CTe, usado quendo por algum motivo existem numeros de CTe "PULADOS" no sistema.
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
        'numero_inicial' => '67',
        'numero_final' => '67',
        'serie' => '1',
        'justificativa' => 'teste de inutilização'
    ];
    $resp = $cte->inutiliza($payload);

    echo "<pre>";
    print_r($resp);
    echo "</pre>";

} catch (\Exception $e) {
    echo $e->getMessage();
}
