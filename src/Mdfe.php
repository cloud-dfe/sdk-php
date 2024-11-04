<?php

namespace CloudDfe\SdkPHP;

class Mdfe extends Base
{
    // @param array $payload
    // @return \stdClass
    // @throws \Exception
    public function cria($payload)
    {
        return $this->client->send("POST", "/mdfe", $payload);
    }

    // @param array $payload
    // @return \stdClass
    // @throws \Exception
    public function preview($payload)
    {
        return $this->client->send("POST", "/mdfe/preview", $payload);
    }

    // @return \stdClass
    // @throws \Exception
    public function status()
    {
        return $this->client->send("GET", "/mdfe/status", []);
    }

    // @param array $payload
    // @return \stdClass
    // @throws \Exception
    public function consulta($payload)
    {
        $key = self::checkKey($payload);
        return $this->client->send("GET", "/mdfe/{$key}", []);
    }

    // @param array $payload
    // @return \stdClass
    // @throws \Exception
    public function busca($payload)
    {
        return $this->client->send("POST", "/mdfe/busca", $payload);
    }

    // @param array $payload
    // @return \stdClass
    // @throws \Exception
    public function cancela($payload)
    {
        return $this->client->send("POST", "/mdfe/cancela", $payload);
    }

    // @param array $payload
    // @return \stdClass
    // @throws \Exception
    public function encerra($payload)
    {
        return $this->client->send("POST", "/mdfe/encerra", $payload);
    }

    // @param array $payload
    // @return \stdClass
    // @throws \Exception
    public function condutor($payload)
    {
        return $this->client->send("POST", "/mdfe/condutor", $payload);
    }

    // @return \stdClass
    // @throws \Exception
    public function offline()
    {
        return $this->client->send("GET", "/mdfe/offline", []);
    }

    // @param array $payload
    // @return \stdClass
    // @throws \Exception
    public function pdf($payload)
    {
        $key = self::checkKey($payload);
        return $this->client->send("GET", "/mdfe/pdf/{$key}", []);
    }

    // @param array $payload
    // @return \stdClass
    // @throws \Exception
    public function backup($payload)
    {
        return $this->client->send("POST", "/mdfe/backup", $payload);
    }

    // @param array $payload
    // @return \stdClass
    // @throws \Exception
    public function nfe($payload)
    {
        return $this->client->send("POST", "/mdfe/nfe", $payload);
    }

    // @param array $payload
    // @return \stdClass
    // @throws \Exception
    public function abertos()
    {
        return $this->client->send("GET", "/mdfe/abertos", []);
    }

    // @param array $payload
    // @return \stdClass
    // @throws \Exception
    public function importa($payload)
    {
        return $this->client->send("POST", "/mdfe/importa", $payload);
    }
}
