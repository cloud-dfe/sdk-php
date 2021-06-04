<?php

require_once(__DIR__ . '/../../bootstrap.php');

use CloudDfe\SdkC\Softhouse;
/**
 * Operações da SOFTHOUSE
 *
 * Este método cria um novo emitente no portifolio da softhouse
 *
 * NOTA: estas operações devem ser realizadas apenas com o TOKEN da softhouse
 */
try {
    $params = [
        'token' => 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbXAiOjcwLCJ1c3IiOiIyIiwidHAiOjIsImlhdCI6MTU4MDkzNzM3MH0.KvSUt2x8qcu4Rtp2XNTOINqR',
        'ambiente' => Softhouse::AMBIENTE_HOMOLOGACAO,
        'options' => [
            'debug' => false,
        ]
    ];
    $softhouse = new Softhouse($params);

    $payload = [
        "nome" => 'EMPRESA TESTE',
        "razao" => 'EMPRESA TESTE',
        "cnpj" => '47853098000193',
        "cpf" => '12345678901',
        "cnae" => '12369875',
        "crt" => '1', // Regime tributário
        "ie" => '12369875',
        "im" => '12369875',
        "suframa" => '12369875',
        "csc" => '...', // token para emissão de NFCe
        "cscid" => '000001',
        "tar" => 'C92920029-12', // tar BPe
        "login_prefeitura" => null,
        "senha_prefeitura" => null,
        "client_id_prefeitura" => null,
        "client_secret_prefeitura" => null,
        "aliquota_simples" => null,
        "telefone" => '46998895532',
        "email" => 'empresa@teste.com',
        "rua" => 'TESTE',
        "numero" => '1',
        "complemento" => 'NENHUM',
        "bairro" => 'TESTE',
        "municipio" => 'CIDADE TESTE', // IBGE
        "cmun" => '5300108', // IBGE
        "uf" => 'PR', // IBGE
        "cep" => '85000100',
        "logo" => 'useyn56j4mx35m5j6_JSHh734khjd...saasjda', // BASE 64
        "plano" => 'Emitente',
        "documentos" => [
            "nfe" => true,
            "nfce" => true,
            "nfse" => true,
            "mdfe" => true,
            "cte" => true,
            "cteos" => true,
            "bpe" => true
        ]
    ];
    $resp = $softhouse->criaEmitente($payload);

    echo "<pre>";
    print_r($resp);
    echo "</pre>";

} catch (\Exception $e) {
    echo $e->getMessage();
}
