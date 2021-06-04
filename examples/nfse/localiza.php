<?php

require_once(__DIR__ . '/../../bootstrap.php');

use CloudDfe\SdkC\Nfse;

/**
 * Este exemplo de uma chamada a API usando este SDK
 *
 * Este método consulta a prefeitura em busca de NFSe que correspondam aos paramtros
 *
 * NOTA: cada provedor limita a forma de consulta e alguns não possuem esse método
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

    //indicar os dados da busca
    $payload = [
        "data_emissao_inicial" => "2020-01-01",
        "data_emissao_final" => "2020-01-31",
        "data_competencia_inicial" => "2020-01-01",
        "data_competencia_final" => "2020-01-31",
        "tomador_cnpj" => null,
        "tomador_cpf" => null,
        "tomador_im" => null,
        "nfse_numero" => null,
        "nfse_numero_inicial" => null,
        "nfse_numero_final" => null,
        "rps_numero" => null,
        "rps_serie" => null,
        "rps_tipo" => null,
        "pagina" => "1"
    ];
    $resp = $nfse->localiza($payload);

    echo "<pre>";
    print_r($resp);
    echo "</pre>";

} catch (\Exception $e) {
    echo $e->getMessage();
}
