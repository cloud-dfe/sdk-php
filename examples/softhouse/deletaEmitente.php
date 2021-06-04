<?php

require_once(__DIR__ . '/../../bootstrap.php');

use CloudDfe\SdkC\Softhouse;
/**
 * Operações da SOFTHOUSE
 *
 * Este método marca o emitente como INATIVO e com isso todas as operações do mesmo serão BLOQUEADAS e não haverão mais cobranças no proximo período
 *
 * NOTA: estas operações devem ser realizadas apenas com o TOKEN da softhouse
 */
try {
    $params = [
        'token' => 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbXAiOjcwLCJ1c3IiOiIyIiwidHAiOjIsImlhdCI6MTU4MDkzNzM3MH0.KvSUt2x8qcu4Rtp2XNTOINqR',
        'ambiente' => Softhouse::AMBIENTE_HOMOLOGACAO,
        'options' => [
            'debug' => false,
        ]
    ];
    $softhouse = new Softhouse($params);

    $payload = [
        'cnpj '=> '25447784000121'
    ];
    $resp = $softhouse->deletaEmitente($payload);

    echo "<pre>";
    print_r($resp);
    echo "</pre>";

} catch (\Exception $e) {
    echo $e->getMessage();
}
