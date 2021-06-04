<?php

require_once(__DIR__ . '/../../bootstrap.php');

use CloudDfe\SdkC\Dfe;

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
        "periodo" => "2020-10",
        "data" => "2020-10-15",
        "cnpj" => "06338788000127"
    ];
    $resp = $dfe->buscaCte($payload);

    echo "<pre>";
    print_r($resp);
    echo "</pre>";

} catch (\Exception $e) {
    echo $e->getMessage();
}
