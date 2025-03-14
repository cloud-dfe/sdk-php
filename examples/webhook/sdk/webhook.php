<?php

require_once(__DIR__ . "/../../bootstrap.php");

use CloudDfe\SdkPHP\Webhook;
use CloudDfe\SdkPHP\Util;

// CASO ESTEJA UTILIZANDO O SDK

try {

    // Esse é o token é o da Softhouse, não confunda com o token de emitente.
    // O token da Softhouse é utilizado como chave pública para descriptografar o campo signature.
    $token_softhouse = "TOKEN DA SOFTHOUSE";

    // O body é o conteúdo da requisição POST, que contêm os dados do webhook.
    $body = file_get_contents("php://input");

    // Chama o método isValid para verificar se a assinatura é válida.
    $webhookValid = Webhook::isValid($token_softhouse, $body);

    // Decodifica o body para um objeto PHP.
    $req = json_decode($body);

    // EXEMPLOS DE ORIGEM
    
    // NFE, NFCE, NFSE, CTE, CTEOS, MDFE, NFSE, BFE, GNRE, NFCOM 
    
    // PARA DFE TEMOS DIFERENTES ORIGENS COMO:
    // DFE55NF, DFE57NF, DFE67NF
    // DFE55EV - Evento de NF-e, DFE57EV - Evento de CT-e, DFE67EV - Evento de MDF-e
    $docOrigem = "NFE";
    
    // Verifica qual é a origem do documento.
    if ($req->origem == $docOrigem) {
        if (!$req->sucesso) {
                // https://integranotas.com.br/doc/webhook
                // Notifica o erro ao cliente
                $req->mensagem;
        } else {
                // CASO SEJA O BANCO DE DADOS SEJA SEPARADO.

                $documento = $req->cnpj_cpf; // CNPJ ou CPF do emitente/cliente
                // Direciona ao banco de dados do emitente/cliente e busca pelo documento.

                // OBTEM AS INFORMAÇÕES PARA SALVAR NO BANCO DE DADOS
                
                $xml_base64 = Util::encode(Util::decode($req->xml));
                $pdf_base64 = Util::encode(Util::decode($req->pdf));

                // SE ESTIVER UTILIZANDO NFSE A PREFEITURA PODE DISPONIBILIZAR O LINK DO PDF
                $link_pdf = $req->link_pdf;

                // OBTEM A CHAVE DA NOTA
                $chave = $req->chave;
            
                // Salva o XML e o PDF no banco de dados.
        }
    }

} catch (\Exception $e) {
    echo $e->getMessage();
}