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

    $paylod = [
        "tipo_operacao" => "2",
        "numero" => "26",
        "serie" => "1",
        "data_emissao" => "2020-11-25T09:21:42-00:00",
        "uf_inicio" => "RN",
        "uf_fim" => "GO",
        "municipios_carregamento" => [
            [
                "codigo_municipio" => "2408003",
                "nome_municipio" => "Mossoró"
            ]
        ],
        "percursos" => [
            [
                "uf" => "PB"
            ], [
                "uf" => "PE"
            ], [
                "uf" => "BA"
            ]
        ],
        "municipios_descarregamento" => [
            [
                "codigo_municipio" => "5200050",
                "nome_municipio" => "Abadia de Goiás",
                "nfes" => [
                    [
                        "chave" => "34255501343220005109556010100010641225557671"
                    ]
                ]
            ]
        ],
        "valores" => [
            "valor_total_carga" => "100.00",
            "codigo_unidade_medida_peso_bruto" => "01",
            "peso_bruto" => "1000.000"
        ],
        "informacao_adicional_fisco" => null,
        "informacao_complementar" => null,
        "modal_rodoviario" => [
            "rntrc" => "57838055",
            "ciot" => [],
            "contratante" => [],
            "vale_pedagio" => [],
            "veiculo" => [
                "codigo" => "000000001",
                "placa" => "FFF1257",
                "renavam" => "335540391",
                "tara" => "0",
                "tipo_rodado" => "01",
                "tipo_carroceria" => "00",
                "uf" => "MT",
                "proprietario" => [
                    "cnpj" => "15555270000224",
                    "rntrc" => "33838121",
                    "nome" => "TESTES TRANSPORTES LTDA",
                    "inscricao_estadual" => "ISENTO",
                    "uf" => "MT",
                    "tipo" => "0"
                ],
                "condutores" => [
                    [
                        "nome" => "JOAO TESTE",
                        "cpf" => "12456547872"
                    ]
                ]
            ],
            "reboque" => []
        ],
        "tipo_transporte" => "2"
    ];
    $resp = $mdfe->cria($paylod);

    echo "<pre>";
    print_r($resp);
    echo "</pre>";

} catch (\Exception $e) {
    echo $e->getMessage();
}
