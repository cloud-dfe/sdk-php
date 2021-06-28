<?php

require_once(__DIR__. '/../../bootstrap.php');

use CloudDfe\SdkPHP\Mdfe;

/**
 * Este exemplo de uma chamada a API usando este SDK
 *
 * Este método consulta o status da SEFAZ de NFe
 *
 */
try {
    $params = [
        'token' => 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbXAiOjcwLCJ1c3IiOiIyIiwidHAiOjIsImlhdCI6MTU4MDkzNzM3MH0.KvSUt2x8qcu4Rtp2XNTOINqR-3c5V8iyITDmLoUF_SE',
        'ambiente' => Mdfe::AMBIENTE_HOMOLOGACAO,
        'options' => [
            'debug' => false,
            'timeout' => 60,
            'port' => 443,
            'http_version' => CURL_HTTP_VERSION_NONE
        ]
    ];
    $nfe = new Mdfe($params);

    $payload = [
        'xml' => base64_encode(file_get_contents('/home/Downloads/41200879549135000160580260000004061987672979-mdfe.xml'))
    ];
    $resp = $nfe->importa($payload);

    echo "<pre>";
    print_r($resp);
    echo "</pre>";

} catch (\Exception $e) {
    echo $e->getMessage();
}
