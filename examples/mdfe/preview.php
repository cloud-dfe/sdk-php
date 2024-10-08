<?php

require_once(__DIR__ . "/../../bootstrap.php");

use CloudDfe\SdkPHP\Mdfe;

/**
 * Este exemplo de uma chamada a API usando este SDK
 *
 * Este método recupera o backup da NFe emitidas para o período informado
 *
 * NOTA: os backup tem a finalidade de garantir mais uma camada de segurança na guarda dos documentos para a softhouse.
 * NOTA: os backups são gerados no primeiro domingo de cada mês, e não estarão disponíveis até serem gerados.
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

    $nfe = new Mdfe($params);

    // Payload: Informações que serão enviadas para a API da CloudDFe

    // OBS: Não utilize o payload de exemplo abaixo, ele é apenas um exemplo. Consulte a documentação para construir o payload para sua aplicação.

    $payload = [
        "tipo_operacao" => "2",
        "tipo_transporte" => null,
        "numero" => "27",
        "serie" => "1",
        "data_emissao" => "2021-06-26T09:21:42-00:00",
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
            ],
            [
                "uf" => "PE"
            ],
            [
                "uf" => "BA"
            ]
        ],
        "municipios_descarregamento" => [
            [
                "codigo_municipio" => "5200050",
                "nome_municipio" => "Abadia de Goiás",
                "nfes" => [
                    [
                        "chave" => "50000000000000000000000000000000000000000000"
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
                "condutores" => [
                    [
                        "nome" => "NOME TESTE",
                        "cpf" => "01234567890"
                    ]
                ]
            ],
            "reboques" => []
        ]
    ];
    $resp = $nfe->preview($payload);

    echo "<pre>";
    print_r($resp);
    echo "</pre>";
} catch (\Exception $e) {

    // Em caso de erros será lançado uma exceção com a mensagem de erro

    echo $e->getMessage();
}
