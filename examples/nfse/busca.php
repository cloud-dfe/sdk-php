<?php

require_once(__DIR__ . '/../../bootstrap.php');

use CloudDfe\SdkC\Nfse;

/**
 * Este exemplo de uma chamada a API usando este SDK
 *
 * Este método recupera as NFSe registradas em nossa base de dados que atendam ao paramtros informados
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

    //dados para busca de NFSe
    $payload = [
        "numero_rps_inicial" => 1210,
        "numero_rps_final" => 1210,
        "serie_rps" => 1,
        "numero_nfse_inicial" => 1210,
        "numero_nfse_final" => 1210,
        "data_inicial" => "2019-12-01", // Autorização
        "data_final" => "2019-12-31",
        "cancel_inicial" => "2019-12-01", // Cancelamento
        "cancel_final" => "2019-12-31"
    ];
    $resp = $nfse->busca($payload);

    echo "<pre>";
    print_r($resp);
    echo "</pre>";

} catch (\Exception $e) {
    echo $e->getMessage();
}
