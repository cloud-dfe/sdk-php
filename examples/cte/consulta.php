<?php

require_once(__DIR__ . '/../../bootstrap.php');

use CloudDfe\SdkPHP\Cte;
/**
 * Este exemplo de uma chamada a API usando este SDK
 *
 * Este método consulta a situação de uma CTe na nossa base de dados, é realizada após a criação da CTe (processo ASSINCRONO) e em caso de sucesso serão retornados os dados da CTE autorizada.
 *
 * Porém em caso de falha o CTe será removido de nossa base de dados para que assim que os dados incorretos sejam corrigidos pelo emitente ele posa criar outro CTe.
 */
try {
    $params = [
        'token' => 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbXAiOjgsInVzciI6NiwidHAiOjIsImlhdCI6MTU3MjU0NzkyOX0.lTh431ejzV13RybU9Mck2OrgQnofhsePwvZttn3kZig',
        'ambiente' => Cte::AMBIENTE_HOMOLOGACAO,
        'options' => [
            'debug' => false,
            'timeout' => 60,
            'port' => 443,
            'http_version' => CURL_HTTP_VERSION_NONE
        ]
    ];
    $cte = new Cte($params);
    $payload = [
        'chave' => '50210613188739000110570010000000641214766139'
    ];
    $resp = $cte->consulta($payload);
    echo "<pre>";
    print_r($resp);
    echo "</pre>";
} catch (\Exception $e) {
    echo $e->getMessage();
}
