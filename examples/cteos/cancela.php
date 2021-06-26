<?php

require_once(__DIR__ . '/../../bootstrap.php');

use CloudDfe\SdkPHP\CteOS;

try {
    $params = [
        'token' => 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbXAiOjEyOCwidXNyIjoyLCJ0cCI6MiwiaWF0IjoxNjI0NDgwMDA3fQ.r2H33r0hjWl9jmD97UTgJz_n2QargK0lpJ_vciz_0xY',
        'ambiente' => CteOS::AMBIENTE_HOMOLOGACAO,
        'options' => [
            'debug' => false,
            'timeout' => 60,
            'port' => 443,
            'http_version' => CURL_HTTP_VERSION_NONE
        ]
    ];
    $cte = new CteOS($params);


    $payload = [
        'chave' => '41210222545265000108670010001010021121093113',
        'justificativa' => 'teste de cancelamento'
    ];
    $resp = $cte->cancela($payload);

    echo "<pre>";
    print_r($resp);
    echo "</pre>";

} catch (\Exception $e) {
    echo $e->getMessage();
}
