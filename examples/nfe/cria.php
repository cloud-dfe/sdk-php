<?php
require_once(__DIR__ . "/../../bootstrap.php");

use CloudDfe\SdkPHP\Nfe;

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

    // Instancia a classe Nfe que possui métodos para realizar requisições a nossa API
    $nfe = new Nfe($configSDK);

    // Conforme sua aplicação, você precisa ter salvo o ultimo número e série da NFe para fazer o incremento e reservar o número e série antes de enviar a NFe.
    // Motivo: pois através deles você consegue corrigir uma NFe caso ocorra algum erro ou rejeição, e também para evitar concorrência de números.
    // OBS: A série é um campo que não precisa ser alterado, pois ela é estática até que seja necessário alterar.
    $numero = 1; // Obtém do banco o numero da NFe.
    $serie = 1; // Série da NFe

    // Payload seria o layout com todos os dados necessários para emitir uma NFe.
    // A lista completa de campos pode ser encontrada na documentação da API da [https://integranotas.com.br/doc/nfe]
    // OBS: ESTE PAYLOAD CONTÉM APENAS OS CAMPOS OBRIGATORIOS. NO SEU PROJETO PODE PRECISAR DE CAMPOS ADICIONAIS PARA SEREM ADICIONADOS.
    $payload = [
        "natureza_operacao" => "",
        "numero" => $numero,
        "serie" => $serie,
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

    $dados = []; // Aqui vai ser a chamada para buscar os dados dos itens que serão enviados na NFe.
    $listaItens = []; // Está lista vai conter os itens e as informações necessárias para serem enviados na NFe.

    foreach ($dados as $i => $produto) {
        $listaItens[] = [
            "numero_item" => $i + 1,
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
                "pis" => [ "situacao_tributaria" => "" ],
                "cofins" => [ "situacao_tributaria" => "" ]
            ]
        ];
    }

    // Enviar a NFe para API
    $resp = $nfe->cria($payload);

    if ($resp->sucesso) {
        // Ao entrar nesse bloco significa que a NFSe foi para o provedor e aguarda processamento.

        // Salva a chave no banco de dados para receber depois o resultado se a nota foi autorizada ou rejeitada
        // OBS: A chave é o identificador para consultas futuras da NFe
        $chave = $resp->chave;
        
        /* Este é um exemplo de como consultar a NFe após o envio se caso você não poder usar o Webhook.
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
    // Em caso de erros será lançado uma exceção com a mensagem de erro
    echo $e->getMessage();
}
