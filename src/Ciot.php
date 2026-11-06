<?php

namespace CloudDfe\SdkPHP;

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
     * @param array $payload
     * @return \stdClass
     * @throws \Exception
     */
    public function consulta($payload)
    {
        $key = self::checkKey($payload);
        return $this->client->send("GET", "/ciot/{$key}", []);
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
     * @param array $payload
     * @return \stdClass
     * @throws \Exception
     */
    public function pdf($payload)
    {
        $key = self::checkKey($payload);
        return $this->client->send("GET", "/ciot/pdf/{$key}", []);
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
}
