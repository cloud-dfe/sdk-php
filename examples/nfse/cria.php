<?php

require_once(__DIR__ . "/../../bootstrap.php");

use CloudDfe\SdkPHP\Nfse;

/**
 * Este exemplo de uma chamada a API usando este SDK
 *
 * Este método faz o envio de uma NFSe
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

    $nfse = new Nfse($params);

    // Payload: Informações que serão enviadas para a API da CloudDFe

    // OBS: NÃO UTILIZE O PAYLOAD DE EXEMPLO, ELE É APENAS UM EXEMPLO. CONSULTE A DOCUMENTAÇÃO PARA CONSTRUIR O PAYLOAD PARA SUA APLICAÇÃO.

    $payload = [
        "numero" => "1",
        "serie" => "0",
        "tipo" => "1",
        "status" => "1",
        "data_emissao" => "2017-12-27T17:43:14-03:00",
        "tomador" => [
            "cnpj" => "12345678901234",
            "cpf" => null,
            "im" => null,
            "razao_social" => "Fake Tecnologia Ltda",
            "endereco" => [
                "logradouro" => "Rua New Horizon",
                "numero" => "16",
                "complemento" => null,
                "bairro" => "Jardim America",
                "codigo_municipio" => "4119905",
                "uf" => "PR",
                "cep" => "81530945"
            ]
        ],
        "servico" => [
            "codigo_municipio" => "4119905",
            "itens" => [
                [
                    "codigo_tributacao_municipio" => "10500",
                    "discriminacao" => "Exemplo Serviço",
                    "valor_servicos" => "1.00",
                    "valor_pis" => "1.00",
                    "valor_cofins" => "1.00",
                    "valor_inss" => "1.00",
                    "valor_ir" => "1.00",
                    "valor_csll" => "1.00",
                    "valor_outras" => "1.00",
                    "valor_aliquota" => "1.00",
                    "valor_desconto_incondicionado" => "1.00"
                ]
            ]
        ],
        "intermediario" => [
            "cnpj" => "12345678901234",
            "cpf" => null,
            "im" => null,
            "razao_social" => "Fake Tecnologia Ltda"
        ],
        "obra" => [
            "codigo" => "2222",
            "art" => "1111"
        ]
    ];

    // Salvar as informações da NFSe em seu banco de dados
    // Reservar a numeração da NFSe e alterar o status para (Não enviada)

    // Enviar a NFSe para API
    $resp = $nfse->cria($payload);

    if ($resp->sucesso) {
        // Essa condição verifica se a NFSe foi enviada para processamento
        // Altere o status da NFSe para (Em processamento)

        $chave = $resp->chave;
        sleep(15); // O Ideal é aguardar de 10 a 15 segundos para consultar a NFSe ou utilizar o WEBHOOK
        
        $payload = [
            "chave" => $chave
        ];
    
        // Consulta a NFSe
        $resp = $nfse->consulta($payload);
        
        // Verifica se a NFSe não está em processamento
        if ($resp->codigo != 5023) {
            if ($resp->sucesso) {
                // se a nota foi autorizada ela será retornada aqui
                // salvar as informações da NFSe em seu banco de dados e alterar o status para (Autorizada)
                var_dump($resp);
            } else {
                // se a nota foi rejeitada ela será retornada aqui
                // salvar as informações de erro da NFSe em seu banco de dados e alterar o status para (Rejeitada)
                var_dump($resp);
            }
        } else {
            // se a nota estiver em processamento ela será retornada aqui
            // salvar as informações da NFSe em seu banco de dados e alterar o status para (Em processamento)
            // RECOMENDAMOS UTILIZAR O WEBHOOK POIS EVITA DE SEU CLIENTE FICAR FAZENDO CONSULTAS
            var_dump($resp);
        }

    } else if (in_array($resp->codigo, [5001, 5002])) {
        // se a nota estiver com dados faltando ou dando erro ao gerar o XML ela será retornada aqui
        // salvar o status da NFSe como (Rejeitada/Erro) OBS: Não foi a prefeitura que rejeitou mas sim nossa API que existe campos obrigatórios que não foram preenchidos.
        // Salvar as informações de erro da NFSe e apresentar ao usuário
        var_dump($resp->erros);
    } else if ($resp->codigo == 5008) {
        // se a nota já foi criada ela será retornada aqui
        // ATENÇÃO: SE UTILIZADO INCORRETAMENTE PODE SOBREESCREVER DOCUMENTOS.
        
        // O procedimento obtém a chave da NFSe e consulta para verificar se a NFSe foi autorizada, rejeitada ou se ainda está em processamento
        // porém se no seu sistema tiver salvando os status da NFSe incorretamente pode sobreescrever documentos 

        $chave = $resp->chave;
        $payload = [
            "chave" => $chave
        ]; 

        // Vai realizar a consulta da NFSe para verificar o status da NFSe
        $resp = $nfse->consulta($payload);
        if ($resp->codigo != 5023) {
            if ($resp->sucesso) {
                // se a nota foi autorizada ela será retornada aqui
                // salvar as informações da NFSe em seu banco de dados e alterar o status para (Autorizada)
                var_dump($resp);
            } else {
                // se a nota foi rejeitada ela será retornada aqui
                // salvar as informações de erro da NFSe em seu banco de dados e alterar o status para (Rejeitada)
                var_dump($resp);
            }
        } else {
            // se a nota estiver em processamento ela será retornada aqui
            // salvar as informações da NFSe em seu banco de dados e alterar o status para (Em processamento)
            // RECOMENDAMOS UTILIZAR O WEBHOOK POIS EVITA DE SEU CLIENTE FICAR FAZENDO CONSULTAS
            var_dump($resp);
        }
    } else {
        // Se ocorrer qualquer outro erro será retornado aqui
        // salvar as informações de erro da NFSe em seu banco de dados e alterar o status para (Rejeitada)
        var_dump($resp);
    }
} catch (\Exception $e) {
    // Em caso de erros será lançado uma exceção com a mensagem de erro
    echo $e->getMessage();
}
