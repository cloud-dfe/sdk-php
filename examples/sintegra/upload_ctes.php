<?php

require_once(__DIR__ . '/../../bootstrap.php');

use CloudDfe\SdkC\Sintegra;
/**
 * Este exemplo de uma chamada a API usando este SDK
 *
 * Este método solicita e consulta a situação do processamento do Sintegra
 *
 * NOTA: Nao existe ambiente de HOMOLOGAÇÃO, as chamadas deverão ser feita ao ambiente de PRODUÇÃO
 * NOTA: o arquivo ZIP deve ser indicado com o PATH real e completo e estar acessível ao PHP
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

    //informar tipo e o periodo a que se referem os dados contidos no arquivo zip
    $payload = [
        'ano' => 2021,
        'mes' => 2,
        'tipo' => 'cte',
        'arquivo' => __DIR__.'/ctes_2021_01.zip'
    ];
    //os payloads são sempre ARRAYS
    $resp = $sintegra->upload($payload);

    echo "<pre>";
    print_r($resp);
    echo "</pre>";

} catch (\Exception $e) {
    echo $e->getMessage();
}
