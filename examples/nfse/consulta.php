<?php

require_once(__DIR__ . '/../../bootstrap.php');

use CloudDfe\SdkC\Nfse;

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
        'token' => 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbXAiOjcwLCJ1c3IiOiIyIiwidHAiOjIsImlhdCI6MTU4MDkzNzM3MH0.KvSUt2x8qcu4Rtp2XNTOINqR',
        'ambiente' => Nfse::AMBIENTE_HOMOLOGACAO,
        'options' => [
            'debug' => false,
        ]
    ];
    $nfse = new Nfse($params);

    $payload = [
        'chave' => '41210222545265000108550010001010031384099675'
    ];
    $resp = $nfse->consulta($payload);

    echo "<pre>";
    print_r($resp);
    echo "</pre>";

} catch (\Exception $e) {
    echo $e->getMessage();
}
