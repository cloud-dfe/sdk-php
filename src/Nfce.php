<?php

namespace CloudDfe\SdkPHP;

use stdClass;

class Nfce extends Base
{
    /**
     * @param array $payload
     * @return stdClass
     */
    public function cria(array $payload): stdClass
    {
        return $this->client->send('POST', "/nfce", $payload);
    }

    public function preview(array $payload): stdClass
    {
        return $this->client->send('POST', "/nfce/preview", $payload);
    }

    public function status(): stdClass
    {
        return $this->client->send('GET', '/nfce/status', []);
    }

    public function consulta(array $payload): stdClass
    {
        $key = self::checkKey($payload);
        return $this->client->send('GET', "/nfce/{$key}", []);
    }

    public function busca(array $payload): stdClass
    {
        return $this->client->send('POST', "/nfce/busca", $payload);
    }

    public function cancela(array $payload): stdClass
    {
        return $this->client->send('POST', "/nfce/cancela", $payload);
    }

    public function offline(): stdClass
    {
        return $this->client->send('GET', "/nfce/offline", []);
    }

    public function inutiliza(array $payload): stdClass
    {
        return $this->client->send('POST', "/nfce/inutiliza", $payload);
    }

    public function pdf(array $payload): stdClass
    {
        $key = self::checkKey($payload);
        return $this->client->send('GET', "/nfce/pdf/{$key}", []);
    }

    public function substitui(array $payload): stdClass
    {
        return $this->client->send('POST', "/nfce/substitui", $payload);
    }

    public function backup(array $payload): stdClass
    {
        return $this->client->send('POST', "/nfce/backup", $payload);
    }
}
