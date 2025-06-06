<?php

require_once(__DIR__ . "/../../bootstrap.php");

use CloudDfe\SdkPHP\Nfe;

/**
 * Este exemplo de uma chamada a API usando este SDK
 *
 * Este método faz o envio de uma NFe
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

    $nfe = new Nfe($params);

    // Payload: Informações que serão enviadas para a API da CloudDFe

    // Reservar o numero e serie antes de enviar a NFe
    // OBS: O numero e serie devem ser reservados antes de enviar a NFe, caso contrario pode haver problemas de sobrescrição de NFe.

    // OBS: ESTE PAYLOAD CONTÉM APENAS OS CAMPOS OBRIGATORIOS. NO SEU PROJETO PODE HAVER CAMPOS ADICIONAIS PARA SEREM ADICIONADOS.
    // A lista completa de campos pode ser encontrada na documentação da API da [https://integranotas.com.br/doc/nfe]
    $payload = [
        "natureza_operacao" => "",
        "numero" => "", // OBTER O ULTIMO NUMERO FAZER O INCREMENTO E SALVAR O REGISTRO NA TABELA ANTES DE ENVIAR A NFE
        "serie" => "", // OBTER A ULTIMA SERIE NA TABELA (Não precisa alterar a serie, pois ela é estatica até que seja necessário alterar)
        "data_emissao" => "", 
        "tipo_operacao" => "",
        "finalidade_emissao" => "",
        "consumidor_final" => "",
        "presenca_comprador" => "",
        "destinatario" => [
            "cnpj" => "",
            "cpf" => "",
            "nome" => "",
            "indicador_inscricao_estadual" => "",
            "inscricao_estadual" => "",
            "inscricao_municipal" => "",
            "email" => "",
            "endereco" => [
                "logradouro" => "",
                "numero" => "",
                "complemento" => "",
                "bairro" => "",
                "codigo_municipio" => "",
                "nome_municipio" => "",
                "uf" => "",
                "cep" => "",
                "telefone" => ""
            ]
        ],
        "itens" => [], 
        "frete" => [
            "modalidade_frete" => ""
        ],
        "pagamento" => [
            "formas_pagamento" => [
                [
                    "meio_pagamento" => "",
                    "valor" => ""
                ]
            ]
        ]
    ];

    // Cria o array de itens
    $listaItens[] = [
        "numero_item" => "",
        "codigo_produto" => "",
        "origem" => "",
        "descricao" => "",
        "codigo_ncm" => "",
        "cfop" => "",
        "unidade_comercial" => "",
        "valor_unitario_comercial" => "",
        "valor_bruto" => "",
        "incluir_no_total" => "",
        "imposto" => [
            "pis" => [
                "situacao_tributaria" => ""
            ],
            "cofins" => [
                "situacao_tributaria" => ""
            ]
        ]
    ];
    foreach ($listaItens as $item) {
        $payload["itens"][] = $item;
    }

    // Enviar a NFe para API
    $resp = $nfe->cria($payload);

    if ($resp->sucesso) {
        // Salva a chave no banco de dados para receber depois o resultado se a nota foi autorizada ou rejeitada
        // OBS: A chave é o identificador para consultas futuras da NFe
        $chave = $resp->chave;
        
        /* Este é um exemplo de como consultar a NFe após o envio se caso você não quiser usar o Webhook
            
            sleep(15); // Aguarda 15 segundos para consultar a NFe, pois o processamento pode levar alguns segundos
            
            $payload = [
                "chave" => $chave
            ];

            $resp = $nfe->consulta($payload);
            
            if ($resp->codigo != 5023) {
                if ($resp->sucesso) {
                    // Aqui o retorno indica que a NFe foi autorizada.
                    var_dump($resp);
                } else {
                    // Aqui o retorno indica que a NFe foi rejeitada.
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
    echo $e->getMessage();
}
