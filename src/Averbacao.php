<?php

namespace CloudDfe\SdkPHP;

class Averbacao extends Base
{

    // @param array $payload
    // @return \stdClass
    // @throws \Exception
    public function atm($payload)
    {
        return $this->client->send("POST", "/averbacao/atm", $payload);
    }

    // @param array $payload
    // @return \stdClass
    // @throws \Exception
    public function atmCancela($payload)
    {
        return $this->client->send("POST", "/averbacao/atm/cancela", $payload);
    }

    // @param array $payload
    // @return \stdClass
    // @throws \Exception
    public function elt($payload)
    {
        return $this->client->send("POST", "/averbacao/elt", $payload);
    }

    // @param array $payload
    // @return \stdClass
    // @throws \Exception
    public function portoSeguro($payload)
    {
        return $this->client->send("POST", "/averbacao/portoseguro", $payload);
    }

    // @param array $payload
    // @return \stdClass
    // @throws \Exception
    public function portoSeguroCancela($payload)
    {
        return $this->client->send("POST", "/averbacao/portoseguro/cancela", $payload);
    }
}
