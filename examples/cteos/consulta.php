<?php

require_once(__DIR__ . "/../../bootstrap.php");

use CloudDfe\SdkPHP\CteOS;

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

    // Criação de uma instância da classe CteOS

    $cte = new CteOS($params);

    // Payload: Informações que serão enviadas para a API da CloudDFe

    // OBS: Não utilize o payload de exemplo abaixo, ele é apenas um exemplo. Consulte a documentação para construir o payload para sua aplicação.

    $payload = [
        "chave" => "50000000000000000000000000000000000000000000"
    ];

    $resp = $cte->consulta($payload);

    // Visualização do retorno

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
    } else {
        // rejeição
        var_dump($resp);
    }
} catch (\Exception $e) {

    // Caso ocorra algum erro na execução do código acima, será exibido uma mensagem de erro

    echo $e->getMessage();
}
