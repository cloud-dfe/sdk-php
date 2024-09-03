<?php

require_once(__DIR__ . "/../../bootstrap.php");

use CloudDfe\SdkPHP\Softhouse;

/**
 * Operações da SOFTHOUSE
 *
 * Este método cria um novo emitente no portifolio da softhouse
 *
 * NOTA: estas operações devem ser realizadas apenas com o TOKEN da softhouse
 */
try {

    // Variaveis para definição de configurações iniciais para o uso da SDK
    // Token: Token do emitente (distribuído pela CloudDFe se baseando no ambiente: homologação/produção)
    // Ambiente: Ambiente do qual o serviço vai ser executado (homologação/produção)
    // Options: Opções para configuração da chamada da SDK
    // Debug: Habilita ou desabilita mensagens de debug (Por enquando sem efeito)
    // Timeout: Tempo de espera para a execução da chamada
    // Port: Porta de comunicação
    // Http_version: Versão do HTTP (Especifico para a comunicação utilizando PHP)

    $params = [
        "token" => "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbXAiOiJ0b2tlbl9leGVtcGxvIiwidXNyIjoidGsiLCJ0cCI6InRrIn0.Tva_viCMCeG3nkRYmi_RcJ6BtSzui60kdzIsuq5X-sQ",
        "ambiente" => Softhouse::AMBIENTE_HOMOLOGACAO,
        "options" => [
            "debug" => false,
            "timeout" => 60,
            "port" => 443,
            "http_version" => CURL_HTTP_VERSION_NONE
        ]
    ];

    $softhouse = new Softhouse($params);

    // Payload: Informações que serão enviadas para a API da CloudDFe

    // OBS: Não utilize o payload de exemplo abaixo, ele é apenas um exemplo. Consulte a documentação para construir o payload para sua aplicação.

    $payload = [
        "nome" => "EMPRESA TESTE",
        "razao" => "EMPRESA TESTE",
        "cnpj" => "47853098000193",
        "cpf" => "12345678901",
        "cnae" => "12369875",
        "crt" => "1", // Regime tributário
        "ie" => "12369875",
        "im" => "12369875",
        "suframa" => "12369875",
        "csc" => "...", // token para emissão de NFCe
        "cscid" => "000001",
        "tar" => "C92920029-12", // tar BPe
        "login_prefeitura" => null,
        "senha_prefeitura" => null,
        "client_id_prefeitura" => null,
        "client_secret_prefeitura" => null,
        "telefone" => "46998895532",
        "email" => "empresa@teste.com",
        "rua" => "TESTE",
        "numero" => "1",
        "complemento" => "NENHUM",
        "bairro" => "TESTE",
        "municipio" => "CIDADE TESTE", // IBGE
        "cmun" => "5300108", // IBGE
        "uf" => "PR", // IBGE
        "cep" => "85000100",
        "logo" => "useyn56j4mx35m5j6_JSHh734khjd...saasjda", // BASE 64
        "plano" => "Emitente",
        "documentos" => [
            "nfe" => true,
            "nfce" => true,
            "nfse" => true,
            "mdfe" => true,
            "cte" => true,
            "cteos" => true,
            "bpe" => true,
            "dfe_nfe" => true,
            "dfe_cte" => true,
            "sintegra" => true,
            "gnre" => true
        ]
    ];

    $resp = $softhouse->criaEmitente($payload);

    echo "<pre>";
    print_r($resp);
    echo "</pre>";
} catch (\Exception $e) {

    // Em caso de erros será lançado uma exceção com a mensagem de erro

    echo $e->getMessage();
}
