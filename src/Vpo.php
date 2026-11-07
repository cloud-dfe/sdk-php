<?php

namespace CloudDfe\SdkPHP;

class Vpo extends Base
{
    /**
     * @param array $payload
     * @return \stdClass
     * @throws \Exception
     */
    public function cria($payload)
    {
        return $this->client->send("POST", "/vpo/ailog", $payload);
    }

    /**
     * @param array $payload
     * @return \stdClass
     * @throws \Exception
     */
    public function consulta($payload)
    {
        $key = self::checkKey($payload);
        return $this->client->send("GET", "/vpo/ailog/{$key}", []);
    }

    /**
     * @param array $payload
     * @return \stdClass
     * @throws \Exception
     */
    public function busca($payload)
    {
        return $this->client->send("POST", "/vpo/ailog/busca", $payload);
    }

    /**
     * @param array $payload
     * @return \stdClass
     * @throws \Exception
     */
    public function cancela($payload)
    {
        return $this->client->send("POST", "/vpo/ailog/cancela", $payload);
    }

    /**
     * @param array $payload
     * @return \stdClass
     * @throws \Exception
     */
    public function reemite($payload)
    {
        return $this->client->send("POST", "/vpo/ailog/reemite", $payload);
    }

    /**
     * @param array $payload
     * @return \stdClass
     * @throws \Exception
     */
    public function rota($payload)
    {
        return $this->client->send("POST", "/vpo/ailog/rota", $payload);
    }

    /**
     * @param array $payload
     * @return \stdClass
     * @throws \Exception
     */
    public function pdf($payload)
    {
        $key = self::checkKey($payload);
        return $this->client->send("GET", "/vpo/ailog/pdf/{$key}", []);
    }

    /**
     * @param array $payload
     * @return \stdClass
     * @throws \Exception
     */
    public function veiculo($payload)
    {
        return $this->client->send("POST", "/vpo/ailog/veiculo", $payload);
    }
}
