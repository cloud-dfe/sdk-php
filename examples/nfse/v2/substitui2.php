<?php

require_once(__DIR__ . "/../../bootstrap.php");

use CloudDfe\SdkPHP\Nfse;

/**
 * Este exemplo de uma chamada a API usando este SDK
 *
 * Faz o cancelamento da nota passada no campo chave e substitui por uma nova nota fiscal na prefeitura, cancelado a nota original na API.
 *
 * NOTA: os dados necessários variam de acordo com o provedor de cada prefeitura
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
        "version" => 2,
        "options" => [
            "debug" => false,
            "timeout" => 60,
            "port" => 443,
            "http_version" => CURL_HTTP_VERSION_NONE
        ]
    ];

    $nfse = new Nfse($params);
    //dados do RPS para emissão da NFSe

    // Payload: Informações que serão enviadas para a API da CloudDFe

    // OBS: Não utilize o payload de exemplo abaixo, ele é apenas um exemplo. Consulte a documentação para construir o payload para sua aplicação.

    $payload = [ // AVISO: PAYLOAD EXEMPLO VERIFICA A DOCUMENTAÇÃO PARA CRIAR CONFORME O SEU MUNICÍPIO
        "chave" => "50000000000000000000000000000000000000000000",
        "codigo_cancelamento" => "2",
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

    $resp = $nfse->substitui($payload);
    echo "<pre>";
    print_r($resp);
    echo "</pre>";
} catch (\Exception $e) {

    // Em caso de erros será lançado uma exceção com a mensagem de erro

    echo $e->getMessage();
}
