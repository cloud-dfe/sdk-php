<?php

require_once(__DIR__ . '/../../bootstrap.php');

use CloudDfe\SdkPHP\Nfe;

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
        'token' => 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbXAiOjcwLCJ1c3IiOiIyIiwidHAiOjIsImlhdCI6MTU4MDkzNzM3MH0.KvSUt2x8qcu4Rtp2XNTOINqR-3c5V8iyITDmLoUF_SE',
        'ambiente' => Nfe::AMBIENTE_HOMOLOGACAO,
        'options' => [
            'debug' => false,
            'timeout' => 60,
            'port' => 443,
            'http_version' => CURL_HTTP_VERSION_NONE
        ]
    ];
    $nfe = new Nfe($params);
    //informar o período desejado de backup
    $paylod = [
        "natureza_operacao" => "VENDA DENTRO DO ESTADO",
        "serie" => "1",
        "numero" => "101007",
        "data_emissao" => "2021-06-26T13:00:00-03:00",
        "data_entrada_saida" => "2021-06-26T13:00:00-03:00",
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
                        "aliquota_margem_valor_adicionado_st" => "0.00",
                        "aliquota_reducao_base_calculo_st" => "0.00",
                        "aliquota_base_calculo_st" => "0.00",
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
    $resp = $nfe->cria($paylod);
    echo "<pre>";
    print_r($resp);
    echo "</pre>";
    if ($resp->sucesso) {
        if ($resp->codigo == 5023) {
            /**
             * Em alguns casos a SEFAZ pode demorar mais do que esperado pela api
             * para processar o lote, devido a trafego na rede ou sobrecarga de processamento
             * então nesse caso quando vir codigo 5023 é necessario buscar a NFe pela chave de acesso
             */
            $tentativa = 1;
            while ($tentativa <= 5) {
                sleep(10);
                $payload = [
                    'chave' => $resp->chave
                ];
                $resp = $nfe->consulta($payload);
                if ($resp->sucesso) {
                    // autorizado
                    break;
                } else {
                    // rejeição
                    var_dump($resp);
                    break;
                }
                $tentativa++;
            }
        } else {
            // autorizado
        }
    } else if (in_array($resp->codigo, [5001, 5002])) {
        // erro nos campos
        var_dump($resp->erros);
    } else if ($resp->codigo >= 7000) {
        // erro de timout ou de conexão
        var_dump($resp);
        $payload = [
            'chave' => $resp->chave
        ];
        // recomendamos fazer a consulta pela chave para sincronizar o documento
        $resp = $nfe->consulta($payload);
        if ($resp->sucesso) {
            // autorizado
        } else {
            // rejeição
            var_dump($resp);
        }
    } else {
        // rejeição
        var_dump($resp);
    }
} catch (\Exception $e) {
    echo $e->getMessage();
}
