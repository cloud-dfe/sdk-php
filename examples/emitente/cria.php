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

    // Instancia a classe Softhouse que possui métodos para realizar requisições a nossa API
    $softhouse = new Softhouse($configSDK);

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
