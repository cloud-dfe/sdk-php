<?php

namespace CloudDfe\SdkPHP;

class Sintegra
{
    const AMBIENTE_PRODUCAO = 1;

    protected $client;

    /**
     * Sintegra constructor.
     * @param array $params
     * @throws \Exception
     */
    public function __construct($params)
    {
        $this->client = new Client($params, 'sintegra');
    }

    /**
     * Send post request to uploads
     * @param array $payload
     * @return \stdClass
     */
    public function upload($payload)
    {
        return $this->client->sendMultpart("/upload", $payload);
    }

    /**
     * Send json port request to gerar
     * @param array $payload
     * @return \stdClass
     */
    public function gerar($payload)
    {
        return $this->client->send('POST', "/gerar", $payload);
    }

    /**
     * Send json port request to consular
     * @param array $payload
     * @return \stdClass
     */
    public function consultar($payload)
    {
        return $this->client->send('POST', "/consulta", $payload);
    }
}
