<?php

namespace CloudDfe\SdkPHP;

class Nfce extends Base
{
    /**
     * @param array $payload
     * @return \stdClass
     */
    public function cria($payload)
    {
        return $this->client->send('POST', "/nfce", $payload);
    }

    public function preview($payload)
    {
        return $this->client->send('POST', "/nfce/preview", $payload);
    }

    public function status()
    {
        return $this->client->send('GET', '/nfce/status', []);
    }

    public function consulta($payload)
    {
        $key = self::checkKey($payload);
        return $this->client->send('GET', "/nfce/{$key}", []);
    }

    public function busca($payload)
    {
        return $this->client->send('POST', "/nfce/busca", $payload);
    }

    public function cancela($payload)
    {
        return $this->client->send('POST', "/nfce/cancela", $payload);
    }

    public function offline()
    {
        return $this->client->send('GET', "/nfce/offline", []);
    }

    public function inutiliza($payload)
    {
        return $this->client->send('POST', "/nfce/inutiliza", $payload);
    }

    public function pdf($payload)
    {
        $key = self::checkKey($payload);
        return $this->client->send('GET', "/nfce/pdf/{$key}", []);
    }

    public function substitui($payload)
    {
        return $this->client->send('POST', "/nfce/substitui", $payload);
    }

    public function backup($payload)
    {
        return $this->client->send('POST', "/nfce/backup", $payload);
    }

    /**
     * @param array $payload
     * @return \stdClass
     */
    public function importa($payload)
    {
        return $this->client->send('POST', "/nfce/importa", $payload);
    }
}
