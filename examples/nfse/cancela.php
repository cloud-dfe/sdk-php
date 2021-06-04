<?php

require_once(__DIR__ . '/../../bootstrap.php');

use CloudDfe\SdkC\Nfse;

/**
 * Este exemplo de uma chamada a API usando este SDK
 *
 * Este método solicita o cancelamento de uma NFSe
 *
 * NOTA: alguns provedores não possuem forma de cancelamento por webservice, nesses casos o cancelamento deverá ser
 * feito pela interface web provida pela prefeitura
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

    $payload = [
        'chave' => '41210222545265000108550010001010021121093113',
        'justificativa' => 'teste de cancelamento'
    ];
    $resp = $nfse->cancela($payload);

    echo "<pre>";
    print_r($resp);
    echo "</pre>";

} catch (\Exception $e) {
    echo $e->getMessage();
}
