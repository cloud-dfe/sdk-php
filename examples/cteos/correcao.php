<?php

require_once(__DIR__ . '/../../bootstrap.php');

use CloudDfe\SdkC\CteOS;

try {
    $params = [
        'token' => 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbXAiOjcwLCJ1c3IiOiIyIiwidHAiOjIsImlhdCI6MTU4MDkzNzM3MH0.KvSUt2x8qcu4Rtp2XNTOINqR',
        'ambiente' => CteOS::AMBIENTE_HOMOLOGACAO,
        'options' => [
            'debug' => false,
        ]
    ];
    $cte = new CteOS($params);


    $payload = [
        'chave' => '41210222545265000108550010001010031384099675',
        'correcoes' => [
            [
                'grupo_corrigido' => 'ide',
                'campo_corrigido' => 'natureza_operacao',
                'valor_corrigido' => 'PRESTACAO DE SERVIÇO'
            ]
        ]
    ];
    $resp = $cte->correcao($payload);

    echo "<pre>";
    print_r($resp);
    echo "</pre>";

} catch (\Exception $e) {
    echo $e->getMessage();
}
