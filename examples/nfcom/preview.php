<?php

require_once(__DIR__ . "/../../bootstrap.php");

use CloudDfe\SdkPHP\Nfcom;

try {

    // Variaveis para definição de configurações iniciais para o uso da SDK
    // Token: Token do emitente (distribuído pela CloudDFe se baseando no ambiente: homologação/produção)
    // Ambiente: Ambiente do qual o serviço vai ser executado (homologação/produção)
    // Options: Opções para configuração da chamada da SDK
    // Debug: Habilita ou desabilita mensagens de debug (Por enquando sem efeito)
    // Timeout: Tempo de espera para a execução da chamada
    // Port: Porta de comunicação
    // Http_version: Versão do HTTP (Especifico para a comunicação utilizando PHP)

    $params = [
        "token" => "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbXAiOiJ0b2tlbl9leGVtcGxvIiwidXNyIjoidGsiLCJ0cCI6InRrIn0.Tva_viCMCeG3nkRYmi_RcJ6BtSzui60kdzIsuq5X-sQ",
        "ambiente" => Nfcom::AMBIENTE_HOMOLOGACAO,
        "options" => [
            "debug" => false,
            "timeout" => 60,
            "port" => 443,
            "http_version" => CURL_HTTP_VERSION_NONE
        ]
    ];
    $nfcom = new Nfcom($params);

    // Payload: Informações que serão enviadas para a API da CloudDFe

    // OBS: Não utilize o payload de exemplo abaixo, ele é apenas um exemplo. Consulte a documentação para construir o payload para sua aplicação.

    $payload = [
        "numero" => "3",
        "serie" => "1",
        "data_emissao" => "2024-06-20T13:23:00-03:00",
        "finalidade_emissao" => "0",
        "tipo_faturamento" => "0",
        "indicador_prepago" => "0",
        "indicador_cessao_meios_rede" => "0",
        "destinatario" => [
            "nome" => "HELIO WOLFF",
            "cpf" => "06844990960",
            "cnpj" => "",
            "id_outros" => "",
            "inscricao_estadual" => null,
            "indicador_inscricao_estadual" => "9",
            "endereco" => [
                "logradouro" => "LOJA",
                "complemento" => null,
                "numero" => "SN",
                "bairro" => "BANANAL",
                "codigo_municipio" => "4314035",
                "nome_municipio" => "Pareci Novo",
                "uf" => "RS",
                "codigo_pais" => "1058",
                "nome_pais" => "Brasil",
                "cep" => "95783000",
                "telefone" => null,
                "email" => null
            ]
        ],
        "assinante" => [
            "codigo" => "123",
            "tipo" => "3",
            "servico" => "4",
            "numero_contrato" => "12345678",
            "data_inicio" => "2022-01-01",
            "data_fim" => "2022-01-01",
            "numero_terminal" => null,
            "uf" => null
        ],
        "itens" => [],
        "cobranca" => [
            "data_competencia" => "2024-06-01",
            "data_vencimento" => "2024-06-30",
            "codigo_barras" => "19872982798277298279287298728278272872872"
        ],
        "informacoes_adicionais_contribuinte" => ""
    ];

    // carrega os itens
    $listaItens[] = [
        "numero_item" => "1",
        "codigo_produto" => "123",
        "descricao" => "LP 1MB",
        "codigo_classificacao" => "0400401",
        "cfop" => "5301",
        "unidade_medida" => "1",
        "quantidade" => "1",
        "valor_unitario" => "10.00",
        "valor_desconto" => "0",
        "valor_outras_despesas" => "0",
        "valor_bruto" => "10.00",
        "indicador_devolucao" => "0",
        "informacoes_adicionais" => "teste",
        "imposto" => [
            "icms" => [
                "situacao_tributaria" => "00",
                "valor_base_calculo" => "10.00",
                "aliquota" => "18.00",
                "valor" => "1.80"
            ],
            "fcp" => [
                "aliquota" => null,
                "valor" => null
            ]
        ]
    ];
    foreach ($listaItens as $item) {
        $payload["itens"][] = $item;
    }

    $resp = $nfcom->preview($payload);

    echo "<pre>";
    print_r($resp);
    echo "</pre>";
} catch (\Exception $e) {

    // Em caso de erros será lançado uma exceção com a mensagem de erro

    echo $e->getMessage();
}
