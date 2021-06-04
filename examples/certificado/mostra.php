<?php

require_once(__DIR__ . '/../../bootstrap.php');

use CloudDfe\SdkC\Certificado;
/**
 * Este exemplo de uma chamada a API usando este SDK
 *
 * Este método retorna os dados do certificado atual do emitente
 */
try {
    $params = [
        'token' => 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbXAiOjcwLCJ1c3IiOiIyIiwidHAiOjIsImlhdCI6MTU4MDkzNzM3MH0.KvSUt2x8qcu4Rtp2XNTOINqR',
        'ambiente' => Certificado::AMBIENTE_HOMOLOGACAO,
        'options' => [
            'debug' => false,
        ]
    ];
    $certificado = new Certificado($params);

    $resp = $certificado->mostra();

    echo "<pre>";
    print_r($resp);
    echo "</pre>";

} catch (\Exception $e) {
    echo $e->getMessage();
}
