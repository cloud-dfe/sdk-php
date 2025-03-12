<?php

require_once(__DIR__ . "/../../bootstrap.php");

use CloudDfe\SdkPHP\Gnre;

/**
 * Este exemplo de uma chamada a API usando este SDK
 *
 * Este método cria uma GNRe
 */
try {

    // Variáveis para definição de configurações iniciais para o uso da SDK
    // Token: Token do emitente (distribuído pela CloudDFe se baseando no ambiente: homologação/produção)
    // Ambiente: Ambiente do qual o serviço vai ser executado (1- Produção / 2- Homologação)
    // Options: Opções para configuração da chamada da SDK
    // Debug: Habilita ou desabilita mensagens de debug (Por enquanto sem efeito)
    // Timeout: Tempo de espera para a execução da chamada
    // Port: Porta de comunicação
    // Http_version: Versão do HTTP (Específico para a comunicação utilizando PHP)

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
    // OBS: NÃO UTILIZE O PAYLOAD DE EXEMPLO, ELE É APENAS UM EXEMPLO. CONSULTE A DOCUMENTAÇÃO PARA CONSTRUIR O PAYLOAD PARA SUA APLICAÇÃO.

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

    // Enviar a GNRe para API
    $resp = $gnre->cria($payload);
    echo "<pre>";
    print_r($resp);
    echo "</pre>";

    if ($resp->sucesso) {
        // Essa condição verifica se a GNRe foi enviada para processamento
        // Altere o status da GNRe para (Em processamento)

        $chave = $resp->chave;
        sleep(15); // O Ideal é aguardar de 10 a 15 segundos para consultar a GNRe ou utilizar o WEBHOOK
        
        $payload = [
            "chave" => $chave
        ];
    
        // Consulta a GNRe
        $resp = $gnre->consulta($payload);
        
        // Verifica se a GNRe não está em processamento
        if ($resp->codigo != 5023) {
            if ($resp->sucesso) {
                // se a GNRe foi autorizada ela será retornada aqui
                // salvar as informações da GNRe em seu banco de dados e alterar o status para (Autorizado)
                var_dump($resp);
            } else {
                // se a GNRe foi rejeitada ela será retornada aqui
                // salvar as informações de erro da GNRe em seu banco de dados e alterar o status para (Rejeitado)
                var_dump($resp);
            }
        } else {
            // se a GNRe estiver em processamento ela será retornada aqui
            // salvar as informações da GNRe em seu banco de dados e alterar o status para (Em processamento)
            // RECOMENDAMOS UTILIZAR O WEBHOOK POIS EVITA DE SEU CLIENTE FICAR FAZENDO CONSULTAS
            var_dump($resp);
        }

    } else if (in_array($resp->codigo, [5001, 5002])) {
        // se a GNRe estiver com dados faltando ou dando erro ao gerar o XML ela será retornada aqui
        // salvar o status da GNRe como (Rejeitado/Erro) OBS: Não foi a SEFAZ que rejeitou mas sim nossa API que existe campos obrigatórios que não foram preenchidos.
        // Salvar as informações de erro da GNRe e apresentar ao usuário
        var_dump($resp->erros);
    } else if ($resp->codigo == 5008) {
        // se a GNRe já foi criada ela será retornada aqui
        // ATENÇÃO: SE UTILIZADO INCORRETAMENTE PODE SOBREESCREVER DOCUMENTOS.
        
        // O procedimento obtém a chave da GNRe e consulta para verificar se a GNRe foi autorizada, rejeitada ou se ainda está em processamento
        // porém se no seu sistema tiver salvando os status da GNRe incorretamente pode sobreescrever documentos 

        $chave = $resp->chave;
        $payload = [
            "chave" => $chave
        ]; 

        // Vai realizar a consulta da GNRe para verificar o status da GNRe
        $resp = $gnre->consulta($payload);
        if ($resp->codigo != 5023) {
            if ($resp->sucesso) {
                // se a GNRe foi autorizada ela será retornada aqui
                // salvar as informações da GNRe em seu banco de dados e alterar o status para (Autorizado)
                var_dump($resp);
            } else {
                // se a GNRe foi rejeitada ela será retornada aqui
                // salvar as informações de erro da GNRe em seu banco de dados e alterar o status para (Rejeitado)
                var_dump($resp);
            }
        } else {
            // se a GNRe estiver em processamento ela será retornada aqui
            // salvar as informações da GNRe em seu banco de dados e alterar o status para (Em processamento)
            // RECOMENDAMOS UTILIZAR O WEBHOOK POIS EVITA DE SEU CLIENTE FICAR FAZENDO CONSULTAS
            var_dump($resp);
        }
    } else {
        // Se ocorrer qualquer outro erro será retornado aqui
        // salvar as informações de erro da GNRe em seu banco de dados e alterar o status para (Rejeitado)
        var_dump($resp);
    }
} catch (\Exception $e) {
    // Em caso de erros será lançado uma exceção com a mensagem de erro
    echo $e->getMessage();
}
