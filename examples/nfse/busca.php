<?php

require_once(__DIR__ . '/../../bootstrap.php');

use CloudDfe\SdkPHP\Nfse;

/**
 * Este exemplo de uma chamada a API usando este SDK
 *
 * Este método recupera as NFSe registradas em nossa base de dados que atendam ao paramtros informados
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

    //dados para busca de NFSe
    $payload = [
        "numero_rps_inicial" => 15,
        "numero_rps_final" => 15,
        "serie_rps" => "0",
        //"numero_nfse_inicial" => 1210,
        //"numero_nfse_final" => 1210,
        //"data_inicial" => "2019-12-01", // Autorização
        //"data_final" => "2019-12-31",
        //"cancel_inicial" => "2019-12-01", // Cancelamento
        //"cancel_final" => "2019-12-31"
    ];
    $resp = $nfse->busca($payload);

    echo "<pre>";
    print_r($resp);
    echo "</pre>";

} catch (\Exception $e) {
    echo $e->getMessage();
}
