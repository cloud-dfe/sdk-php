<?php

namespace CloudDfe\SdkPHP;

class Averbacao extends Base
{
    /**
     * @param array $payload
     * @return \stdClass
     */
    public function atm($payload)
    {
        return $this->client->send('POST', "/averbacao/atm", $payload);
    }

    /**
     * @param array $payload
     * @return \stdClass
     */
    public function elt($payload)
    {
        return $this->client->send('POST', "/averbacao/elt", $payload);
    }

    /**
     * @param array $payload
     * @return \stdClass
     */
    public function portoSeguro($payload)
    {
        return $this->client->send('POST', "/averbacao/portoseguro", $payload);
    }
}
