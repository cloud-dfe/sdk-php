<?php

declare(strict_types=1);

namespace CloudDfe\SdkPHP;

use stdClass;

class CteOS extends Base
{
    /**
     * @param array $payload
     * @return stdClass
     */
    public function cria($payload)
    {
        return $this->client->send('POST', "/cteos", $payload);
    }

    /**
     * @param array $payload
     * @return stdClass
     */
    public function preview($payload)
    {
        return $this->client->send('POST', "/cteos/preview", $payload);
    }

    /**
     * @return stdClass
     */
    public function status()
    {
        return $this->client->send('GET', '/cteos/status', []);
    }

    /**
     * @param array $payload
     * @return stdClass
     * @throws \Exception
     */
    public function consulta($payload)
    {
        $key = self::checkKey($payload);
        return $this->client->send('GET', "/cteos/{$key}", []);
    }

    /**
     * @param array $payload
     * @return stdClass
     */
    public function busca($payload)
    {
        return $this->client->send('POST', "/cteos/busca", $payload);
    }

    /**
     * @param array $payload
     * @return stdClass
     */
    public function cancela($payload)
    {
        return $this->client->send('POST', "/cteos/cancela", $payload);
    }

    /**
     * @param array $payload
     * @return stdClass
     */
    public function correcao($payload)
    {
        return $this->client->send('POST', "/cteos/correcao", $payload);
    }

    /**
     * @param array $payload
     * @return stdClass
     */
    public function inutiliza($payload)
    {
        return $this->client->send('POST', "/cteos/inutiliza", $payload);
    }

    /**
     * @param array $payload
     * @return stdClass
     * @throws \Exception
     */
    public function pdf($payload)
    {
        $key = self::checkKey($payload);
        return $this->client->send('GET', "/cteos/pdf/{$key}", []);
    }

    /**
     * @param array $payload
     * @return stdClass
     */
    public function backup($payload)
    {
        return $this->client->send('POST', "/cteos/backup", $payload);
    }
}
