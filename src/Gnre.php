<?php

namespace CloudDfe\SdkPHP;

class Gnre extends Base
{
    /**
     * Consulta GNRe pela Chave
     * @param array $payload
     * @return \stdClass
     * @throws \Exception
     */
    public function consulta($payload)
    {
        $key = self::checkKey($payload);
        return $this->client->send('GET', "/gnre/{$key}", []);
    }

    /**
     * Cria uma nova GNRe
     * @param array $payload
     * @return \stdClass
     */
    public function cria($payload)
    {
        return $this->client->send('POST', "/gnre", $payload);
    }

    /**
     * Consulta a configuração da UF
     * @param array $payload
     * @return \stdClass
     */
    public function configUf($payload)
    {
        return $this->client->send('POST', "/gnre/configuf", $payload);
    }
}
