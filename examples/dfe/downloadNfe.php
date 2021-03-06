<?php

require_once(__DIR__ . '/../../bootstrap.php');

use CloudDfe\SdkPHP\Dfe;

/**
 * Este exemplo de uma chamada a API usando este SDK
 *
 * Este metodo baixa uma NFe destinado e já localizado em nossa base de dados
 */
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
        "chave" => "41190806338788000127550010000010011537233885",
    ];
    $resp = $dfe->downloadNfe($payload);

    echo "<pre>";
    print_r($resp);
    echo "</pre>";

    // exemplo de implementação
    if ($resp->sucesso) {
        $xml = base64_decode($resp->doc->xml);
        $pdf = base64_decode($resp->doc->pdf);
    }

} catch (\Exception $e) {
    echo $e->getMessage();
}
