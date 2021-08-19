<?php

require_once(__DIR__ . '/../../bootstrap.php');

use CloudDfe\SdkPHP\Emitente;
/**
 * Este exemplo de uma chamada a API usando este SDK
 *
 * Este método atualiza os dados do emitente e requer o TOKEN do próprio emitente para ser realizado.
 */
try {
    $params = [
        'token' => 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbXAiOjU0LCJ1c3IiOjIsInRwIjoyLCJpYXQiOjE1NzQyNjAyODB9.LfnKwlWiX0oJMrmUUDXeqpLpoz38LsavRDvY_q0PXD0',
        'ambiente' => Emitente::AMBIENTE_HOMOLOGACAO,
        'options' => [
            'debug' => false,
            'timeout' => 60,
            'port' => 443,
            'http_version' => CURL_HTTP_VERSION_NONE
        ]
    ];
    $emitente = new Emitente($params);

    $payload = [
        "nome" => 'EMPRESA TESTE2',
        "razao" => 'EMPRESA TESTE2',
//        "cnae" => '12369875',
//        "crt" => '1', // Regime tributário
//        "ie" => '12369875',
//        "im" => '12369875',
//        "suframa" => '12369875',
//        "csc" => '...', // token para emissão de NFCe
//        "cscid" => '000001',
//        "tar" => 'C92920029-12', // tar BPe
//        "login_prefeitura" => null,
//        "senha_prefeitura" => null,
//        "client_id_prefeitura" => null,
//        "client_secret_prefeitura" => null,
//        "telefone" => '46998895532',
//        "email" => 'empresa@teste.com',
//        "rua" => 'TESTE',
//        "numero" => '1',
//        "complemento" => 'NENHUM',
//        "bairro" => 'TESTE',
//        "municipio" => 'CIDADE TESTE', // IBGE
//        "cmun" => '5300108', // IBGE
//        "uf" => 'PR', // IBGE
//        "cep" => '85000100',
//        "logo" => 'useyn56j4mx35m5j6_JSHh734khjd...saasjda', // BASE 64
    ];
    //os payloads são sempre ARRAYS
    $resp = $emitente->atualiza($payload);

    echo "<pre>";
    print_r($resp);
    echo "</pre>";

} catch (\Exception $e) {
    echo $e->getMessage();
}
