<?php

namespace CloudDfe\SdkPHP;

use Exception;

class Ciot extends Base
{
    /**
     * @param array $payload
     * @return \stdClass
     * @throws \Exception
     */
    public function cria($payload)
    {
        return $this->client->send("POST", "/ciot", $payload);
    }

    /**
     * @param array $payload ["identificacao" => "..."]
     * @return \stdClass
     * @throws \Exception
     */
    public function consulta($payload)
    {
        $identificacao = self::checkIdentificacao($payload);
        return $this->client->send("GET", "/ciot/{$identificacao}", []);
    }

    /**
     * @param array $payload
     * @return \stdClass
     * @throws \Exception
     */
    public function busca($payload)
    {
        return $this->client->send("POST", "/ciot/busca", $payload);
    }

    /**
     * @param array $payload
     * @return \stdClass
     * @throws \Exception
     */
    public function cancela($payload)
    {
        return $this->client->send("POST", "/ciot/cancela", $payload);
    }

    /**
     * @param array $payload
     * @return \stdClass
     * @throws \Exception
     */
    public function encerra($payload)
    {
        return $this->client->send("POST", "/ciot/encerra", $payload);
    }

    /**
     * @param array $payload
     * @return \stdClass
     * @throws \Exception
     */
    public function retifica($payload)
    {
        return $this->client->send("POST", "/ciot/retifica", $payload);
    }

    /**
     * @param array $payload ["identificacao" => "..."]
     * @return \stdClass
     * @throws \Exception
     */
    public function pdf($payload)
    {
        $identificacao = self::checkIdentificacao($payload);
        return $this->client->send("GET", "/ciot/pdf/{$identificacao}", []);
    }

    /**
     * @param array $payload
     * @return \stdClass
     * @throws \Exception
     */
    public function transportador($payload)
    {
        return $this->client->send("POST", "/ciot/transportador", $payload);
    }

    /**
     * O CIOT é identificado pela identificação informada na criação, não por chave de acesso
     * @param array $payload
     * @return string
     * @throws \Exception
     */
    protected static function checkIdentificacao($payload)
    {
        $identificacao = trim((string)($payload["identificacao"] ?? ""));
        if (!preg_match('/^[A-Za-z0-9._-]{1,40}$/', $identificacao)) {
            throw new Exception("A identificação do CIOT deve ter de 1 a 40 caracteres: letras, números, ponto, hífen ou sublinhado");
        }
        return rawurlencode($identificacao);
    }
}
