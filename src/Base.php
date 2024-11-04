<?php

namespace CloudDfe\SdkPHP;

class Base
{
    // @var Client
    protected $client;

    const AMBIENTE_PRODUCAO = 1;
    const AMBIENTE_HOMOLOGACAO = 2;

    public function __construct($params)
    {
        $config = [
            "token" => $params["token"],
            "ambiente" => $params["ambiente"],
            "timeout" => $params["timeout"],
            "port" => $params["port"],
            "http_version" => $params["http_version"],
            "debug" => $params["debug"],
            "options" => $params["options"]
        ];

        $this->client = new Client($config);
    }

    // @param array $payload
    // @return \stdClass
    protected static function checkKey($payload)
    {
        $key = preg_replace("/[^0-9]/", "", $payload["chave"]);
        if (empty($key) || strlen($key) != 44) {
            throw new \Exception("A chave deve ter 44 digitos numericos");
        }
        return $key;
    }
}
