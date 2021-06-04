<?php

namespace CloudDfe\SdkPHP;

class Sintegra
{
    const AMBIENTE_PRODUCAO = 1;
    const AMBIENTE_HOMOLOGACAO = 2;

    /**
     * Sintegra constructor.
     * @param array $params
     * @throws \Exception
     */
    public function __construct(array $params)
    {
        $this->client = new Client([
            'ambiente' => !empty($params['ambiente']) ? $params['ambiente'] : self::AMBIENTE_HOMOLOGACAO,
            'token' => $params['token'],
            'options' => $params['options']
        ], 'sintegra');
    }

    /**
     * Send post request to uploads
     * @param array $payload
     * @return stdClass
     */
    public function upload(array $payload)
    {
        return $this->client->sendMultpart("/upload", $payload);
    }

    /**
     * Send json port request to gerar
     * @param array $payload
     * @return stdClass
     */
    public function gerar(array $payload)
    {
        return $this->client->send('POST', "/gerar", $payload);
    }

    /**
     * Send json port request to consular
     * @param array $payload
     * @return stdClass
     */
    public function consultar(array $payload)
    {
        return $this->client->send('POST', "/consulta", $payload);
    }
}
