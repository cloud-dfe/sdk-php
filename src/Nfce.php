<?php

namespace CloudDfe\SdkPHP;

class Nfce extends Base
{
    // @param array $payload
    // @return \stdClass
    // @throws \Exception
    public function cria($payload)
    {
        return $this->client->send("POST", "/nfce", $payload);
    }

    // @param array $payload
    // @return \stdClass
    // @throws \Exception
    public function preview($payload)
    {
        return $this->client->send("POST", "/nfce/preview", $payload);
    }

    // @return \stdClass
    // @throws \Exception
    public function status()
    {
        return $this->client->send("GET", "/nfce/status", []);
    }

    // @param array $payload
    // @return \stdClass
    // @throws \Exception
    public function consulta($payload)
    {
        $key = self::checkKey($payload);
        return $this->client->send("GET", "/nfce/{$key}", []);
    }

    // @param array $payload
    // @return \stdClass
    // @throws \Exception
    public function busca($payload)
    {
        return $this->client->send("POST", "/nfce/busca", $payload);
    }

    // @param array $payload
    // @return \stdClass
    // @throws \Exception
    public function cancela($payload)
    {
        return $this->client->send("POST", "/nfce/cancela", $payload);
    }

    // @param array $payload
    // @return \stdClass
    // @throws \Exception
    public function offline()
    {
        return $this->client->send("GET", "/nfce/offline", []);
    }

    // @param array $payload
    // @return \stdClass
    // @throws \Exception
    public function inutiliza($payload)
    {
        return $this->client->send("POST", "/nfce/inutiliza", $payload);
    }

    // @param array $payload
    // @return \stdClass
    // @throws \Exception
    public function pdf($payload)
    {
        $key = self::checkKey($payload);
        return $this->client->send("GET", "/nfce/pdf/{$key}", []);
    }

    // @param array $payload
    // @return \stdClass
    // @throws \Exception
    public function substitui($payload)
    {
        return $this->client->send("POST", "/nfce/substitui", $payload);
    }

    // @param array $payload
    // @return \stdClass
    // @throws \Exception
    public function backup($payload)
    {
        return $this->client->send("POST", "/nfce/backup", $payload);
    }

    // @param array $payload
    // @return \stdClass
    // @throws \Exception
    public function importa($payload)
    {
        return $this->client->send("POST", "/nfce/importa", $payload);
    }
}
