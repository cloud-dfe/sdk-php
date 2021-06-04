<?php

require_once(__DIR__ . '/../../bootstrap.php');

use CloudDfe\SdkPHP\Nfe;

/**
 * Este exemplo de uma chamada a API usando este SDK
 *
 * Este método busca as NFe destinados ao CNPJ usando o controle de NSU da SEFAZ.
 *
 * NOTA: usar este método tem consequências e é bastante limitado, pois será feita uma unica busca e poderá retornar a chave até 50 documentos e não pode ser realizada em intervalos menos que 5 minutos.
 */
try {
    $params = [
        'token' => 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbXAiOjcwLCJ1c3IiOiIyIiwidHAiOjIsImlhdCI6MTU4MDkzNzM3MH0.KvSUt2x8qcu4Rtp2XNTOINqR',
        'ambiente' => Nfe::AMBIENTE_HOMOLOGACAO,
        'options' => [
            'debug' => false,
        ]
    ];
    $nfe = new Nfe($params);


    //informar o período desejado de backup


    $payload = [
        'ultimo_nsu' => '10',
        'numero_nsu' => '0',
        'eventos' => false
    ];
    $resp = $nfe->recebidas($payload);

    echo "<pre>";
    print_r($resp);
    echo "</pre>";

} catch (\Exception $e) {
    echo $e->getMessage();
}
