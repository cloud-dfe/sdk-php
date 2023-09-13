<?php

require_once(__DIR__ . '/../../bootstrap.php');

use CloudDfe\SdkPHP\Nfse;

/**
 * Este exemplo de uma chamada a API usando este SDK
 *
 * Este método solicita a criação de uma NFSe, pode ser retornado sucesso com os dados da NFSe emitida ou erros
 * no caso de erros o registro dessa NFSe será deletado e assim que os erros forem corrigidos uma nova NFSe poderá ser criada
 *
 * NOTA: os dados necessários variam de acordo com o provedor de cada prefeitura
 */
try {
    $params = [
        'token' => 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbXAiOjEyNSwidXNyIjoyLCJ0cCI6MiwiaWF0IjoxNjIzOTQwNjg5fQ.Ag3y6wTmiCFb9LExLcc57WfUnP34kQM8jj2Vx91DZL8',
        'ambiente' => Nfse::AMBIENTE_HOMOLOGACAO,
        'options' => [
            'debug' => false,
            'timeout' => 60,
            'port' => 443,
            'http_version' => CURL_HTTP_VERSION_NONE
        ]
    ];
    $nfse = new Nfse($params);
    //dados do RPS para emissão da NFSe
    $payload = [
        "numero" => "1",
        "serie" => "0",
        "tipo" => "1",
        "status" => "1",
        "data_emissao" => "2017-12-27T17:43:14-03:00",
        "tomador" => [
            "cnpj" => "12345678901234",
            "cpf" => null,
            "im" => null,
            "razao_social" => "Fake Tecnologia Ltda",
            "endereco" => [
                "logradouro" => "Rua New Horizon",
                "numero" => "16",
                "complemento" => null,
                "bairro" => "Jardim America",
                "codigo_municipio" => "4119905",
                "uf" => "PR",
                "cep" => "81530945"
            ]
        ],
        "servico" => [
            "codigo_tributacao_municipio" => "10500",
            "discriminacao" => "Exemplo Serviço",
            "codigo_municipio" => "4119905",
            "valor_servicos" => "1.00",
            "valor_pis" => "1.00",
            "valor_cofins" => "1.00",
            "valor_inss" => "1.00",
            "valor_ir" => "1.00",
            "valor_csll" => "1.00",
            "valor_outras" => "1.00",
            "valor_aliquota" => "1.00",
            "valor_desconto_incondicionado" => "1.00"
        ],
        "intermediario" => [
            "cnpj" => "12345678901234",
            "cpf" => null,
            "im" => null,
            "razao_social" => "Fake Tecnologia Ltda"
        ],
        "obra" => [
            "codigo" => "2222",
            "art" => "1111"
        ]
    ];
    $resp = $nfse->cria($payload);
    echo "<pre>";
    print_r($resp);
    echo "</pre>";
    if ($resp->sucesso) {
        $chave = $resp->chave;
        sleep(60);
        $tentativa = 1;
        while ($tentativa <= 5) {
            $payload = [
                'chave' => $chave
            ];
            $resp = $nfse->consulta($payload);
            if ($resp->codigo != 5023) {
                if ($resp->sucesso) {
                    // autorizado
                    var_dump($resp);
                    break;
                } else {
                    // rejeição
                    var_dump($resp);
                    break;
                }
            }
            sleep(5);
            $tentativa++;
        }
    } else if (in_array($resp->codigo, [5001, 5002])) {
        // erro nos campos
        var_dump($resp->erros);
    } else if ($resp->codigo == 5008 or $resp->codigo >= 7000) {
        $chave = $resp->chave;
        // >= 7000 erro de timout ou de conexão
        // 5008 documento já criado
        var_dump($resp);
        $payload = [
            'chave' => $chave
        ];
        // recomendamos fazer a consulta pela chave para sincronizar o documento
        $resp = $nfse->consulta($payload);
        if ($resp->sucesso) {
            if ($resp->codigo == 5023) {
                // autorizado
                var_dump($resp);
            }
        } else {
            // rejeição
            var_dump($resp);
        }
    } else {
        // rejeição
        var_dump($resp);
    }
} catch (\Exception $e) {
    echo $e->getMessage();
}
