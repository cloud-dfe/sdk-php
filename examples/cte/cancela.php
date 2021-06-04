<?php

require_once(__DIR__ . '/../../bootstrap.php');


use CloudDfe\SdkC\Cte;
/**
 * Este exemplo de uma chamada a API usando este SDK
 *
 * Este método solicita o cancelamento de um CTe.
 */
try {
    $params = [
        'token' => 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbXAiOjcwLCJ1c3IiOiIyIiwidHAiOjIsImlhdCI6MTU4MDkzNzM3MH0.KvSUt2x8qcu4Rtp2XNTOINqR',
        'ambiente' => Cte::AMBIENTE_HOMOLOGACAO,
        'options' => [
            'debug' => false,
        ]
    ];

    $cte = new Cte($params);

    $payload = [
        'chave' => '41210222545265000108570010001010021121093113',
        'justificativa' => 'teste de cancelamento'
    ];
    $resp = $cte->cancela($payload);

    echo "<pre>";
    print_r($resp);
    echo "</pre>";

} catch (\Exception $e) {
    echo $e->getMessage();
}
