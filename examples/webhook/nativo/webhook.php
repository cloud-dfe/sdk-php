<?php

// Essa função é responsavel por validar se o campo signature é valido.
// É uma técnica de segurança que verifica se o envio dos dados são enviados pela IntegraNotas. 
function isValid($token, $body)
{
    $cipher = "AES-128-CBC";
    $std = json_decode($body);
    if (empty($std)) {
        throw new \Exception("Payload incorreto.");
    }
    if (empty($std->signature)) {
        throw new \Exception("Payload incorreto não contêm a assinatura.");
    }
    if (empty($token)) {
        throw new \Exception("Token vazio.");
    }
    $c = base64_decode($std->signature);
    $ivlen = openssl_cipher_iv_length($cipher);
    $iv = substr($c, 0, $ivlen);
    $hmac = substr($c, $ivlen, $sha2len = 32);
    $ciphertext_raw = substr($c, $ivlen + $sha2len);
    $original_time = (float) openssl_decrypt($ciphertext_raw, $cipher, "{$token}", OPENSSL_RAW_DATA, $iv);
    $calcmac = hash_hmac("sha256", $ciphertext_raw, "{$token}", true);
    if (hash_equals($hmac, $calcmac)) {
        $dif = (time() - $original_time);
        if ($dif < 300) {
            return true;
        }
        throw new \Exception("Assinatura Expirou !!");
    }
    throw new \Exception("Token ou assinatura incorreta.");
}

// Quando se recebe o webhook, os arquivos XML e PDF são compactados. Utilize essa função para descompactar.
function decode($data)
{
    $decoded = @base64_decode($data);
    $gz = @gzdecode($decoded);
    if ($gz !== false) {
        return $gz;
    }
    return $decoded;
}

// Caso deseje converter os dados para base64, utilize essa função.
function encode($data)
{
    return base64_encode($data);
}

try {

    // Esse é o token é o da Softhouse, não confunda com o token de emitente.
    // O token da Softhouse é utilizado como chave pública para descriptografar o campo signature.
    $token_softhouse = "TOKEN DA SOFTHOUSE";

    // O body é o conteúdo da requisição POST, que contêm os dados do webhook.
    $body = file_get_contents("php://input");

    // Chama o método isValid para verificar se a assinatura é válida.
    $webhookValid = isValid($token_softhouse, $body);

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
                
                $xml_base64 = encode(decode($req->xml));
                $pdf_base64 = encode(decode($req->pdf));

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