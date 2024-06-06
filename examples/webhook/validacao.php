<?php

require_once(__DIR__ . "/../../bootstrap.php");

use CloudDfe\SdkPHP\Webhook;

/**
 * Este exemplo de verificação da assinatura dos dados enviados via webhook
 *
 * Este método indica se os dados passados pelo webhook são validodos
 *
 * NOTA: Será retornado uma Exception nos seguintes casos:
 * 1 - o payload não é um JSON válido
 * 2 - o payload não contêm a assinatura (campo signature)
 * 3 - o token está vazio (não foi passado um token)
 * 4 - Token ou assinatua incorreta (não foi possivel decriptar a assinatura)
 * 5 - a assinatura expirou (quando a assinatura tiver sido feita a mais de 5 minutos atras)
 */
try {
    // exemplo de como capturar o body de uma requisição POST
    $body = json_decode(file_get_contents("php://input"));

    // token da softhouse do ambiente sendo usado (lembre-se existem dois token um para homologação e outro para produção e são diferentes)
    $token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbXAiOiJ0b2tlbl9leGVtcGxvIiwidXNyIjoidGsiLCJ0cCI6InRrIn0.Tva_viCMCeG3nkRYmi_RcJ6BtSzui60kdzIsuq5X-sQ";
    // payload do webhook em JSON (https://doc.cloud-dfe.com.br/webhook)
    $payload = "{
        "origem": "TESTE",
        "cnpj_cpf": "12345678000123",
        "signature": "tBQrTEui9FxaU7AdFbqPaveg3tBPZ1RjKj3Ytn15fm10/AYIztE6ST+YvLuLu6ea8PUrefX4SpxcT1K8LK40fQ=="
    }";
    return Webhook::isValid($token, $payload);
} catch (\Exception $e) {
    echo $e->getMessage();
}
