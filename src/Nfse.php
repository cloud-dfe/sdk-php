<?php

namespace CloudDfe\SdkPHP;

class Nfse extends Base
{
    // @param array $payload
    // @return \stdClass
    // @throws \Exception
    public function cria($payload)
    {
        return $this->client->send("POST", "/nfse", $payload);
    }

    // @param array $payload
    // @return \stdClass
    // @throws \Exception
    public function preview($payload)
    {
        return $this->client->send("POST", "/nfse/preview", $payload);
    }

    // @param array $payload
    // @return \stdClass
    // @throws \Exception
    public function pdf($payload)
    {
        $key = self::checkKey($payload);
        return $this->client->send("GET", "/nfse/pdf/{$key}", []);
    }

    // @param array $payload
    // @return \stdClass
    // @throws \Exception
    public function consulta($payload)
    {
        $key = self::checkKey($payload);
        return $this->client->send("GET", "/nfse/{$key}", []);
    }

    // @param array $payload
    // @return \stdClass
    // @throws \Exception
    public function cancela($payload)
    {
        return $this->client->send("POST", "/nfse/cancela", $payload);
    }

    // @param array $payload
    // @return \stdClass
    // @throws \Exception
    public function substitui($payload)
    {
        return $this->client->send("POST", "/nfse/substitui", $payload);
    }

    // @param array $payload
    // @return \stdClass
    // @throws \Exception
    public function busca($payload)
    {
        return $this->client->send("POST", "/nfse/busca", $payload);
    }

    // @param array $payload
    // @return \stdClass
    // @throws \Exception
    public function backup($payload)
    {
        return $this->client->send("POST", "/nfse/backup", $payload);
    }

    // @param array $payload
    // @return \stdClass
    // @throws \Exception
    public function localiza($payload)
    {
        return $this->client->send("POST", "/nfse/consulta", $payload);
    }

    // @param array $payload
    // @return \stdClass
    // @throws \Exception
    public function info($payload)
    {
        return $this->client->send("GET", "/nfse/info/{$payload["ibge"]}", []);
    }

    // @param array $payload
    // @return \stdClass
    // @throws \Exception
    public function conflito($payload)
    {
        return $this->client->send("POST", "/nfse/conflito", $payload);
    }

    // @return \stdClass
    // @throws \Exception
    public function offline()
    {
        return $this->client->send("GET", "/nfse/offline", []);
    }

    // @param array $payload
    // @return \stdClass
    // @throws \Exception
    public function resolve($payload)
    {
        $key = self::checkKey($payload);
        return $this->client->send("GET", "/nfse/resolve/{$key}", []);
    }
}
