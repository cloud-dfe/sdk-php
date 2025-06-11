<?php

require_once(__DIR__ . "/../../bootstrap.php");

use CloudDfe\SdkPHP\CteOS;

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

    // Instancia a classe CTe-OS que possui métodos para realizar requisições a nossa API
    $cteos = new CteOS($configSDK);

    // Envio dos dados para a API da CloudDFe

    $resp = $cte->status();

    // Visualização do retorno

    echo "<pre>";
    print_r($resp);
    echo "</pre>";
} catch (\Exception $e) {

    // Caso ocorra algum erro, será exibido na tela

    echo $e->getMessage();
}
