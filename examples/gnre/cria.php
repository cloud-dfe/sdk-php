<?php

require_once(__DIR__ . "/../../bootstrap.php");

use CloudDfe\SdkPHP\Gnre;

/**
 * Este exemplo de uma chamada a API usando este SDK
 *
 * Este método cria uma GNRe
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

    $gnre = new Gnre($params);

    // Payload: Informações que serão enviadas para a API da CloudDFe

    // OBS: Não utilize o payload de exemplo abaixo, ele é apenas um exemplo. Consulte a documentação para construir o payload para sua aplicação.

    $payload = [
        "numero" => "6",
        "uf_favoverida" => "RO",
        "ie_emitente_uf_favorecida" => null,
        "tipo" => "0",
        "valor" => 12.55,
        "data_pagamento" => "2022-05-22",
        "identificador_guia" => "12345",
        "receitas" => [
            [
                "codigo" => "100102",
                "detalhamento" => null,
                "data_vencimento" => "2022-05-22",
                "convenio" => "Convênio ICMS 142/18",
                "numero_controle" => "1",
                "numero_controle_fecp" => null,
                "documento_origem" => [
                    "numero" => "000000001",
                    "tipo" => "10"
                ],
                "produto" => null,
                "referencia" => [
                    "periodo" => "0",
                    "mes" => "05",
                    "ano" => "2022",
                    "parcela" => null
                ],
                "valores" => [
                    [
                        "valor" => 12.55,
                        "tipo" => "11"
                    ]
                ],
                "contribuinte_destinatario" => [
                    "cnpj" => null,
                    "cpf" => null,
                    "ie" => null,
                    "razao" => null,
                    "ibge" => null
                ],
                "extras" => [
                    [
                        "codigo" => "52",
                        "conteudo" => "32220526434850000191550100000000011015892724"
                    ]
                ]
            ]
        ]
    ];

    $resp = $gnre->cria($payload);
    echo "<pre>";
    print_r($resp);
    echo "</pre>";
    if ($resp->sucesso) {
        $chave = $resp->chave;
        sleep(15);
        $payload = [
            "chave" => $chave
        ];
        $resp = $cteos->consulta($payload);
        if ($resp->codigo != 5023) {
            if ($resp->sucesso) {
                // autorizado
                var_dump($resp);
            } else {
                // rejeição
                var_dump($resp);
            }
        } else {
            // nota em processamento
            // recomendamos que seja utilizado o metodo de consulta manual ou o webhook
        }
    } else if (in_array($resp->codigo, [5001, 5002])) {
        // erro nos campos
        var_dump($resp->erros);
    } else if ($resp->codigo == 5008) {
        $chave = $resp->chave;
        // >= 7000 erro de timout ou de conexão
        // 5008 documento já criado
        var_dump($resp);
        $payload = [
            "chave" => $chave
        ];
        // recomendamos fazer a consulta pela chave para sincronizar o documento
        $resp = $gnre->consulta($payload);
        if ($resp->codigo != 5023) {
            if ($resp->sucesso) {
                // autorizado
                var_dump($resp);
            } else {
                // rejeição
                var_dump($resp);
            }
        } else {
            // em processamento
            var_dump($resp);
        }
    } else {
        // rejeição
        var_dump($resp);
    }
} catch (\Exception $e) {

    // Em caso de erros será lançado uma exceção com a mensagem de erro

    echo $e->getMessage();
}
