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
        'chave' => '41210222545265000108550010001010031384099675',
        'correcoes' => [
            [
                'grupo_corrigido' => 'ide',
                'campo_corrigido' => 'natureza_operacao',
                'valor_corrigido' => 'PRESTACAO DE SERVIÇO'
            ]
        ]
    ];
    $resp = $cte->correcao($payload);

    echo "<pre>";
    print_r($resp);
    echo "</pre>";

} catch (\Exception $e) {
    echo $e->getMessage();
}
