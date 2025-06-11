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
        "xml" => base64_encode(file_get_contents("caminho_do_arquivo.xml"))
    ];

    // Chamada para a função de importação de CTe

    $resp = $cte->importa($payload);

    // Visualização do retorno

    echo "<pre>";
    print_r($resp);
    echo "</pre>";
} catch (\Exception $e) {

    // Caso ocorra algum erro na execução do código acima, será exibido a mensagem de erro na tela

    echo $e->getMessage();
}
