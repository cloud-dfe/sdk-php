<?php

require_once(__DIR__ . '/../../bootstrap.php');

use CloudDfe\SdkC\Dfe;
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
        'token' => 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbXAiOjcwLCJ1c3IiOiIyIiwidHAiOjIsImlhdCI6MTU4MDkzNzM3MH0.KvSUt2x8qcu4Rtp2XNTOINqR',
        'ambiente' => Dfe::AMBIENTE_HOMOLOGACAO,
        'options' => [
            'debug' => false,
        ]
    ];
    $dfe = new Dfe($params);

    $payload = [
        "tipo" => "nfe", // nfe ou cte
        "ano" => "2020",
        "mes" => "10"
    ];
    $resp = $dfe->backup($payload);

    echo "<pre>";
    print_r($resp);
    echo "</pre>";

} catch (\Exception $e) {
    echo $e->getMessage();
}
