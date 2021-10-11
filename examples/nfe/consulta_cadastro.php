<?php

require_once(__DIR__ . '/../../bootstrap.php');

use CloudDfe\SdkPHP\Nfe;

/**
 * Este exemplo de uma chamada a API usando este SDK
 *
 * Este método tenta obter os dados de um CNPJ, CPF ou IE na SEFAZ indicada
 *
 * NOTA: Nem todas as SEFAZ possuem esse recurso
 * NOTA: Apenas CNPJs e IEs pertencentes a UF indicada podem retornar dados
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
    //informar somente um dos campos CNPJ, IE ou CPF
    //A UF é um campo obrigatório
    $resp = $nfe->cadastro([
        'uf' => 'SP',
        'cnpj' => '12345678901234',
        //'ie' => '123456789',
        //'cpf' => '12345678901'
    ]);

    echo "<pre>";
    print_r($resp);
    echo "</pre>";

} catch (\Exception $e) {
    echo $e->getMessage();
}
