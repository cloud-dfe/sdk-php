<?php

require_once(__DIR__ . "/../../bootstrap.php");

use CloudDfe\SdkPHP\Nfse;

try {

    // Variavel de configuração para definir parametros da requisição.
    $configSDK = [

        // Token do emitente obtido no painel da IntegraNotas no cadastro do emitente.
        // Para obter em Produção: https://gestao.integranotas.com.br/login e em Homologação: https://hom-gestao.integranotas.com.br/login
        "token" => "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbXAiOiJ0b2tlbl9leGVtcGxvIiwidXNyIjoidGsiLCJ0cCI6InRrIn0.Tva_viCMCeG3nkRYmi_RcJ6BtSzui60kdzIsuq5X-sQ",

        // Em qual ambiente a requisição será feita.
        "ambiente" => 2, // IMPORTANTE: 1 - Produção / 2 - Homologação

        // Em qual versão da API será enviado
        "version" => 2, // IMPORTANTE: 1 / 2 -> Padrão é 1 
        // Alguns dos recursos ainda estão na v1

        // Opções complementares, vai depender da sua necessidade
        "options" => [
            "debug" => "", // Ativa mensagem de depuração, Default: false
            "timeout" => "", // Tempo máximo de espera para resposta da API, Default: 60
            "port" => "", // Porta de conexão, Default: 443
            "http_version" => ""// Versão do HTTP, Default: CURL_HTTP_VERSION_NONE
        ],
    ];

    // Instancia a classe Nfse que possui métodos para realizar requisições a nossa API
    $nfse = new Nfse($configSDK);


    /*
     ESTE PAYLOAD É UM EXEMPLO, CADA MUNICÍPIO PODE HAVER VARIAÇÕES E OBRIGAÇÕES FISCAIS PRÓPRIAS.
     RECOMENDAMOS QUE VOCÊ VERIFIQUE A DOCUMENTAÇÃO DO SEU MUNICÍPIO PARA OBTER OS CAMPOS OBRIGATÓRIOS E OPCIONAIS.
     OBS: CASO VOCÊ ESTEJA TRABALHANDO EM MAIS DE UM MUNICÍPIO VOCÊ PODE CRIAR PAYLOAD GENERICO QUE ATENDA
    A TODOS OS MUNICÍPIOS
    */

    $payload = [ // AVISO: PAYLOAD EXEMPLO VERIFICA A DOCUMENTAÇÃO PARA CRIAR CONFORME O SEU MUNICÍPIO
        "numero" => "",
        "serie" => "",
        "tipo" => "", // AVISO: PAYLOAD EXEMPLO VERIFICA A DOCUMENTAÇÃO PARA CRIAR CONFORME O SEU MUNICÍPIO
        "status" => "",
        "data_emissao" => "",
        "tomador" => [ // AVISO: PAYLOAD EXEMPLO VERIFICA A DOCUMENTAÇÃO PARA CRIAR CONFORME O SEU MUNICÍPIO
            "cnpj" => "",
            "cpf" => "",
            "im" => "", // AVISO: PAYLOAD EXEMPLO VERIFICA A DOCUMENTAÇÃO PARA CRIAR CONFORME O SEU MUNICÍPIO
            "razao_social" => "",
            "endereco" => [ // AVISO: PAYLOAD EXEMPLO VERIFICA A DOCUMENTAÇÃO PARA CRIAR CONFORME O SEU MUNICÍPIO
                "logradouro" => "",
                "numero" => "",
                "complemento" => "", // AVISO: PAYLOAD EXEMPLO VERIFICA A DOCUMENTAÇÃO PARA CRIAR CONFORME O SEU MUNICÍPIO
                "bairro" => "",
                "codigo_municipio" => "",
                "uf" => "",
                "cep" => ""
            ]
        ],
        "servico" => [ // AVISO: PAYLOAD EXEMPLO VERIFICA A DOCUMENTAÇÃO PARA CRIAR CONFORME O SEU MUNICÍPIO
            "endereco_local_prestacao" => [
                "codigo_municipio" => "",
                "codigo_municipio_prestacao" => "",
                "codigo_pais" => "",
            ],
            "codigo" => "", // AVISO: PAYLOAD EXEMPLO VERIFICA A DOCUMENTAÇÃO PARA CRIAR CONFORME O SEU MUNICÍPIO
            "codigo_tributacao_municipio" => "",
            "discriminacao" => "",
            "valor_servicos" => "",
            "valor_desconto_incondicionado" => "", // AVISO: PAYLOAD EXEMPLO VERIFICA A DOCUMENTAÇÃO PARA CRIAR CONFORME O SEU MUNICÍPIO
            "tributos_municipais" => [
                "iss_retido" => "",
                "responsavel_retencao" => "",
                "valor_base_calculo_iss" => "",
                "aliquota_iss" => "",
                "valor_iss" => "",
            ],
            "tributos_nacionais" => [
                "valor_pis" => "",
                "valor_cofins" => "", // AVISO: PAYLOAD EXEMPLO VERIFICA A DOCUMENTAÇÃO PARA CRIAR CONFORME O SEU MUNICÍPIO
                "valor_inss" => "",
                "valor_ir" => "",
                "valor_csll" => "",
                "valor_outras" => "",
            ]
        ]
    ];

    // Envia para fazer o preview a NFSe para a API
    $resp = $nfse->preview($payload);

    echo "<pre>";
    print_r($resp);
    echo "</pre>";
} catch (\Exception $e) {

    // Em caso de erros será lançado uma exceção com a mensagem de erro

    echo $e->getMessage();
}