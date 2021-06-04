<?php

require_once( __DIR__ . '/../../bootstrap.php');

use CloudDfe\SdkC\Sintegra;
/**
 * Este exemplo de uma chamada a API usando este SDK
 *
 * Este método consulta a situação dos arquivos enviado para processamento do Sintegra
 *
 * NOTA: Nao existe ambiente de HOMOLOGAÇÃO, as chamadas deverão ser feita ao ambiente de PRODUÇÃO
 */
try {
    $params = [
        'token' => 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbXAiOjcwLCJ1c3IiOiIyIiwidHAiOjIsImlhdCI6MTU4MDkzNzM3MH0.KvSUt2x8qcu4Rtp2XNTOINqR',
        'ambiente' => Sintegra::AMBIENTE_HOMOLOGACAO,
        'options' => [
            'debug' => false,
        ]
    ];
    $sintegra = new Sintegra($params);

    //informar a que período essa consulta se refere
    $payload = [
        'ano' => 2021,
        'mes' => 2
    ];
    //os payloads são sempre ARRAYS
    $resp = $sintegra->consultar($payload);

    echo "<pre>";
    print_r($resp);
    echo "</pre>";

} catch (\Exception $e) {
    echo $e->getMessage();
}
