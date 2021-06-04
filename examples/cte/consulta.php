<?php

require_once(__DIR__ . '/../../bootstrap.php');

use CloudDfe\SdkC\Cte;
/**
 * Este exemplo de uma chamada a API usando este SDK
 *
 * Este método consulta a situação de uma CTe na nossa base de dados, é realizada após a criação da CTe (processo ASSINCRONO) e em caso de sucesso serão retornados os dados da CTE autorizada.
 *
 * Porém em caso de falha o CTe será removido de nossa base de dados para que assim que os dados incorretos sejam corrigidos pelo emitente ele posa criar outro CTe.
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
        'chave' => '41210222545265000108570010001010021121093113'
    ];

    //os payloads são sempre ARRAYS
    $resp = $cte->consulta($payload);

    echo "<pre>";
    print_r($resp);
    echo "</pre>";

} catch (\Exception $e) {
    echo $e->getMessage();
}
