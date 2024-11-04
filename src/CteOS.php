<?php

namespace CloudDfe\SdkPHP;

class CteOS extends Base
{
    // @return \stdClass
    // @throws \Exception
    public function status()
    {
        return $this->client->send("GET", "/cteos/status", []);
    }

    // @param array $payload
    // @return \stdClass
    // @throws \Exception
    public function consulta($payload)
    {
        $key = self::checkKey($payload);
        return $this->client->send("GET", "/cteos/{$key}", []);
    }

    // @param array $payload
    // @return \stdClass
    // @throws \Exception
    public function pdf($payload)
    {
        $key = self::checkKey($payload);
        return $this->client->send("GET", "/cteos/pdf/{$key}", []);
    }

    // @param array $payload
    // @return \stdClass
    // @throws \Exception
    public function cria($payload)
    {
        return $this->client->send("POST", "/cteos", $payload);
    }

    // @param array $payload
    // @return \stdClass
    // @throws \Exception
    public function busca($payload)
    {
        return $this->client->send("POST", "/cteos/busca", $payload);
    }

    // @param array $payload
    // @return \stdClass
    // @throws \Exception
    public function cancela($payload)
    {
        return $this->client->send("POST", "/cteos/cancela", $payload);
    }

    // @param array $payload
    // @return \stdClass
    // @throws \Exception
    public function correcao($payload)
    {
        return $this->client->send("POST", "/cteos/correcao", $payload);
    }

    // @param array $payload
    // @return \stdClass
    // @throws \Exception
    public function inutiliza($payload)
    {
        return $this->client->send("POST", "/cteos/inutiliza", $payload);
    }

    // @param array $payload
    // @return \stdClass
    // @throws \Exception
    public function backup($payload)
    {
        return $this->client->send("POST", "/cteos/backup", $payload);
    }

    // @param array $payload
    // @return \stdClass
    // @throws \Exception
    public function importa($payload)
    {
        return $this->client->send("POST", "/cteos/importa", $payload);
    }

    // @param array $payload
    // @return \stdClass
    // @throws \Exception
    public function preview($payload)
    {
        return $this->client->send("POST", "/cteos/preview", $payload);
    }

    // @param array $payload
    // @return \stdClass
    // @throws \Exception
    public function desacordo($payload)
    {
        return $this->client->send("POST", "/cteos/desacordo", $payload);
    }
}
