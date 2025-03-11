<?php

require_once(__DIR__ . "/../../bootstrap.php");

use CloudDfe\SdkPHP\Cte;

/**
 * Este exemplo de uma chamada a API usando este SDK
 *
 * Este método faz o envio de um CTe
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

    $cte = new Cte($params);

    // Payload: Informações que serão enviadas para a API da CloudDFe
    // OBS: NÃO UTILIZE O PAYLOAD DE EXEMPLO, ELE É APENAS UM EXEMPLO. CONSULTE A DOCUMENTAÇÃO PARA CONSTRUIR O PAYLOAD PARA SUA APLICAÇÃO.

    $payload = [
        "cfop" => "5932",
        "natureza_operacao" => "PRESTACAO DE SERVIÇO",
        "numero" => "66",
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
            "cpf" => "01234567890",
            "inscricao_estadual" => null,
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
            "indicador_inscricao_estadual" => "9"
        ],
        "observacao" => ""
    ];

    // Enviar o CTe para API
    $resp = $cte->cria($payload);

    if ($resp->sucesso) {
        // Essa condição verifica se o CTe foi enviado para processamento
        // Altere o status do CTe para (Em processamento)

        $chave = $resp->chave;
        sleep(15); // O Ideal é aguardar de 10 a 15 segundos para consultar o CTe ou utilizar o WEBHOOK
        
        $payload = [
            "chave" => $chave
        ];
    
        // Consulta o CTe
        $resp = $cte->consulta($payload);
        
        // Verifica se o CTe não está em processamento
        if ($resp->codigo != 5023) {
            if ($resp->sucesso) {
                // se o CTe foi autorizado ele será retornado aqui
                // salvar as informações do CTe em seu banco de dados e alterar o status para (Autorizado)
                var_dump($resp);
            } else {
                // se o CTe foi rejeitado ele será retornado aqui
                // salvar as informações de erro do CTe em seu banco de dados e alterar o status para (Rejeitado)
                var_dump($resp);
            }
        } else {
            // se o CTe estiver em processamento ele será retornado aqui
            // salvar as informações do CTe em seu banco de dados e alterar o status para (Em processamento)
            // RECOMENDAMOS UTILIZAR O WEBHOOK POIS EVITA DE SEU CLIENTE FICAR FAZENDO CONSULTAS
            var_dump($resp);
        }

    } else if (in_array($resp->codigo, [5001, 5002])) {
        // se o CTe estiver com dados faltando ou dando erro ao gerar o XML ele será retornado aqui
        // salvar o status do CTe como (Rejeitado/Erro) OBS: Não foi a SEFAZ que rejeitou mas sim nossa API que existe campos obrigatórios que não foram preenchidos.
        // Salvar as informações de erro do CTe e apresentar ao usuário
        var_dump($resp->erros);
    } else if ($resp->codigo == 5008) {
        // se o CTe já foi criado ele será retornado aqui
        // ATENÇÃO: SE UTILIZADO INCORRETAMENTE PODE SOBREESCREVER DOCUMENTOS.
        
        // O procedimento obtém a chave do CTe e consulta para verificar se o CTe foi autorizado, rejeitado ou se ainda está em processamento
        // porém se no seu sistema tiver salvando os status do CTe incorretamente pode sobreescrever documentos 

        $chave = $resp->chave;
        $payload = [
            "chave" => $chave
        ]; 

        // Vai realizar a consulta do CTe para verificar o status do CTe
        $resp = $cte->consulta($payload);
        if ($resp->codigo != 5023) {
            if ($resp->sucesso) {
                // se o CTe foi autorizado ele será retornado aqui
                // salvar as informações do CTe em seu banco de dados e alterar o status para (Autorizado)
                var_dump($resp);
            } else {
                // se o CTe foi rejeitado ele será retornado aqui
                // salvar as informações de erro do CTe em seu banco de dados e alterar o status para (Rejeitado)
                var_dump($resp);
            }
        } else {
            // se o CTe estiver em processamento ele será retornado aqui
            // salvar as informações do CTe em seu banco de dados e alterar o status para (Em processamento)
            // RECOMENDAMOS UTILIZAR O WEBHOOK POIS EVITA DE SEU CLIENTE FICAR FAZENDO CONSULTAS
            var_dump($resp);
        }
    } else {
        // Se ocorrer qualquer outro erro será retornado aqui
        // salvar as informações de erro do CTe em seu banco de dados e alterar o status para (Rejeitado)
        var_dump($resp);
    }
} catch (\Exception $e) {
    // Em caso de erros será lançado uma exceção com a mensagem de erro
    echo $e->getMessage();
}
