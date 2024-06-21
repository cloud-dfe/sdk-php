<?php

namespace CloudDfe\SdkPHP;

class Nfcom extends Base
{
    /**
     * @param array $payload
     * @return \stdClass
     */
    public function status()
    {
        return $this->client->send("GET", "/nfcom/status", []);
    }

    public function cria($payload)
    {
        return $this->client->send("POST", "/nfcom", $payload);
    }

    public function consulta($payload)
    {
        $key = self::checkKey($payload);
        return $this->client->send("GET", "/nfcom/{$key}", $payload);
    }

    public function cancela($payload)
    {
        return $this->client->send("POST", "/nfcom/cancela", $payload);
    }

    public function busca($payload)
    {
        return $this->client->send("POST", "/nfcom/busca", $payload);
    }

    public function pdf($payload)
    {
        $key = self::checkKey($payload);
        return $this->client->send("GET", "/nfcom/pdf/{$key}", []);
    }

    public function preview($payload)
    {
        return $this->client->send("POST", "/nfcom/preview", $payload);
    }

    public function backup($payload)
    {
        return $this->client->send("POST", "/nfcom/backup", $payload);
    }

    public function importa($payload)
    {
        return $this->client->send("POST", "/nfcom/importa", $payload);
    }
}