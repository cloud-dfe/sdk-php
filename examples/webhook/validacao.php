<?php

require_once(__DIR__ . "/../../bootstrap.php");

use CloudDfe\SdkPHP\Webhook;

// Este exemplo é responsavel por verificar a assinatura dos dados enviados via webhook

// O método isValid verifica se os dados recebidos são enviados pela IntegraNotas

// NOTA: Os casos de Exception acontece nos seguintes casos:
// 1 - o payload não é um JSON válido
// 2 - o payload não contêm a assinatura (campo signature)
// 3 - o token está vazio (não foi passado um token)
// 4 - Token ou assinatua incorreta (não foi possivel decriptar a assinatura)
// 5 - a assinatura expirou (quando a assinatura tiver sido feita a mais de 5 minutos atras)

try {
    // Exemplo de captura o corpo da requisição POST e converte de JSON para um objeto PHP
    // $body = json_decode(file_get_contents("php://input"), true);

    // Token da Softhouse NOTA: Lembre que existe dois tokens (Homolocação ou Produção)
    $token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbXAiOiJ0b2tlbl9leGVtcGxvIiwidXNyIjoidGsiLCJ0cCI6InRrIn0.Tva_viCMCeG3nkRYmi_RcJ6BtSzui60kdzIsuq5X-sQ";

    // Simulação de um retorno de payload por via api
    // Webhook configurado na url https://exemplo.com/webhookIntegraNotas
    // Retorna a variavel $payload com o conteúdo do corpo da requisição POST
    // transformando o JSON recebido em string
    // $payload = json_encode($body);

    // Para saber mais sobre o corpo da requisição POST acesse a documentação do webhook em https://integranotas.com.br/doc/webhook
    // Simulação de um retorno de payload por via api
    $payload = '{
        "origem": "TESTE",
        "cnpj_cpf": "12345678000123",
        "signature": "tBQrTEui9FxaU7AdFbqPaveg3tBPZ1RjKj3Ytn15fm10/AYIztE6ST+YvLuLu6ea8PUrefX4SpxcT1K8LK40fQ=="
    }';
    
    // Método que verifica se a assinatura é valida
    $result = Webhook::isValid($token, $payload);
    
    return $result;

} catch (\Exception $e) {
    echo $e->getMessage();
}
