<?php

namespace CloudDfe\SdkPHP;

class Webhook
{
    /**
     * Verifica se a assinatura do payload do webhook enviado pela CloudDFe é valida e foi gerada a menos de 5 minutos
     * @param string $token token da softwarehouse
     * @param string $payload payload em json do webhook
     * @return bool
     * @throws \Exception
     */
    public static function isValid($token, $payload)
    {
        $cipher = 'AES-128-CBC';
        $std = json_decode($payload);
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
        $calcmac = hash_hmac('sha256', $ciphertext_raw, "{$token}", true);
        if (hash_equals($hmac, $calcmac)) {
            $dif = (time() - $original_time); //diferença em segundos
            if ($dif < 300) {
                return true;
            }
            throw new \Exception('Assinatura Expirou !!');
        }
        throw new \Exception('Token ou assinatura incorreta.');
    }
}
