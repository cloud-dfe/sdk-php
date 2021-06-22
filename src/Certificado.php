<?php

namespace CloudDfe\SdkPHP;

class Certificado extends Base
{
    /**
     * Substitui o sertificado atual do emitente
     * @param array $payload
     * @return \stdClass
     */
    public function atualiza($payload)
    {
        return $this->client->send('POST', "/certificado", $payload);
    }

    /**
     * Mostra dados do certificado atual do emitente
     * @return \stdClass
     */
    public function mostra()
    {
        return $this->client->send('GET', '/certificado', []);
    }
}
