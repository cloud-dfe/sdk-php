<?php

require_once(__DIR__ . '/../../bootstrap.php');

use CloudDfe\SdkC\Nfe;

/**
 * Este exemplo de uma chamada a API usando este SDK
 *
 * Este método recupera o backup da NFe emitidas para o período informado
 *
 * NOTA: os backup tem a finalidade de garantir mais uma camada de segurança na guarda dos documentos para a softhouse.
 * NOTA: os backups são gerados no primeiro domingo de cada mês, e não estarão disponíveis até serem gerados.
 */
try {
    $params = [
        'token' => 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbXAiOjcwLCJ1c3IiOiIyIiwidHAiOjIsImlhdCI6MTU4MDkzNzM3MH0.KvSUt2x8qcu4Rtp2XNTOINqR',
        'ambiente' => Nfe::AMBIENTE_HOMOLOGACAO,
        'options' => [
            'debug' => false,
        ]
    ];
    $nfe = new Nfe($params);


    //informar o período desejado de backup


    $paylod = [
        "natureza_operacao" => "VENDA DENTRO DO ESTADO",
        "serie" => "1",
        "numero" => "101003",
        "data_emissao" => "2021-02-09T17:00:00-03:00",
        "data_entrada_saida" => "2021-02-09T17:00:00-03:00",
        "tipo_operacao" => "1",
        "local_destino" => "1",
        "finalidade_emissao" => "1",
        "consumidor_final" => "1",
        "presenca_comprador" => "9",
        "intermediario" => [
            "indicador" => "0"
        ],
        "notas_referenciadas" => [],
        "destinatario" => [
            "cpf" => "01234567890",
            "nome" => "EMPRESA MODELO",
            "indicador_inscricao_estadual" => "9",
            "inscricao_estadual" => null,
            "endereco" => [
                "logradouro" => "AVENIDA TESTE",
                "numero" => "444",
                "bairro" => "CENTRO",
                "codigo_municipio" => "4108403",
                "nome_municipio" => "Mossoro",
                "uf" => "PR",
                "cep" => "59653120",
                "codigo_pais" => "1058",
                "nome_pais" => "BRASIL",
                "telefone" => "8499995555"
            ]
        ],
        "itens" => [
            [
                "numero_item" => "1",
                "codigo_produto" => "000297",
                "descricao" => "SAL GROSSO 50KGS",
                "codigo_ncm" => "84159020",
                "cfop" => "5102",
                "unidade_comercial" => "SC",
                "quantidade_comercial" => 10,
                "valor_unitario_comercial" => "22.45",
                "valor_bruto" => "224.50",
                "unidade_tributavel" => "SC",
                "quantidade_tributavel" => "10.00",
                "valor_unitario_tributavel" => "22.45",
                "origem" => "0",
                "inclui_no_total" => "1",
                "imposto" => [
                    "valor_total_tributos" => 9.43,
                    "icms" => [
                        "situacao_tributaria" => "102",
                        "aliquota_credito_simples" => "0",
                        "valor_credito_simples" => "0",
                        "modalidade_base_calculo" => "3",
                        "valor_base_calculo" => "0.00",
                        "modalidade_base_calculo_st" => "4",
                        "aliquota_reducao_base_calculo" => "0.00",
                        "aliquota" => "0.00",
                        "aliquota_final" => "0.00",
                        "valor" => "0.00",
                        "margem_valor_adicionado_st" => "0.00",
                        "reducao_base_calculo_st" => "0.00",
                        "base_calculo_st" => "0.00",
                        "aliquota_st" => "0.00",
                        "valor_st" => "0.00"
                    ],
                    "fcp" => [
                        "aliquota" => "1.65"
                    ],
                    "pis" => [
                        "situacao_tributaria" => "01",
                        "valor_base_calculo" => 224.5,
                        "aliquota" => "1.65",
                        "valor" => "3.70"
                    ],
                    "cofins" => [
                        "situacao_tributaria" => "01",
                        "valor_base_calculo" => 224.5,
                        "aliquota" => "7.60",
                        "valor" => "17.06"
                    ]
                ],
                "valor_desconto" => 0,
                "valor_frete" => 0,
                "valor_seguro" => 0,
                "valor_outras_despesas" => 0,
                "informacoes_adicionais_item" => "Valor aproximado tributos R$: 9,43 (4,20%) Fonte: IBPT"
            ]
        ],
        "icms_base_calculo" => 0,
        "icms_valor_total" => 0,
        "valor_produtos" => 224.5,
        "valor_frete" => 0,
        "valor_seguro" => 0,
        "valor_desconto" => 0,
        "valor_pis" => 3.7,
        "valor_cofins" => 17.06,
        "valor_outras_despesas" => 0,
        "valor_total" => 224.5,
        "frete" => [
            "modalidade_frete" => "0",
            "volumes" => [
                [
                    "quantidade" => "10",
                    "especie" => null,
                    "marca" => "TESTE",
                    "numero" => null,
                    "peso_liquido" => 500,
                    "peso_bruto" => 500
                ]
            ]
        ],
        "cobranca" => [
            "fatura" => [
                "numero" => "1035.00",
                "valor_original" => "224.50",
                "valor_desconto" => "0.00",
                "valor_liquido" => "224.50"
            ]
        ],
        "pagamento" => [
            "formas_pagamento" => [
                [
                    "meio_pagamento" => "01",
                    "valor" => "224.50"
                ]
            ]
        ],
        "informacoes_adicionais_contribuinte" => "PV: 3325 * Rep: DIRETO * Motorista:  * Forma Pagto: 04 DIAS * teste de observação para a nota fiscal * Valor aproximado tributos R$9,43 (4,20%) Fonte: IBPT",
        "pessoas_autorizadas" => [
            [
                "cnpj" => "96256273000170"
            ], [
                "cnpj" => "80681257000195"
            ]
        ]
    ];
    $resp = $nfe->preview($paylod);

    echo "<pre>";
    print_r($resp);
    echo "</pre>";

} catch (\Exception $e) {
    echo $e->getMessage();
}
