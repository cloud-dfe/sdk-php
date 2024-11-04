<?php

namespace CloudDfe\SdkPHP;

class Nfcom extends Base
{
    // @return \stdClass
    // @throws \Exception
    public function status()
    {
        return $this->client->send("GET", "/nfcom/status", []);
    }

    // @param array $payload
    // @return \stdClass
    // @throws \Exception
    public function cria($payload)
    {
        return $this->client->send("POST", "/nfcom", $payload);
    }

    // @param array $payload
    // @return \stdClass
    // @throws \Exception
    public function consulta($payload)
    {
        $key = self::checkKey($payload);
        return $this->client->send("GET", "/nfcom/{$key}", $payload);
    }

    // @param array $payload
    // @return \stdClass
    // @throws \Exception
    public function cancela($payload)
    {
        return $this->client->send("POST", "/nfcom/cancela", $payload);
    }

    // @param array $payload
    // @return \stdClass
    // @throws \Exception
    public function busca($payload)
    {
        return $this->client->send("POST", "/nfcom/busca", $payload);
    }

    // @param array $payload
    // @return \stdClass
    // @throws \Exception
    public function pdf($payload)
    {
        $key = self::checkKey($payload);
        return $this->client->send("GET", "/nfcom/pdf/{$key}", []);
    }

    // @param array $payload
    // @return \stdClass
    // @throws \Exception
    public function preview($payload)
    {
        return $this->client->send("POST", "/nfcom/preview", $payload);
    }

    // @param array $payload
    // @return \stdClass
    // @throws \Exception
    public function backup($payload)
    {
        return $this->client->send("POST", "/nfcom/backup", $payload);
    }

    // @param array $payload
    // @return \stdClass
    // @throws \Exception
    public function importa($payload)
    {
        return $this->client->send("POST", "/nfcom/importa", $payload);
    }
}
