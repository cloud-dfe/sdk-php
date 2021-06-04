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


    $resp = $cte->busca([
        "numero_inicial" => 1710,
        "numero_final" => 101002,
        "serie" => 1,
        //"data_inicial" => "2019-12-01",
        //"data_final" => "2019-12-31",
        //"cancel_inicial" => "2019-12-01", // Cancelamento
        //"cancel_final" => "2019-12-31"
    ]);

    echo "<pre>";
    print_r($resp);
    echo "</pre>";

} catch (\Exception $e) {
    echo $e->getMessage();
}
