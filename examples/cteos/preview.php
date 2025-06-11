<?php

require_once(__DIR__ . "/../../bootstrap.php");

use CloudDfe\SdkPHP\CteOS;

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

    // Instancia a classe CTe-OS que possui métodos para realizar requisições a nossa API
    $cteos = new CteOS($configSDK);

    // Payload: Informações que serão enviadas para a API da CloudDFe

    // OBS: Não utilize o payload de exemplo abaixo, ele é apenas um exemplo. Consulte a documentação para construir o payload para sua aplicação.

    $payload = [
        "cfop" => "5353",
        "natureza_operacao" => "PRESTACAO DE SERVIÇO",
        "numero" => "64",
        "serie" => "1",
        "data_emissao" => "2020-11-24T03:00:00-03:00",
        "tipo_operacao" => "0",
        "codigo_municipio_envio" => "2408003",
        "nome_municipio_envio" => "MOSSORO",
        "uf_envio" => "RN",
        "tipo_servico" => "6",
        "codigo_municipio_inicio" => "2408003",
        "nome_municipio_inicio" => "Mossoró",
        "uf_inicio" => "RN",
        "codigo_municipio_fim" => "2408003",
        "nome_municipio_fim" => "Mossoró",
        "uf_fim" => "RN",
        "valores" => [
            "servico" => "0.00",
            "valor_total" => "0.00",
            "valor_receber" => "0.00",
            "quantidade" => "10.00"
        ],
        "imposto" => [
            "icms" => [
                "situacao_tributaria" => "20",
                "valor_base_calculo" => "0.00",
                "aliquota" => "12.00",
                "valor" => "0.00",
                "reducao_base_calculo" => "50.00"
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
            "indicador_inscricao_estadual" => "1",
            "cnpj" => "15495526000128",
            "inscricao_estadual" => "212055510",
            "nome" => "EMPRESA MODELO",
            "razao_social" => "EMPRESA MODELO",
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
        "observacao" => ""
    ];

    // Envio dos dados para a API da CloudDFe

    $resp = $cte->preview($payload);

    // Visualização do retorno

    echo "<pre>";
    print_r($resp);
    echo "</pre>";
} catch (\Exception $e) {

    // Caso ocorra algum erro, será exibido na tela

    echo $e->getMessage();
}
