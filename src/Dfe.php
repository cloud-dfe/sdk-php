<?php

namespace CloudDfe\SdkPHP;

class Dfe extends Base
{
    /**
     * @param array $payload
     * @return \stdClass
     */
    public function buscaCte($payload)
    {
        return $this->client->send('POST', "/dfe/cte", $payload);
    }

    /**
     * @param array $payload
     * @return \stdClass
     */
    public function buscaNfe($payload)
    {
        return $this->client->send('POST', "/dfe/nfe", $payload);
    }

    /**
     * @param array $payload
     * @return \stdClass
     * @throws \Exception
     */
    public function downloadNfe($payload)
    {
        $key = self::checkKey($payload);
        return $this->client->send('GET', "/dfe/nfe/{$key}", []);
    }

    /**
     * @param array $payload
     * @return \stdClass
     */
    public function buscaNfse($payload)
    {
        return $this->client->send('POST', "/dfe/nfse", $payload);
    }

    /**
     * @param array $payload
     * @return \stdClass
     * @throws \Exception
     */
    public function downloadNfse($payload)
    {
        $key = self::checkKey($payload);
        return $this->client->send('GET', "/dfe/nfse/{$key}", []);
    }

    /**
     * @param array $payload
     * @return \stdClass
     * @throws \Exception
     */
    public function downloadCte($payload)
    {
        $key = self::checkKey($payload);
        return $this->client->send('GET', "/dfe/cte/{$key}", []);
    }

    /**
     * @param array $payload
     * @return \stdClass
     * @throws \Exception
     */
    public function eventos($payload)
    {
        $key = self::checkKey($payload);
        return $this->client->send('GET', "/dfe/eventos/{$key}", []);
    }

    /**
     * @param array $payload
     * @return \stdClass
     */
    public function backup($payload)
    {
        return $this->client->send('POST', "/dfe/backup", $payload);
    }
}
