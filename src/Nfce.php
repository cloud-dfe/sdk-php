<?php

namespace CloudDfe\SdkPHP;

use stdClass;

class Nfce extends Base
{
    /**
     * @param array $payload
     * @return stdClass
     */
    public function cria( $payload): stdClass
    {
        return $this->client->send('POST', "/nfce", $payload);
    }

    public function preview( $payload): stdClass
    {
        return $this->client->send('POST', "/nfce/preview", $payload);
    }

    public function status(): stdClass
    {
        return $this->client->send('GET', '/nfce/status', []);
    }

    public function consulta( $payload): stdClass
    {
        $key = self::checkKey($payload);
        return $this->client->send('GET', "/nfce/{$key}", []);
    }

    public function busca( $payload): stdClass
    {
        return $this->client->send('POST', "/nfce/busca", $payload);
    }

    public function cancela( $payload): stdClass
    {
        return $this->client->send('POST', "/nfce/cancela", $payload);
    }

    public function offline(): stdClass
    {
        return $this->client->send('GET', "/nfce/offline", []);
    }

    public function inutiliza( $payload): stdClass
    {
        return $this->client->send('POST', "/nfce/inutiliza", $payload);
    }

    public function pdf( $payload): stdClass
    {
        $key = self::checkKey($payload);
        return $this->client->send('GET', "/nfce/pdf/{$key}", []);
    }

    public function substitui( $payload): stdClass
    {
        return $this->client->send('POST', "/nfce/substitui", $payload);
    }

    public function backup( $payload): stdClass
    {
        return $this->client->send('POST', "/nfce/backup", $payload);
    }
}
