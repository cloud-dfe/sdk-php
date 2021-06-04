<?php

require_once(__DIR__ . '/../../bootstrap.php');

use CloudDfe\SdkC\Emitente;
/**
 * Este exemplo de uma chamada a API usando este SDK
 *
 * Este método atualiza os dados do emitente e requer o TOKEN do próprio emitente para ser realizado.
 */
try {
    $params = [
        'ambiente' => Emitente::AMBIENTE_HOMOLOGACAO,
        'token' => 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbXAiOjcwLCJ1c3IiOiIyIiwidHAiOjIsImlhdCI6MTU4MDkzNzM3MH0.KvSUt2x8qcu4Rtp2XNTOINqR-3c5V8iyITDmLoUF_SE',
        'options' => [
            'debug' => false,
        ]
    ];
    $emitente = new Emitente($params);

    $payload = [
        'nome' => 'FAKE INDUSTRIA',
        'razao' => 'FAKE INDUSTRIA E COMERCIO LTDA'
    ];
    //os payloads são sempre ARRAYS
    $resp = $emitente->atualiza($payload);

    echo "<pre>";
    print_r($resp);
    echo "</pre>";

} catch (\Exception $e) {
    echo $e->getMessage();
}
