<?php

require_once(__DIR__ . '/../../bootstrap.php');

use CloudDfe\SdkC\Mdfe;

try {
    $params = [
        'token' => 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbXAiOjcwLCJ1c3IiOiIyIiwidHAiOjIsImlhdCI6MTU4MDkzNzM3MH0.KvSUt2x8qcu4Rtp2XNTOINqR',
        'ambiente' => Mdfe::AMBIENTE_HOMOLOGACAO,
        'options' => [
            'debug' => false,
        ]
    ];
    $mdfe = new Mdfe($params);

    $payload = [
        'chave' => '41210222545265000108580010001010031384099675',
        'nome' => 'JOAO',
        'cpf' => '01234567890'
    ];
    $resp = $mdfe->condutor($payload);

    echo "<pre>";
    print_r($resp);
    echo "</pre>";

} catch (\Exception $e) {
    echo $e->getMessage();
}
