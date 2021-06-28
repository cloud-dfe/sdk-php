<?php

require_once(__DIR__ . '/../../bootstrap.php');

use CloudDfe\SdkPHP\Nfse;

/**
 * Este exemplo de uma chamada a API usando este SDK
 *
 * Este método recupera o backup da NFSe emitidas para o período informado
 *
 * NOTA: os backup tem a finalidade de garantir mais uma camada de segurança na guarda dos documentos para a softhouse.
 * NOTA: os backups são gerados no primeiro domingo de cada mês, e não estarão disponíveis até serem gerados.
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

    //informar o período desejado de backup
    $payload = [
        'ano' => '2021',
        'mes' => '2'
    ];
    $resp = $nfse->backup($payload);

    echo "<pre>";
    print_r($resp);
    echo "</pre>";

} catch (\Exception $e) {
    echo $e->getMessage();
}
