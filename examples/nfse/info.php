<?php

require_once(__DIR__ . '/../../bootstrap.php');

use CloudDfe\SdkPHP\Nfse;

/**
 * Este exemplo de uma chamada a API usando este SDK
 *
 * Este método recupera a representação da NFSe em PDF
 *
 * VIDE https://doc.cloud-dfe.com.br/v1/nfse/#!/1-2
 */
try {
    $params = [
        'token' => 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbXAiOjEyNSwidXNyIjoyLCJ0cCI6MiwiaWF0IjoxNjIzOTQwNjg5fQ.Ag3y6wTmiCFb9LExLcc57WfUnP34kQM8jj2Vx91DZL8',
        'ambiente' => Nfse::AMBIENTE_HOMOLOGACAO,
        'options' => [
            'debug' => false,
            'timeout' => 60,
            'port' => 443,
            'http_version' => CURL_HTTP_VERSION_NONE
        ]
    ];
    $nfse = new Nfse($params);

    //indicar a chave da NFSe
    $payload = [
        'ibge' => '4200101'
    ];
    $resp = $nfse->info($payload);

    echo "<pre>";
    print_r($resp);
    echo "</pre>";

} catch (\Exception $e) {
    echo $e->getMessage();
}
