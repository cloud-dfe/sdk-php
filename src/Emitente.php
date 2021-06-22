<?php

namespace CloudDfe\SdkPHP;

class Emitente extends Base
{
    /**
     *
     * @return \stdClass
     */
    public function token()
    {
        return $this->client->send('GET', '/emitente/token', []);
    }

    /**
     * @param array $payload
     * @return \stdClass
     */
    public function atualiza($payload)
    {
        return $this->client->send('PUT', "/emitente", $payload);
    }

    /**
     * @return \stdClass
     */
    public function mostra()
    {
        return $this->client->send('GET', "/emitente", []);
    }
}
