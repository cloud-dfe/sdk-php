<?php

require_once(__DIR__ . "/../../bootstrap.php");

use CloudDfe\SdkPHP\Vpo;

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

    $vpo = new Vpo($params);

    // Payload: Informações que serão enviadas para a API da CloudDFe

    // OBS: Não utilize o payload de exemplo abaixo, ele é apenas um exemplo. Consulte a documentação para construir o payload para sua aplicação.

    $resp = $vpo->cria([
        "numero" => "1001",
        "identificacao" => "VIAGEM-77",
        "emissor" => "SEMPARAR",
        "data_inicio" => "2026-11-10 08:00:00",
        "data_fim" => "2026-11-12 18:00:00",
        "rota" => [
            "id" => "58222",
            "indice" => "0",
            "distancia_km" => "45.279",
            "tipo_combustivel" => "DIESEL"
        ],
        "veiculo" => [
            "placa" => "BCD2E34",
            "categoria" => "7"
        ],
        "transportador" => [
            "cnpj" => "22333444000181",
            "rntrc" => "87654321",
            "nome" => "TRANSPORTADOR EXEMPLO LTDA"
        ],
        "cte" => "1234"
    ]);

    echo "<pre>";
    print_r($resp);
    echo "</pre>";

    if ($resp->sucesso) {
        if ($resp->codigo == 5023) { // lote em processamento
            // aguardar e consultar pela chave ou esperar o webhook notificar quando a AILOG processar
        } else {
            // VPO comprado
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
