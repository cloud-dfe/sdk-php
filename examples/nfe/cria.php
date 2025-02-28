<?php

require_once(__DIR__ . "/../../bootstrap.php");

use CloudDfe\SdkPHP\Nfe;

/**
 * Este exemplo de uma chamada a API usando este SDK
 *
 * Este método faz o envio de uma NFe
 */
try {

    // Variaveis para definição de configurações iniciais para o uso da SDK
    // Token: Token do emitente (distribuído pela CloudDFe se baseando no ambiente: homologação/produção)
    // Ambiente: Ambiente do qual o serviço vai ser executado (1- Produção / 2- Homologação)
    // Options: Opções para configuração da chamada da SDK
    // Debug: Habilita ou desabilita mensagens de debug (Por enquando sem efeito)
    // Timeout: Tempo de espera para a execução da chamada
    // Port: Porta de comunicação
    // Http_version: Versão do HTTP (Especifico para a comunicação utilizando PHP)

    $params = [
        "token" => "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbXAiOiJ0b2tlbl9leGVtcGxvIiwidXNyIjoidGsiLCJ0cCI6InRrIn0.Tva_viCMCeG3nkRYmi_RcJ6BtSzui60kdzIsuq5X-sQ",
        "ambiente" => 2, // IMPORTANTE: 1 - Produção / 2 - Homologação
        "options" => [
            "debug" => false,
            "timeout" => 60,
            "port" => 443,
            "http_version" => CURL_HTTP_VERSION_NONE
        ]
    ];

    $nfe = new Nfe($params);

    // Payload: Informações que serão enviadas para a API da CloudDFe

    // OBS: NÃO UTILIZE O PAYLOAD DE EXEMPLO, ELE É APENAS UM EXEMPLO. CONSULTE A DOCUMENTAÇÃO PARA CONSTRUIR O PAYLOAD PARA SUA APLICAÇÃO.

    $payload = [
        "natureza_operacao" => "VENDA DENTRO DO ESTADO",
        "serie" => "1",
        "numero" => "101007",
        "data_emissao" => "2021-06-26T13:00:00-03:00",
        "data_entrada_saida" => "2021-06-26T13:00:00-03:00",
        "tipo_operacao" => "1",
        "finalidade_emissao" => "1",
        "consumidor_final" => "1",
        "presenca_comprador" => "9",
        "intermediario" => [
            "indicador" => "0"
        ],
        "notas_referenciadas" => [
            [
                "nfe" => [
                    "chave" => "50000000000000000000000000000000000000000000"
                ]
            ]
        ],
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
        "itens" => [],
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
            ],
            [
                "cnpj" => "80681257000195"
            ]
        ]
    ];

    // carrega os itens
    $listaItens[] = [
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
            "valor_aproximado_tributos" => 9.43,
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
                "valor_base_calculo_st" => "0.00",
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
        "informacoes_adicionais" => "Valor aproximado tributos R$: 9,43 (4,20%) Fonte: IBPT"
    ];
    foreach ($listaItens as $item) {
        $payload["itens"][] = $item;
    }

    // Salvar as informações da NFe em seu banco de dados
    // Reservar a numeração da NFe e alterar o status para (Não enviada)

    // Enviar a NFe para API
    $resp = $nfe->cria($payload);

    if ($resp->sucesso) {
        // Essa condição verifica se a NFe foi enviada para processamento
        // Altere o status da NFe para (Em processamento)

        $chave = $resp->chave;
        sleep(15); // O Ideal é aguardar de 10 a 15 segundos para consultar a NFe ou utilizar o WEBHOOK
        
        $payload = [
            "chave" => $chave
        ];
    
        // Consulta a NFe
        $resp = $nfe->consulta($payload);
        
        // Verifica se a NFe não está em processamento
        if ($resp->codigo != 5023) {
            if ($resp->sucesso) {
                // se a nota foi autorizada ela será retornada aqui
                // salvar as informações da NFe em seu banco de dados e alterar o status para (Autorizada)
                var_dump($resp);
            } else {
                // se a nota foi rejeitada ela será retornada aqui
                // salvar as informações de erro da NFe em seu banco de dados e alterar o status para (Rejeitada)
                var_dump($resp);
            }
        } else {
            // se a nota estiver em processamento ela será retornada aqui
            // salvar as informações da NFe em seu banco de dados e alterar o status para (Em processamento)
            // RECOMENDAMOS UTILIZAR O WEBHOOK POIS EVITA DE SEU CLIENTE FICAR FAZENDO CONSULTAS
            var_dump($resp);
        }

    } else if (in_array($resp->codigo, [5001, 5002])) {
        // se a nota estiver com dados faltando ou dando erro ao gerar o XML ela será retornada aqui
        // salvar o status da NFe como (Rejeitada/Erro) OBS: Não foi a SEFAZ que rejeitou mas sim nossa API que existe campos obrigatórios que não foram preenchidos.
        // Salvar as informações de erro da NFe e apresentar ao usuário
        var_dump($resp->erros);
    } else if ($resp->codigo == 5008) {
        // se a nota já foi criada ela será retornada aqui
        // ATENÇÃO: SE UTILIZADO INCORRETAMENTE PODE SOBREESCREVER DOCUMENTOS.
        
        // O procedimento obtém a chave da NFe e consulta para verificar se a NFe foi autorizada, rejeitada ou se ainda está em processamento
        // porém se no seu sistema tiver salvando os status da NFe incorretamente pode sobreescrever documentos 

        $chave = $resp->chave;
        $payload = [
            "chave" => $chave
        ]; 

        // Vai realizar a consulta da NFe para verificar o status da NFe
        $resp = $nfe->consulta($payload);
        if ($resp->codigo != 5023) {
            if ($resp->sucesso) {
                // se a nota foi autorizada ela será retornada aqui
                // salvar as informações da NFe em seu banco de dados e alterar o status para (Autorizada)
                var_dump($resp);
            } else {
                // se a nota foi rejeitada ela será retornada aqui
                // salvar as informações de erro da NFe em seu banco de dados e alterar o status para (Rejeitada)
                var_dump($resp);
            }
        } else {
            // se a nota estiver em processamento ela será retornada aqui
            // salvar as informações da NFe em seu banco de dados e alterar o status para (Em processamento)
            // RECOMENDAMOS UTILIZAR O WEBHOOK POIS EVITA DE SEU CLIENTE FICAR FAZENDO CONSULTAS
            var_dump($resp);
        }
    } else {
        // Se ocorrer qualquer outro erro será retornado aqui
        // salvar as informações de erro da NFe em seu banco de dados e alterar o status para (Rejeitada)
        var_dump($resp);
    }
} catch (\Exception $e) {
    // Em caso de erros será lançado uma exceção com a mensagem de erro
    echo $e->getMessage();
}
