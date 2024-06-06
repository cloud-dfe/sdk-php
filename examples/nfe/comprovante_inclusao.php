<?php

require_once(__DIR__ . "/../../bootstrap.php");

use CloudDfe\SdkPHP\Nfe;

/**
 * Este exemplo de uma chamada a API usando este SDK
 *
 * Este método tenta registrar o evento de Comprovante de Entrega (canhoto eletônico)
 *
 * NOTA: somente NFe autorizadas em nossa base de dados podem ser usadas para a geração do comprovante de entrega
 */
try {
    $params = [
        "token" => "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbXAiOiJ0b2tlbl9leGVtcGxvIiwidXNyIjoidGsiLCJ0cCI6InRrIn0.Tva_viCMCeG3nkRYmi_RcJ6BtSzui60kdzIsuq5X-sQ",
        "ambiente" => Nfe::AMBIENTE_HOMOLOGACAO,
        "options" => [
            "debug" => false,
            "timeout" => 60,
            "port" => 443,
            "http_version" => CURL_HTTP_VERSION_NONE
        ]
    ];
    $nfe = new Nfe($params);

    $payload = [
        "chave" => "123456789012345678901234567890123456789012345678901234", //Obrigatoria Chave de acesso
        "registra" => [ //dados opcionais no caso de cancelamento
            "data" => "2021-10-12T12:22:33-03:00", //Obrigatório Data e Hora do recebimento. (dhEntrega)
            "imagem" => "lUHJvYyB2ZXJzYW....", //Opcional Base64 da imagem capturada do Comprovante de Entrega da nNF-e ou uma string de referencia
            "recebedor_documento" => "123456789 SSPRJ", //Obrigatório Número do documento de identificação da pessoa que assinou o Comprovante de Entrega da NF-e. (nDoc)
            "recebedor_nome" => "NOME TESTE", //Obrigatório Nome da pessoa que assinou o Comprovante de Entrega da NF-e. (xNome)
            "coordenadas" => [ //dados opcionais no caso de cancelamento
                "latitude" => -23.628360, //Latitude do ponto de entrega, com 6 decimais. (latGPS)
                "longitude" => -46.622109, //Longitude do ponto de entrega, com 6 decimais. (longGPS)
            ]
        ]
    ];
    $resp = $nfe->comprovante($payload);

    echo "<pre>";
    print_r($resp);
    echo "</pre>";

} catch (\Exception $e) {
    echo $e->getMessage();
}
