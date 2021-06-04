<?php

require_once(__DIR__ . '/../../bootstrap.php');

use CloudDfe\SdkC\Cte;

/**
 * Este exemplo de uma chamada a API usando este SDK
 *
 * Este método gera a representação do CTe em PDF (DACTE)
 *
 * NOTA: este é um EXTRA fornecido pela CloudDFe e os pdf não serão modificados para atender a necessidades particulares de clientes.
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
        'chave' => '41210222545265000108570010001010031384099675'
    ];
    //os payloads são sempre ARRAYS
    $resp = $cte->pdf($payload);

    echo "<pre>";
    print_r($resp);
    echo "</pre>";

} catch (\Exception $e) {
    echo $e->getMessage();
}
