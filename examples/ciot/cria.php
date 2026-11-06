<?php

require_once(__DIR__ . "/../../bootstrap.php");

use CloudDfe\SdkPHP\Ciot;

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

    $ciot = new Ciot($params);

    // Payload: Informações que serão enviadas para a API da CloudDFe

    // OBS: Não utilize o payload de exemplo abaixo, ele é apenas um exemplo. Consulte a documentação para construir o payload para sua aplicação.

    $resp = $ciot->cria([
        "numero" => "1001",
        "identificacao" => "PEDIDO-77",
        "tipo_operacao" => "1",
        "data_inicio" => "2026-11-10",
        "data_fim" => "2026-11-12",
        "valor_frete" => "4550.92",
        "contratante" => [
            "cnpj" => "11222333000181",
            "nome" => "TRANSPORTADORA EXEMPLO LTDA",
            "rntrc" => "12345678"
        ],
        "contratado" => [
            "cnpj" => "22333444000181",
            "nome" => "TRANSPORTADOR CONTRATADO LTDA",
            "rntrc" => "87654321"
        ],
        "destinatario" => [
            "cnpj" => "44555666000199",
            "nome" => "DESTINATARIO EXEMPLO LTDA"
        ],
        "motorista" => [
            "cpf" => "12345678909",
            "nome" => "MOTORISTA EXEMPLO"
        ],
        "veiculos" => [
            [
                "placa" => "BCD2E34",
                "eixos" => "2",
                "rntrc" => "87654321"
            ]
        ],
        "carga" => [
            "tipo" => "05",
            "natureza" => "8414",
            "peso" => "1520"
        ],
        "viagens" => [
            [
                "quantidade" => "1",
                "distancia" => "560",
                "origem" => [
                    "cep" => "85000000",
                    "codigo_municipio" => "4121604",
                    "municipio" => "Renascença",
                    "uf" => "PR"
                ],
                "destino" => [
                    "cep" => "88300000",
                    "codigo_municipio" => "4208203",
                    "municipio" => "Itajaí",
                    "uf" => "SC"
                ]
            ]
        ],
        "pagamentos" => [
            [
                "forma" => "1",
                "tipo" => "5",
                "cnpj" => "22333444000181",
                "chave_pix" => "22333444000181",
                "vencimento" => "2026-11-12",
                "valor" => "4550.92"
            ]
        ]
    ]);

    echo "<pre>";
    print_r($resp);
    echo "</pre>";

    if ($resp->sucesso) {
        if ($resp->codigo == 5023) { // lote em processamento
            // aguardar e consultar pela chave ou esperar o webhook notificar quando a ANTT processar
        } else {
            // CIOT declarado
            var_dump($resp);
            return $resp;
        }
    } else {
        // rejeição
        var_dump($resp);
    }
} catch (\Exception $e) {

    // Em caso de erros será lançado uma exceção com a mensagem de erro

    echo $e->getMessage();
}
