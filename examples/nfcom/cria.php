<?php

require_once(__DIR__ . "/../../bootstrap.php");

use CloudDfe\SdkPHP\Nfcom;

/**
 * Este exemplo de uma chamada a API usando este SDK
 *
 * Este método cria uma nfcom
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

    $nfcom = new Nfcom($params);

    // Payload: Informações que serão enviadas para a API da CloudDFe

    // OBS: NÃO UTILIZE O PAYLOAD DE EXEMPLO, ELE É APENAS UM EXEMPLO. CONSULTE A DOCUMENTAÇÃO PARA CONSTRUIR O PAYLOAD PARA SUA APLICAÇÃO.

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

    // Salvar as informações da Nfcom em seu banco de dados
    // Reservar a numeração da Nfcom e alterar o status para (Não enviada)

    // Enviar a Nfcom para API
    $resp = $nfcom->cria($payload);

    if ($resp->sucesso) {
        // Essa condição verifica se a Nfcom foi enviada para processamento
        // Altere o status da Nfcom para (Em processamento)

        $chave = $resp->chave;
        sleep(15); // O Ideal é aguardar de 10 a 15 segundos para consultar a Nfcom ou utilizar o WEBHOOK
        
        $payload = [
            "chave" => $chave
        ];
    
        // Consulta a Nfcom
        $resp = $nfcom->consulta($payload);
        
        // Verifica se a Nfcom não está em processamento
        if ($resp->codigo != 5023) {
            if ($resp->sucesso) {
                // se a nota foi autorizada ela será retornada aqui
                // salvar as informações da Nfcom em seu banco de dados e alterar o status para (Autorizada)
                var_dump($resp);
            } else {
                // se a nota foi rejeitada ela será retornada aqui
                // salvar as informações de erro da Nfcom em seu banco de dados e alterar o status para (Rejeitada)
                var_dump($resp);
            }
        } else {
            // se a nota estiver em processamento ela será retornada aqui
            // salvar as informações da Nfcom em seu banco de dados e alterar o status para (Em processamento)
            // RECOMENDAMOS UTILIZAR O WEBHOOK POIS EVITA DE SEU CLIENTE FICAR FAZENDO CONSULTAS
            var_dump($resp);
        }

    } else if (in_array($resp->codigo, [5001, 5002])) {
        // se a nota estiver com dados faltando ou dando erro ao gerar o XML ela será retornada aqui
        // salvar o status da Nfcom como (Rejeitada/Erro) OBS: Não foi a SEFAZ que rejeitou mas sim nossa API que existe campos obrigatórios que não foram preenchidos.
        // Salvar as informações de erro da Nfcom e apresentar ao usuário
        var_dump($resp->erros);
    } else if ($resp->codigo == 5008) {
        // se a nota já foi criada ela será retornada aqui
        // ATENÇÃO: SE UTILIZADO INCORRETAMENTE PODE SOBREESCREVER DOCUMENTOS.
        
        // O procedimento obtém a chave da Nfcom e consulta para verificar se a Nfcom foi autorizada, rejeitada ou se ainda está em processamento
        // porém se no seu sistema tiver salvando os status da Nfcom incorretamente pode sobreescrever documentos 

        $chave = $resp->chave;
        $payload = [
            "chave" => $chave
        ]; 

        // Vai realizar a consulta da Nfcom para verificar o status da Nfcom
        $resp = $nfcom->consulta($payload);
        if ($resp->codigo != 5023) {
            if ($resp->sucesso) {
                // se a nota foi autorizada ela será retornada aqui
                // salvar as informações da Nfcom em seu banco de dados e alterar o status para (Autorizada)
                var_dump($resp);
            } else {
                // se a nota foi rejeitada ela será retornada aqui
                // salvar as informações de erro da Nfcom em seu banco de dados e alterar o status para (Rejeitada)
                var_dump($resp);
            }
        } else {
            // se a nota estiver em processamento ela será retornada aqui
            // salvar as informações da Nfcom em seu banco de dados e alterar o status para (Em processamento)
            // RECOMENDAMOS UTILIZAR O WEBHOOK POIS EVITA DE SEU CLIENTE FICAR FAZENDO CONSULTAS
            var_dump($resp);
        }
    } else {
        // Se ocorrer qualquer outro erro será retornado aqui
        // salvar as informações de erro da Nfcom em seu banco de dados e alterar o status para (Rejeitada)
        var_dump($resp);
    }
} catch (\Exception $e) {
    // Em caso de erros será lançado uma exceção com a mensagem de erro
    echo $e->getMessage();
}
