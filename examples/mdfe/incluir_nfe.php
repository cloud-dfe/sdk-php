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
        'chave' => '50191113188739000110580010000012141581978541',
        'codigo_municipio_carregamento' => '2408003',
        'nome_municipio_carregamento' => 'Mossoró',
        'codigo_municipio_descarregamento' => '5200050',
        'nome_municipio_descarregamento' => 'Abadia de Goiás',
        'chave_nfe' => '34255501343220005109556010100010641225557671'
    ];
    $resp = $mdfe->nfe($payload);

    echo "<pre>";
    print_r($resp);
    echo "</pre>";

} catch (\Exception $e) {
    echo $e->getMessage();
}
