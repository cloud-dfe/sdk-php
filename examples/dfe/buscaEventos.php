<?php

require_once(__DIR__ . '/../../bootstrap.php');

use CloudDfe\SdkPHP\Dfe;
/**
 * Este exemplo de uma chamada a API usando este SDK
 *
 * Este metodo busca todos os eventos vinculados a chave de acesso informada
 */
try {
    $params = [
        'token' => 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbXAiOjEyOCwidXNyIjoyLCJ0cCI6MiwiaWF0IjoxNjI0NDgwMDA3fQ.r2H33r0hjWl9jmD97UTgJz_n2QargK0lpJ_vciz_0xY',
        'ambiente' => Dfe::AMBIENTE_HOMOLOGACAO,
        'options' => [
            'debug' => false,
            'timeout' => 60,
            'port' => 443,
            'http_version' => CURL_HTTP_VERSION_NONE
        ]
    ];
    $dfe = new Dfe($params);

    $payload = [
        "chave" => "41190806338788000127570010000010011537233885",
    ];
    $resp = $dfe->eventos($payload);

    echo "<pre>";
    print_r($resp);
    echo "</pre>";

} catch (\Exception $e) {
    echo $e->getMessage();
}
