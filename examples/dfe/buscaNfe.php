<?php

require_once(__DIR__ . '/../../bootstrap.php');

use CloudDfe\SdkPHP\Dfe;

try {
    $params = [
        'token' => 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbXAiOjEyOCwidXNyIjoyLCJ0cCI6MiwiaWF0IjoxNjI0NDgwMDA3fQ.r2H33r0hjWl9jmD97UTgJz_n2QargK0lpJ_vciz_0xY',
        'ambiente' => Dfe::AMBIENTE_PRODUCAO,
        'options' => [
            'debug' => false,
            'timeout' => 60,
            'port' => 443,
            'http_version' => CURL_HTTP_VERSION_NONE
        ]
    ];
    $dfe = new Dfe($params);

    $payload = [
        "periodo" => "2020-10",
        "data" => "2020-10-15",
        "cnpj" => "06338788000127"
    ];
    $resp = $dfe->buscaNfe($payload);

    echo "<pre>";
    print_r($resp);
    echo "</pre>";

    // exemplo de implementação
    if ($resp->sucesso) {
        foreach ($resp->docs as $doc) {
            $chave = $doc->chave;
        }

        foreach ($resp->eventos_proprios as $evento) {
            $chave = $evento->chave;
        }
    }

} catch (\Exception $e) {
    echo $e->getMessage();
}
