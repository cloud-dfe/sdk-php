<?php

require_once(__DIR__ . '/../../bootstrap.php');

use CloudDfe\SdkPHP\Nfse;

/**
 * Este exemplo de uma chamada a API usando este SDK
 *
 * Este método solicita o cancelamento de uma NFSe
 *
 * NOTA: alguns provedores não possuem forma de cancelamento por webservice, nesses casos o cancelamento deverá ser
 * feito pela interface web provida pela prefeitura
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

    $payload = [
        "chave" => "50191213188739000110650010000012151581978542",
        "xml" => base64_encode(file_get_contents("/home/Downloads/nfse.xml"))
    ];
    $resp = $nfse->conflito($payload);

    echo "<pre>";
    print_r($resp);
    echo "</pre>";

} catch (\Exception $e) {
    echo $e->getMessage();
}
