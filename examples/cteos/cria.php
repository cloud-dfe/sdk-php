<?php

require_once(__DIR__ . "/../../bootstrap.php");

use CloudDfe\SdkPHP\CteOS;

/**
 * Este exemplo de uma chamada a API usando este SDK
 *
 * Este método faz o envio de um CTeOS
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

    $cteos = new CteOS($params);

    // Payload: Informações que serão enviadas para a API da CloudDFe
    // OBS: NÃO UTILIZE O PAYLOAD DE EXEMPLO, ELE É APENAS UM EXEMPLO. CONSULTE A DOCUMENTAÇÃO PARA CONSTRUIR O PAYLOAD PARA SUA APLICAÇÃO.

    $payload = [
        "cfop" => "5353",
        "natureza_operacao" => "PRESTACAO DE SERVICO",
        "numero" => "64",
        "serie" => "1",
        "data_emissao" => "2020-11-24T03:00:00-03:00",
        "tipo_operacao" => "0",
        "codigo_municipio_envio" => "2408003",
        "nome_municipio_envio" => "MOSSORO",
        "uf_envio" => "RN",
        "tipo_servico" => "6",
        "codigo_municipio_inicio" => "2408003",
        "nome_municipio_inicio" => "Mossoro",
        "uf_inicio" => "RN",
        "codigo_municipio_fim" => "2408003",
        "nome_municipio_fim" => "Mossoro",
        "uf_fim" => "RN",
        "valores" => [
            "servico" => "0.00",
            "valor_total" => "0.00",
            "valor_receber" => "0.00",
            "quantidade" => "10.00"
        ],
        "imposto" => [
            "icms" => [
                "situacao_tributaria" => "99",
                "valor_base_calculo" => "0.00",
                "aliquota" => "12.00",
                "valor" => "0.00",
                "aliquota_reducao_base_calculo" => "50.00"
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
            "indicador_inscricao_estadual" => "9",
            "cpf" => "01234567890",
            "inscricao_estadual" => null,
            "nome" => "EMPRESA MODELO",
            "razao_social" => "EMPRESA MODELO",
            "telefone" => "8499995555",
            "endereco" => [
                "logradouro" => "AVENIDA TESTE",
                "numero" => "444",
                "bairro" => "CENTRO",
                "codigo_municipio" => "2408003",
                "nome_municipio" => "Mossoro",
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

    // Enviar o CTeOS para API
    $resp = $cteos->cria($payload);

    if ($resp->sucesso) {
        // Essa condição verifica se o CTeOS foi enviado para processamento
        // Altere o status do CTeOS para (Em processamento)

        $chave = $resp->chave;
        sleep(15); // O Ideal é aguardar de 10 a 15 segundos para consultar o CTeOS ou utilizar o WEBHOOK
        
        $payload = [
            "chave" => $chave
        ];
    
        // Consulta o CTeOS
        $resp = $cteos->consulta($payload);
        
        // Verifica se o CTeOS não está em processamento
        if ($resp->codigo != 5023) {
            if ($resp->sucesso) {
                // se o CTeOS foi autorizado ele será retornado aqui
                // salvar as informações do CTeOS em seu banco de dados e alterar o status para (Autorizado)
                var_dump($resp);
            } else {
                // se o CTeOS foi rejeitado ele será retornado aqui
                // salvar as informações de erro do CTeOS em seu banco de dados e alterar o status para (Rejeitado)
                var_dump($resp);
            }
        } else {
            // se o CTeOS estiver em processamento ele será retornado aqui
            // salvar as informações do CTeOS em seu banco de dados e alterar o status para (Em processamento)
            // RECOMENDAMOS UTILIZAR O WEBHOOK POIS EVITA DE SEU CLIENTE FICAR FAZENDO CONSULTAS
            var_dump($resp);
        }

    } else if (in_array($resp->codigo, [5001, 5002])) {
        // se o CTeOS estiver com dados faltando ou dando erro ao gerar o XML ele será retornado aqui
        // salvar o status do CTeOS como (Rejeitado/Erro) OBS: Não foi a SEFAZ que rejeitou mas sim nossa API que existe campos obrigatórios que não foram preenchidos.
        // Salvar as informações de erro do CTeOS e apresentar ao usuário
        var_dump($resp->erros);
    } else if ($resp->codigo == 5008) {
        // se o CTeOS já foi criado ele será retornado aqui
        // ATENÇÃO: SE UTILIZADO INCORRETAMENTE PODE SOBREESCREVER DOCUMENTOS.
        
        // O procedimento obtém a chave do CTeOS e consulta para verificar se o CTeOS foi autorizado, rejeitado ou se ainda está em processamento
        // porém se no seu sistema tiver salvando os status do CTeOS incorretamente pode sobreescrever documentos 

        $chave = $resp->chave;
        $payload = [
            "chave" => $chave
        ]; 

        // Vai realizar a consulta do CTeOS para verificar o status do CTeOS
        $resp = $cteos->consulta($payload);
        if ($resp->codigo != 5023) {
            if ($resp->sucesso) {
                // se o CTeOS foi autorizado ele será retornado aqui
                // salvar as informações do CTeOS em seu banco de dados e alterar o status para (Autorizado)
                var_dump($resp);
            } else {
                // se o CTeOS foi rejeitado ele será retornado aqui
                // salvar as informações de erro do CTeOS em seu banco de dados e alterar o status para (Rejeitado)
                var_dump($resp);
            }
        } else {
            // se o CTeOS estiver em processamento ele será retornado aqui
            // salvar as informações do CTeOS em seu banco de dados e alterar o status para (Em processamento)
            // RECOMENDAMOS UTILIZAR O WEBHOOK POIS EVITA DE SEU CLIENTE FICAR FAZENDO CONSULTAS
            var_dump($resp);
        }
    } else {
        // Se ocorrer qualquer outro erro será retornado aqui
        // salvar as informações de erro do CTeOS em seu banco de dados e alterar o status para (Rejeitado)
        var_dump($resp);
    }
} catch (\Exception $e) {
    // Em caso de erros será lançado uma exceção com a mensagem de erro
    echo $e->getMessage();
}
