<?php

namespace CloudDfe\SdkPHP;

class Emitente extends Base
{
    // @param array $payload
    // @return \stdClass
    // @throws \Exception
    public function token()
    {
        return $this->client->send("GET", "/emitente/token", []);
    }

    // @param array $payload
    // @return \stdClass
    // @throws \Exception
    public function atualiza($payload)
    {
        return $this->client->send("PUT", "/emitente", $payload);
    }

    // @param array $payload
    // @return \stdClass
    // @throws \Exception
    public function mostra()
    {
        return $this->client->send("GET", "/emitente", []);
    }

    // @param array $payload
    // @return \stdClass
    // @throws \Exception
    public function webhook($payload)
    {
        return $this->client->send("POST", "/webhook", $payload);
    }
}
