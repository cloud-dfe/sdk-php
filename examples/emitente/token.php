<?php

require_once(__DIR__ . '/../../bootstrap.php');

use CloudDfe\SdkC\Emitente;
/**
 * Este exemplo de uma chamada a API usando este SDK
 *
 * Este método renova o token do emitente, e o novo token retornado desativa o anterior.
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

    $resp = $emitente->token();

    echo "<pre>";
    print_r($resp);
    echo "</pre>";

} catch (\Exception $e) {
    echo $e->getMessage();
}
