<?php

namespace CloudDfe\SdkPHP;

use stdClass;

class Nfse extends Base
{
    /**
     * @param array $payload
     * @return stdClass
     */
    public function cria(array $payload)
    {
        return $this->client->send('POST', "/nfse", $payload);
    }

    /**
     * @param array $payload
     * @return stdClass
     */
    public function preview(array $payload)
    {
        return $this->client->send('POST', "/nfse/preview", $payload);
    }

    /**
     * @param array $payload
     * @return stdClass
     * @throws \Exception
     */
    public function consulta(array $payload)
    {
        $key = self::checkKey($payload);
        return $this->client->send('GET', "/nfse/{$key}", []);
    }

    /**
     * @param array $payload
     * @return stdClass
     */
    public function cancela(array $payload): stdClass
    {
        return $this->client->send('POST', "/nfse/cancela", $payload);
    }

    /**
     * @param array $payload
     * @return stdClass
     */
    public function busca(array $payload): stdClass
    {
        return $this->client->send('POST', "/nfse/busca", $payload);
    }

    /**
     * @param array $payload
     * @return stdClass
     */
    public function backup(array $payload): stdClass
    {
        return $this->client->send('POST', "/nfse/backup", $payload);
    }

    /**
     * @param array $payload
     * @return stdClass
     */
    public function localiza(array $payload)
    {
        return $this->client->send('POST', "/nfse/consulta", $payload);
    }
}
