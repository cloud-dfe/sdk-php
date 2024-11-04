<?php

namespace CloudDfe\SdkPHP;

class Certificado extends Base
{
    // @param array $payload
    // @return \stdClass
    // @throws \Exception
    public function atualiza($payload)
    {
        return $this->client->send("POST", "/certificado", $payload);
    }

    // @return \stdClass
    // @throws \Exception
    public function mostra()
    {
        return $this->client->send("GET", "/certificado", []);
    }
}
