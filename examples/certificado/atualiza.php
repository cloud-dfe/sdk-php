<?php

require_once(__DIR__ . '/../../bootstrap.php');

use CloudDfe\SdkPHP\Certificado;

/**
 * Este exemplo de uma chamada a API usando este SDK
 *
 * Este método atualiza o certificado do emitente, enviando o novo certificado para substituir o anterior
 * vencido ou a vencer
 */
try {
    $params = [
        'token' => 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbXAiOjcwLCJ1c3IiOiIyIiwidHAiOjIsImlhdCI6MTU4MDkzNzM3MH0.KvSUt2x8qcu4Rtp2XNTOINqR-3c5V8iyITDmLoUF_SE',
        'ambiente' => Certificado::AMBIENTE_HOMOLOGACAO,
        'options' => [
            'debug' => false,
            'timeout' => 60,
            'port' => 443,
            'http_version' => CURL_HTTP_VERSION_NONE
        ]
    ];

    $certificado = new Certificado($params);

    $payload = [
        'certificado' => base64_encode(file_get_contents('expired_certificate.pfx')),
        'senha' => 'associacao'
    ];
    //os payloads são sempre ARRAYS
    $resp = $certificado->atualiza($payload);

    echo "<pre>";
    print_r($resp);
    echo "</pre>";

} catch (\Exception $e) {
    echo $e->getMessage();
}
