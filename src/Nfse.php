<?php

namespace CloudDfe\SdkPHP;

use stdClass;

class Nfse extends Base
{
    /**
     * @param array $payload
     * @return \stdClass
     */
    public function cria($payload)
    {
        return $this->client->send('POST', "/nfse", $payload);
    }

    /**
     * @param array $payload
     * @return \stdClass
     */
    public function preview($payload)
    {
        return $this->client->send('POST', "/nfse/preview", $payload);
    }

    /**
     * @param array $payload
     * @return \stdClass
     */
    public function pdf($payload)
    {
        $key = self::checkKey($payload);
        return $this->client->send('POST', "/nfse/pdf/{$key}", []);
    }

    /**
     * @param array $payload
     * @return \stdClass
     * @throws \Exception
     */
    public function consulta($payload)
    {
        $key = self::checkKey($payload);
        return $this->client->send('GET', "/nfse/{$key}", []);
    }

    /**
     * @param array $payload
     * @return \stdClass
     */
    public function cancela($payload)
    {
        return $this->client->send('POST', "/nfse/cancela", $payload);
    }

    /**
     * @param array $payload
     * @return \stdClass
     */
    public function busca($payload)
    {
        return $this->client->send('POST', "/nfse/busca", $payload);
    }

    /**
     * @param array $payload
     * @return \stdClass
     */
    public function backup( $payload)
    {
        return $this->client->send('POST', "/nfse/backup", $payload);
    }

    /**
     * @param array $payload
     * @return stdClass
     */
    public function localiza( $payload)
    {
        return $this->client->send('POST', "/nfse/consulta", $payload);
    }
}
