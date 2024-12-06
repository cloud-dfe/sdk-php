<?php

require_once(__DIR__ . "/../../bootstrap.php");

use CloudDfe\SdkPHP\Mdfe;

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

    $mdfe = new Mdfe($params);

    // Payload: Informações que serão enviadas para a API da CloudDFe

    // OBS: Não utilize o payload de exemplo abaixo, ele é apenas um exemplo. Consulte a documentação para construir o payload para sua aplicação.

    $resp = $mdfe->consulta([
        "chave" => "50000000000000000000000000000000000000000000"
    ]);

    echo "<pre>";
    print_r($resp);
    echo "</pre>";

    if ($resp->sucesso) {
        if ($resp->codigo == 5023) { // lote em processamento
            // aguardar a chave e consultar/ou esperar o webhook notificar quando for processada pela sefaz
        } else {
            // autorizado
            var_dump($resp);
            return $resp;
        }
    } else if (in_array($resp->codigo, [5001, 5002])) {
        // erro nos campos
        var_dump($resp->erros);
    } else if ($resp->codigo >= 7000) {
        $chave = $resp->chave;
        // >= 7000 indica problemas de comunicacao com a sefaz
        var_dump($resp);
        $payload = [
            "chave" => $chave
        ];
        // recomendamos fazer a consulta pela chave para sincronizar o documento
        $resp = $mdfe->consulta($payload);
        if ($resp->codigo != 5023) {
            if ($resp->sucesso) {
                // autorizado
                var_dump($resp);
                return $resp;
            } else {
                // rejeição
                var_dump($resp);
                return $resp;
            }
        } else {
            // em processamento
            var_dump($resp);
            return $resp;
        }
    } else {
        // rejeição
        var_dump($resp);
    }
} catch (\Exception $e) {

    // Em caso de erros será lançado uma exceção com a mensagem de erro

    echo $e->getMessage();
}
