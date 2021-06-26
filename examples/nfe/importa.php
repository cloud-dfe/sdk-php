<?php

require_once(__DIR__. '/../../bootstrap.php');

use CloudDfe\SdkPHP\Nfe;

/**
 * Este exemplo de uma chamada a API usando este SDK
 *
 * Este método consulta o status da SEFAZ de NFe
 *
 */
try {
    $params = [
        'token' => 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbXAiOjcwLCJ1c3IiOiIyIiwidHAiOjIsImlhdCI6MTU4MDkzNzM3MH0.KvSUt2x8qcu4Rtp2XNTOINqR-3c5V8iyITDmLoUF_SE',
        'ambiente' => Nfe::AMBIENTE_HOMOLOGACAO,
        'options' => [
            'debug' => false,
            'timeout' => 60,
            'port' => 443,
            'http_version' => CURL_HTTP_VERSION_NONE
        ]
    ];
    $nfe = new Nfe($params);

    $payload = [
        'xml' => base64_encode(file_get_contents('/home/Downloads/35210615773448000115550550000049551000046896.xml'))
    ];
    $resp = $nfe->importa($payload);

    echo "<pre>";
    print_r($resp);
    echo "</pre>";

} catch (\Exception $e) {
    echo $e->getMessage();
}
