<?php

require_once(__DIR__ . '/../../bootstrap.php');

use CloudDfe\SdkC\Cte;
/**
 * Este exemplo de uma chamada a API usando este SDK
 *
 * Este método solicita a inutilização de faixa de numeros de CTe, usado quendo por algum motivo existem numeros de CTe "PULADOS" no sistema.
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
        'numero_inicial' => '101004',
        'numero_final' => '101004',
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
