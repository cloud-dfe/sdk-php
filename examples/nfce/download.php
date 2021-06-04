<?php

require_once(__DIR__ . '/../../bootstrap.php');

use CloudDfe\SdkC\Base;
use CloudDfe\SdkC\Nfce;

try {
    $params = [
        'token' => 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbXAiOjcwLCJ1c3IiOiIyIiwidHAiOjIsImlhdCI6MTU4MDkzNzM3MH0.KvSUt2x8qcu4Rtp2XNTOINqR',
        'ambiente' => Nfce::AMBIENTE_HOMOLOGACAO,
        'options' => [
            'debug' => false,
        ]
    ];
    $nfce = new Nfce($params);

    $payload = [
        'chave' => '41210222545265000108650010001010031163412322'
    ];
    $resp = $nfce->download($payload);

    echo "<pre>";
    print_r($resp);
    echo "</pre>";

} catch (\Exception $e) {
    echo $e->getMessage();
}
