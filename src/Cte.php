<?php

namespace CloudDfe\SdkPHP;

class Cte extends Base
{

    // @return \stdClass
    // @throws \Exception
    public function status()
    {
        return $this->client->send("GET", "/cte/status", []);
    }

    // @param array $payload
    // @return \stdClass
    // @throws \Exception
    public function consulta($payload)
    {
        $key = self::checkKey($payload);
        return $this->client->send("GET", "/cte/{$key}", []);
    }

    //  @param array $payload
    //  @return \stdClass
    //  @throws \Exception
    public function pdf($payload)
    {
        $key = self::checkKey($payload);
        return $this->client->send("GET", "/cte/pdf/{$key}", []);
    }

    // @param array $payload
    // @return \stdClass
    // @throws \Exception
    public function cria($payload)
    {
        return $this->client->send("POST", "/cte", $payload);
    }

    // @param array $payload
    // @return \stdClass
    // @throws \Exception
    public function busca($payload)
    {
        return $this->client->send("POST", "/cte/busca", $payload);
    }

    // @param array $payload
    // @return \stdClass
    // @throws \Exception
    public function cancela($payload)
    {
        return $this->client->send("POST", "/cte/cancela", $payload);
    }

    // @param array $payload
    // @return \stdClass
    // @throws \Exception
    public function correcao($payload)
    {
        return $this->client->send("POST", "/cte/correcao", $payload);
    }

    // @param array $payload
    // @return \stdClass
    // @throws \Exception
    public function inutiliza($payload)
    {
        return $this->client->send("POST", "/cte/inutiliza", $payload);
    }

    // @param array $payload
    // @return \stdClass
    // @throws \Exception
    public function backup($payload)
    {
        return $this->client->send("POST", "/cte/backup", $payload);
    }

    // @param array $payload
    // @return \stdClass
    // @throws \Exception
    public function importa($payload)
    {
        return $this->client->send("POST", "/cte/importa", $payload);
    }

    // @param array $payload
    // @return \stdClass
    // @throws \Exception
    public function preview($payload)
    {
        return $this->client->send("POST", "/cte/preview", $payload);
    }

    // @param array $payload
    // @return \stdClass
    // @throws \Exception
    public function desacordo($payload)
    {
        return $this->client->send("POST", "/cte/desacordo", $payload);
    }
}
