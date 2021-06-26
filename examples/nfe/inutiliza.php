<?php

require_once(__DIR__ . '/../../bootstrap.php');

use CloudDfe\SdkPHP\Nfe;

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
        'token' => 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbXAiOjcwLCJ1c3IiOiIyIiwidHAiOjIsImlhdCI6MTU4MDkzNzM3MH0.KvSUt2x8qcu4Rtp2XNTOINqR-3c5V8iyITDmLoUF_SE',
        'ambiente' => Nfe::AMBIENTE_HOMOLOGACAO,
        'options' => [
            'debug' => false,
            'timeout' => 60,
            'port' => 443,
            'http_version' => CURL_HTTP_VERSION_NONE
        ]
    ];
    $nfe = new Nfe($params);
    //informar o período desejado de backup
    $payload = [
        'numero_inicial' => '101006',
        'numero_final' => '101006',
        'serie' => '1',
        'justificativa' => 'teste de inutilização'
    ];
    $resp = $nfe->inutiliza($payload);

    echo "<pre>";
    print_r($resp);
    echo "</pre>";

} catch (\Exception $e) {
    echo $e->getMessage();
}
