<?php

require_once(__DIR__ . "/../../bootstrap.php");

use CloudDfe\SdkPHP\Cte;

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

    // Instancia a classe CTe que possui métodos para realizar requisições a nossa API
    $cte = new Cte($configSDK);

    // Payload: Informações que serão enviadas para a API da CloudDFe

    // OBS: Não utilize o payload de exemplo abaixo, ele é apenas um exemplo. Consulte a documentação para construir o payload para sua aplicação.

    $payload = [
        "numero_inicial" => 1210,
        "numero_final" => 1210,
        "serie" => 1,
        "data_inicial" => "2019-12-01",
        "data_final" => "2019-12-31",
        "cancel_inicial" => "2019-12-01", // SE CASO QUEIRA PROCURAR POR CANCELAMENTO
        "cancel_final" => "2019-12-31",
        "status" => "1"
    ];

    // Chamada para o método busca na classe Cte

    $resp = $cte->busca($payload);

    // Visualização do retorno

    echo "<pre>";
    print_r($resp);
    echo "</pre>";
} catch (\Exception $e) {

    // Em caso de qualquer exceção, exibe a mensagem na tela

    echo $e->getMessage();
}
