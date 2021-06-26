<?php

require_once(__DIR__ . '/../../bootstrap.php');

use CloudDfe\SdkPHP\CteOS;
/**
 * Este exemplo de uma chamada a API usando este SDK
 *
 * Este método recupera o backup da NFe emitidas para o período informado
 *
 * NOTA: os backup tem a finalidade de garantir mais uma camada de segurança na guarda dos documentos para a softhouse.
 * NOTA: os backups são gerados no primeiro domingo de cada mês, e não estarão disponíveis até serem gerados.
 */
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
        'ano' => '2021',
        'mes' => '2'
    ];
    $resp = $cte->backup($payload);

    echo "<pre>";
    print_r($resp);
    echo "</pre>";

} catch (\Exception $e) {
    echo $e->getMessage();
}
