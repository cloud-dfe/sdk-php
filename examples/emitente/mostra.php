<?php

require_once(__DIR__ .'/../../bootstrap.php');

use CloudDfe\SdkPHP\Emitente;
/**
 * Este exemplo de uma chamada a API usando este SDK
 *
 * Este método mostra os dados atuais no emitente em nossa base de dados.
 */
try {
    $params = [
        'token' => 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbXAiOjU0LCJ1c3IiOjIsInRwIjoyLCJpYXQiOjE1NzQyNjAyODB9.LfnKwlWiX0oJMrmUUDXeqpLpoz38LsavRDvY_q0PXD0',
        'ambiente' => Emitente::AMBIENTE_HOMOLOGACAO,
        'options' => [
            'debug' => false,
            'timeout' => 60,
            'port' => 443,
            'http_version' => CURL_HTTP_VERSION_NONE
        ]
    ];
    $emitente = new Emitente($params);

    $resp = $emitente->mostra();

    echo "<pre>";
    print_r($resp);
    echo "</pre>";

} catch (\Exception $e) {
    echo $e->getMessage();
}
