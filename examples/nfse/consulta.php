<?php

require_once(__DIR__ . '/../../bootstrap.php');

use CloudDfe\SdkPHP\Nfse;

/**
 * Este exemplo de uma chamada a API usando este SDK
 *
 * Este método recupera os dados de uma NFSe
 *
 * NOTA: ao executar esse metodo pode ser retornado os dados da NFSe emitida com sucesso ou erros
 * no caso de erros o registro desse documento será deletado e assim que os erros forem corrigidos nova NFSe poderá ser
 * emitida usando o método cria
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
        'chave' => '35210669184612000188901080000000151508136464'
    ];
    $resp = $nfse->consulta($payload);

    echo "<pre>";
    print_r($resp);
    echo "</pre>";

} catch (\Exception $e) {
    echo $e->getMessage();
}
