<?php

namespace CloudDfe\SdkPHP;

class Averbacao extends Base
{
    /**
     * @param array $payload
     * @return \stdClass
     */
    public function atmChave($payload)
    {
        $key = self::checkKey($payload);
        unset($payload['chave']);
        return $this->client->send('POST', "/averbacao/atm/{$key}", $payload);
    }

    /**
     * @param array $payload
     * @return \stdClass
     */
    public function atmXML($payload)
    {
        return $this->client->send('POST', "/averbacao/atm", $payload);
    }

    /**
     * @param array $payload
     * @return \stdClass
     */
    public function eltChave($payload)
    {
        $key = self::checkKey($payload);
        unset($payload['chave']);
        return $this->client->send('POST', "/averbacao/elt/{$key}", $payload);
    }

    /**
     * @param array $payload
     * @return \stdClass
     */
    public function eltXML($payload)
    {
        return $this->client->send('POST', "/averbacao/elt", $payload);
    }

    /**
     * @param array $payload
     * @return \stdClass
     */
    public function portoSeguroChave($payload)
    {
        $key = self::checkKey($payload);
        unset($payload['chave']);
        return $this->client->send('POST', "/averbacao/portoseguro/{$key}", $payload);
    }

    /**
     * @param array $payload
     * @return \stdClass
     */
    public function portoSeguroXML($payload)
    {
        return $this->client->send('POST', "/averbacao/portoseguro", $payload);
    }
}
