<?php

require_once(__DIR__. '/../../bootstrap.php');

use CloudDfe\SdkPHP\Nfe;

/**
 * Este exemplo de uma chamada a API usando este SDK e a URL de contingência da API
 *
 * Este método consulta o status da SEFAZ de NFe
 *
 * NOTA: esta contingência é outra URL que poderá ser usado para acesar a API CloudDFe em caso de problemas com o dominio
 * principal. Mas não tem nada haver com a contingência da SEFAZ !!
 *
 * NOTA: a nossa URL de contingência é exclusiva para o ambiente de produção
 *
 */
try {
    $params = [
        'token' => 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbXAiOjEyOCwidXNyIjoiOCIsInRwIjoyLCJpYXQiOjE1ODU2OTg4NTR9.3fKfDCeiQM78AecAZy6gtcMvYFsWYHjvQXqRd8pAAzA',
        'ambiente' => Nfe::AMBIENTE_PRODUCAO,
        'options' => [
            'debug' => false,
            'timeout' => 60,
            'port' => 443,
            'http_version' => CURL_HTTP_VERSION_NONE,
            'contingencia' => false
        ]
    ];
    $nfe = new Nfe($params);


    $resp = $nfe->status();

    echo "<pre>";
    print_r($resp);
    echo "</pre>";

} catch (\Exception $e) {
    echo $e->getMessage();
}
