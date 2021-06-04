<?php

require_once(__DIR__ . '/../../bootstrap.php');

use CloudDfe\SdkC\Nfse;

/**
 * Este exemplo de uma chamada a API usando este SDK
 *
 * Este método solicita a criação de uma NFSe, pode ser retornado sucesso com os dados da NFSe emitida ou erros
 * no caso de erros o registro dessa NFSe será deletado e assim que os erros forem corrigidos uma nova NFSe poderá ser criada
 *
 * NOTA: os dados necessários variam de acordo com o provedor de cada prefeitura
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

    //dados do RPS para emissão da NFSe
    $paylod = [
        "numero" => "1",
        "serie" => "0",
        "tipo" => "1",
        "status" => "1",
        "data_emissao" => "2017-12-27T17:43:14-03:00",
        "tomador" => [
            "cnpj" => "07504505000132",
            "cpf" => null,
            "im" => null,
            "razao_social" => "Acras Tecnologia da Informação LTDA",
            "endereco" => [
                "logradouro" => "Rua ABC",
                "numero" => "16",
                "complemento" => null,
                "bairro" => "Jardim America",
                "codigo_municipio" => "4119905",
                "uf" => "PR",
                "cep" => "81530900"
            ]
        ],
        "servico" => [
            "codigo_tributacao_municipio" => "10500",
            "discriminacao" => "Exemplo Serviço",
            "codigo_municipio" => "4119905",
            "valor_servicos" => "1.00",
            "valor_pis" => "1.00",
            "valor_cofins" => "1.00",
            "valor_inss" => "1.00",
            "valor_ir" => "1.00",
            "valor_csll" => "1.00",
            "valor_outras" => "1.00",
            "valor_aliquota" => "1.00",
            "valor_desconto_incondicionado" => "1.00"
        ],
        "intermediario" => [
            "cnpj" => "07504505000132",
            "cpf" => null,
            "im" => null,
            "razao_social" => "Acras Tecnologia da Informação LTDA"
        ],
        "obra" => [
            "codigo" => "2222",
            "art" => "1111"
        ]
    ];
    $resp = $nfse->cria($paylod);

    echo "<pre>";
    print_r($resp);
    echo "</pre>";

} catch (\Exception $e) {
    echo $e->getMessage();
}
