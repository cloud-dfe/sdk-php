<?php

require_once(__DIR__ . '/../../bootstrap.php');

use CloudDfe\SdkPHP\Mdfe;

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
    $mdfe = new Mdfe($params);

    $payload = [
        'chave' => '41210622545265000108580010000000261812504664',
        'codigo_municipio_carregamento' => '2408003',
        'nome_municipio_carregamento' => 'Mossoró',
        'codigo_municipio_descarregamento' => '5200050',
        'nome_municipio_descarregamento' => 'Abadia de Goiás',
        'chave_nfe' => '34255501343220005109556010100010641225557671'
    ];
    $resp = $mdfe->nfe($payload);

    echo "<pre>";
    print_r($resp);
    echo "</pre>";

} catch (\Exception $e) {
    echo $e->getMessage();
}
