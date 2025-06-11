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

        // Opções complementares, vai depender da sua necessidade
        "options" => [
            "debug" => "", // Ativa mensagem de depuração, Default: false
            "timeout" => "", // Tempo máximo de espera para resposta da API, Default: 60
            "port" => "", // Porta de conexão, Default: 443
            "http_version" => ""// Versão do HTTP, Default: CURL_HTTP_VERSION_NONE
        ]
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
            "codigo_municipio" => "",
            "itens" => [ // AVISO: PAYLOAD EXEMPLO VERIFICA A DOCUMENTAÇÃO PARA CRIAR CONFORME O SEU MUNICÍPIO
                [ 
                    "codigo" => "", // AVISO: PAYLOAD EXEMPLO VERIFICA A DOCUMENTAÇÃO PARA CRIAR CONFORME O SEU MUNICÍPIO
                    "codigo_tributacao_municipio" => "",
                    "discriminacao" => "",
                    "valor_servicos" => "",
                    "valor_pis" => "",
                    "valor_cofins" => "", // AVISO: PAYLOAD EXEMPLO VERIFICA A DOCUMENTAÇÃO PARA CRIAR CONFORME O SEU MUNICÍPIO
                    "valor_inss" => "",
                    "valor_ir" => "",
                    "valor_csll" => "",
                    "valor_outras" => "",
                    "valor_aliquota" => "",
                    "valor_desconto_incondicionado" => "" // AVISO: PAYLOAD EXEMPLO VERIFICA A DOCUMENTAÇÃO PARA CRIAR CONFORME O SEU MUNICÍPIO
                ]
            ]
        ]
    ];

    // Envia a NFSe para a API
    $resp = $nfse->cria($payload);

    if ($resp->sucesso) {
        // Ao entrar nesse bloco significa que a NFSe foi para o provedor e aguarda processamento.

        // Salva a chave no banco de dados para receber depois o resultado se a nota foi autorizada ou rejeitada
        // OBS: A chave é o identificador para consultas futuras da NFSe
        $chave = $resp->chave;
        
        /* Este é um exemplo de como consultar a NFse após o envio se caso você não poder usar o Webhook. 
        AVISO: RECOMENDAMOS UTILIZAR O WEBHOOK POIS ALGUMAS PREFEITURAS PODEM DEMORAR PARA PROCESSAR A NFSE.

            sleep(15); // Aguarda 15 segundos para consultar a NFse, pois o processamento pode levar alguns segundos
            
            $payload = [
                "chave" => $chave
            ];
        
            $resp = $nfse->consulta($payload);

            if ($resp->codigo != 5023) {
                if ($resp->sucesso) {
                    var_dump($resp);
                } else {
                    var_dump($resp);
                }
            }
        */

    } else if (in_array($resp->codigo, [5001, 5002])) {
        // Aqui o retorno indica que houve um erro na validação dos dados enviados
        // O código 5001 indica que falto campos obrigatórios ou opcionais obrigatórios referente ao emitente.
        // O código 5002 indica que houve um erro na validação dos dados como CNPJ, CPF, Inscrição Estadual, etc.
        var_dump($resp->erros);
    } else {
        // Aqui é retornado qualquer erro que não seja relacionado a validação dos dados como não foi informado certificado digital, entre outros.
        var_dump($resp);
    }
} catch (\Exception $e) {
    // Em caso de erros será lançado uma exceção com a mensagem de erro
    echo $e->getMessage();
}
