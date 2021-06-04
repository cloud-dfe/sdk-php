<?php

require_once(__DIR__ . '/../../bootstrap.php');

use CloudDfe\SdkC\Dfe;
/**
 * Este exemplo de uma chamada a API usando este SDK
 *
 * Este metodo baixa um CTe destinado e já localizado em nossa base de dados
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
        "chave" => "41190806338788000127570010000010011537233885",
    ];
    $resp = $dfe->downloadCte($payload);

    echo "<pre>";
    print_r($resp);
    echo "</pre>";

} catch (\Exception $e) {
    echo $e->getMessage();
}
