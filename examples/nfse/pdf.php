<?php

require_once(__DIR__ . '/../../bootstrap.php');

use CloudDfe\SdkC\Nfse;

/**
 * Este exemplo de uma chamada a API usando este SDK
 *
 * Este método recupera a representação da NFSe em PDF
 *
 * VIDE https://doc.cloud-dfe.com.br/v1/nfse/#!/1-2
 */
try {
    $params = [
        'token' => 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbXAiOjcwLCJ1c3IiOiIyIiwidHAiOjIsImlhdCI6MTU4MDkzNzM3MH0.KvSUt2x8qcu4Rtp2XNTOINqR',
        'ambiente' => Nfse::AMBIENTE_HOMOLOGACAO,
        'options' => [
            'debug' => false,
        ]
    ];
    $nfse = new Nfse($params);

    //indicar a chave da NFSe
    $payload = [
        'chave' => '41210222545265000108550010001010031384099675'
    ];
    $resp = $nfse->pdf($payload);

    echo "<pre>";
    print_r($resp);
    echo "</pre>";

} catch (\Exception $e) {
    echo $e->getMessage();
}
