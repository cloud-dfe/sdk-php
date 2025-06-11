<?php

require_once(__DIR__ . "/../../bootstrap.php");

use CloudDfe\SdkPHP\Cte;

try {

    // Variavel de configuração para definir parametros da requisição.
    $configSDK = [

        // Token do emitente obtido no painel da IntegraNotas no cadastro do emitente.
        // Para obter em Produção: https://gestao.integranotas.com.br/login e em Homologação: https://hom-gestao.integranotas.com.br/login
        "token" => "",

        // Em qual ambiente a requisição será feita.
        "ambiente" => "", // 1- Produção / 2- Homologação
        
        // Opções complementares, vai depender da sua necessidade
        "options" => [
            "debug" => "", // Ativa mensagem de depuração, Default: false
            "timeout" => "", // Tempo máximo de espera para resposta da API, Default: 60
            "port" => "", // Porta de conexão, Default: 443
            "http_version" => "" // Versão do HTTP, Default: CURL_HTTP_VERSION_NONE
        ]
    ];

    // Instancia a classe CTe que possui métodos para realizar requisições a nossa API
    $cte = new Cte($configSDK);

    // Payload: Informações que serão enviadas para a API da CloudDFe

    // OBS: Não utilize o payload de exemplo abaixo, ele é apenas um exemplo. Consulte a documentação para construir o payload para sua aplicação.

    $payload = [
        "cfop" => "5353",
        "natureza_operacao" => "PRESTACAO DE SERVIÇO",
        "numero" => "64",
        "serie" => "1",
        "data_emissao" => "2021-06-22T03:00:00-03:00",
        "tipo_operacao" => "0",
        "codigo_municipio_envio" => "2408003",
        "nome_municipio_envio" => "MOSSORO",
        "uf_envio" => "RN",
        "tipo_servico" => "0",
        "codigo_municipio_inicio" => "2408003",
        "nome_municipio_inicio" => "Mossoró",
        "uf_inicio" => "RN",
        "codigo_municipio_fim" => "2408003",
        "nome_municipio_fim" => "Mossoró",
        "uf_fim" => "RN",
        "retirar_mercadoria" => "1",
        "detalhes_retirar" => null,
        "tipo_programacao_entrega" => "0",
        "sem_hora_tipo_hora_programada" => "0",
        "remetente" => [
            "cnpj" => "15493526000128",
            "inscricao_estadual" => "239084510",
            "nome" => "EMPRESA MODELO",
            "razao_social" => "MODELO LTDA",
            "telefone" => "8433163070",
            "endereco" => [
                "logradouro" => "AVENIDA TESTE",
                "numero" => "444",
                "bairro" => "CENTRO",
                "codigo_municipio" => "2408003",
                "nome_municipio" => "MOSSORÓ",
                "uf" => "RN"
            ]
        ],
        "valores" => [
            "valor_total" => "0.00",
            "valor_receber" => "0.00",
            "valor_total_carga" => "224.50",
            "produto_predominante" => "SAL",
            "quantidades" => [
                [
                    "codigo_unidade_medida" => "01",
                    "tipo_medida" => "Peso Bruto",
                    "quantidade" => "500.00"
                ]
            ]
        ],
        "imposto" => [
            "icms" => [
                "situacao_tributaria" => "20",
                "valor_base_calculo" => "0.00",
                "aliquota" => "12.00",
                "valor" => "0.00",
                "aliquota_reducao_base_calculo" => "50.00"
            ]
        ],
        "nfes" => [
            [
                "chave" => "50000000000000000000000000000000000000000000"
            ]
        ],
        "modal_rodoviario" => [
            "rntrc" => "02033517"
        ],
        "destinatario" => [
            "cpf" => "01234567890",
            "inscricao_estadual" => null,
            "nome" => "EMPRESA MODELO",
            "telefone" => "8499995555",
            "endereco" => [
                "logradouro" => "AVENIDA TESTE",
                "numero" => "444",
                "bairro" => "CENTRO",
                "codigo_municipio" => "2408003",
                "nome_municipio" => "Mossoró",
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
        "tomador" => [
            "tipo" => "3",
            "indicador_inscricao_estadual" => "1"
        ],
        "observacao" => ""
    ];

    // Chamada para a função de criação de CTe

    $resp = $cte->preview($payload);

    // Visualização do retorno

    echo "<pre>";
    print_r($resp);
    echo "</pre>";
} catch (\Exception $e) {

    // Caso ocorra algum erro na execução do código acima, será exibido a mensagem de erro na tela

    echo $e->getMessage();
}
