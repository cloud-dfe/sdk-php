<?php

namespace CloudDfe\SdkPHP;

class Gnre extends Base
{
    // @param array $payload
    // @return \stdClass
    // @throws \Exception
    public function consulta($payload)
    {
        $key = self::checkKey($payload);
        return $this->client->send("GET", "/gnre/{$key}", []);
    }

    // @param array $payload
    // @return \stdClass
    // @throws \Exception
    public function cria($payload)
    {
        return $this->client->send("POST", "/gnre", $payload);
    }

    // @param array $payload
    // @return \stdClass
    // @throws \Exception
    public function configUf($payload)
    {
        return $this->client->send("POST", "/gnre/configuf", $payload);
    }
}
