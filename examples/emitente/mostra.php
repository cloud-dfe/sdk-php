<?php

require_once(__DIR__ .'/../../bootstrap.php');

use CloudDfe\SdkC\Emitente;
/**
 * Este exemplo de uma chamada a API usando este SDK
 *
 * Este método mostra os dados atuais no emitente em nossa base de dados.
 */
try {
    $params = [
        'ambiente' => Emitente::AMBIENTE_HOMOLOGACAO,
        //'token' => 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbXAiOjcwLCJ1c3IiOiIyIiwidHAiOjIsImlhdCI6MTU4MDkzNzM3MH0.KvSUt2x8qcu4Rtp2XNTOINqR-3c5V8iyITDmLoUF_SE',
        'token' => 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbXAiOjE0MSwidXNyIjo5MywidHAiOjIsImlhdCI6MTYxMjgwOTg4MX0.JsIeapmoYc-CrtmUSapZFRD-WWtY50bivn3nzVw34eA',
        'options' => [
            'debug' => false,
        ]
    ];
    $emitente = new Emitente($params);

    $resp = $emitente->mostra();

    echo "<pre>";
    print_r($resp);
    echo "</pre>";

} catch (\Exception $e) {
    echo $e->getMessage();
}
