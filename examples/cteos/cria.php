<?php

require_once(__DIR__ . "/../../bootstrap.php");

use CloudDfe\SdkPHP\CteOS;

/**
 * Este exemplo de uma chamada a API usando este SDK
 *
 * Este método cria uma cteos
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

    // Criação de uma instância da classe CteOS

    $cteos = new CteOS($params);

    // Payload: Informações que serão enviadas para a API da CloudDFe

    // OBS: Não utilize o payload de exemplo abaixo, ele é apenas um exemplo. Consulte a documentação para construir o payload para sua aplicação.

    $payload = [
        "cfop" => "5353",
        "natureza_operacao" => "PRESTACAO DE SERVICO",
        "numero" => "64",
        "serie" => "1",
        "data_emissao" => "2020-11-24T03:00:00-03:00",
        "tipo_operacao" => "0",
        "codigo_municipio_envio" => "2408003",
        "nome_municipio_envio" => "MOSSORO",
        "uf_envio" => "RN",
        "tipo_servico" => "6",
        "codigo_municipio_inicio" => "2408003",
        "nome_municipio_inicio" => "Mossoro",
        "uf_inicio" => "RN",
        "codigo_municipio_fim" => "2408003",
        "nome_municipio_fim" => "Mossoro",
        "uf_fim" => "RN",
        "valores" => [
            "servico" => "0.00",
            "valor_total" => "0.00",
            "valor_receber" => "0.00",
            "quantidade" => "10.00"
        ],
        "imposto" => [
            "icms" => [
                "situacao_tributaria" => "99",
                "valor_base_calculo" => "0.00",
                "aliquota" => "12.00",
                "valor" => "0.00",
                "aliquota_reducao_base_calculo" => "50.00"
            ],
            "federais" => [
                "valor_pis" => "0.00",
                "valor_cofins" => "0.00",
                "valor_ir" => "12.00",
                "valor_inss" => "0.00",
                "valor_csll" => "50.00"
            ]
        ],
        "modal_rodoviario" => [
            "taf" => "020335171251",
            "numero_registro_estadual" => "0203351712510203351712515"
        ],
        "tomador" => [
            "indicador_inscricao_estadual" => "9",
            "cpf" => "01234567890",
            "inscricao_estadual" => null,
            "nome" => "EMPRESA MODELO",
            "razao_social" => "EMPRESA MODELO",
            "telefone" => "8499995555",
            "endereco" => [
                "logradouro" => "AVENIDA TESTE",
                "numero" => "444",
                "bairro" => "CENTRO",
                "codigo_municipio" => "2408003",
                "nome_municipio" => "Mossoro",
                "cep" => "59603330",
                "uf" => "RN",
                "codigo_pais" => "1058",
                "nome_pais" => "BRASIL",
                "email" => "teste@teste.com.br"
            ]
        ],
        "componentes_valor" => [
            [
                "nome" => "teste2",
                "valor" => "1999.00"
            ]
        ],
        "observacao" => ""
    ];

    // Chamada para o método cria na classe CteOS

    $resp = $cteos->cria($payload);

    // Visualização do retorno

    echo "<pre>";
    print_r($resp);
    echo "</pre>";
    if ($resp->sucesso) {
        $chave = $resp->chave;
        sleep(5);
        $tentativa = 1;
        while ($tentativa <= 5) {
            $payload = [
                "chave" => $chave
            ];
            $resp = $cteos->consulta($payload);
            if ($resp->codigo != 5023) {
                if ($resp->sucesso) {
                    // autorizado
                    var_dump($resp);
                    break;
                } else {
                    // rejeição
                    var_dump($resp);
                    break;
                }
            }
            sleep(5);
            $tentativa++;
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
            // em processamento
            var_dump($resp);
        }
    } else {
        // rejeição
        var_dump($resp);
    }
} catch (\Exception $e) {
    echo $e->getMessage();
}
