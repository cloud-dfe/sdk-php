<?php

namespace CloudDfe\SdkPHP;

class Client
{
    const URLS = [
        'api' => [
            '1' => 'https://api.integranotas.com.br/v1',
            '2' => 'https://hom-api.integranotas.com.br/v1'
        ]
    ];

    const AMBIENTE_PRODUCAO = 1;
    const AMBIENTE_HOMOLOGACAO = 2;

    // @var int
    protected $ambiente;
    // @var string
    protected $token;

    // @var int
    protected $timeout;
    // @var int
    protected $port;
    // @var int
    protected $http_version;

    // @var bool
    protected $debug;

    // @var Service
    protected $services;

    public function __construct($params = [])
    {
        if (empty($params)) {
            throw new \Exception("Devem ser passados os parametros básicos.");
        }
        if (!in_array($params["ambiente"], [1, 2, self::AMBIENTE_PRODUCAO, self::AMBIENTE_HOMOLOGACAO])) {
            throw new \Exception("O ambiente deve ser 1-produção ou 2-homologação.");
        }
        if (empty($params["token"])) {
            throw new \Exception("O token é obrigatorio.");
        }
        if (!empty($params["options"])) {
            $this->timeout = $params["options"]["timeout"] ?? $this->timeout;
            $this->port = $params["options"]["port"] ?? $this->port;
            $this->http_version = $params["options"]["http_version"] ?? $this->http_version;
            $this->debug = $params["options"]["debug"] ?? $this->debug;
        }

        $this->ambiente = !empty($params["ambiente"]) ? $params["ambiente"] : 2;
        $this->token = $params["token"] ?? $this->token;

        $this->timeout = $params["timeout"] ?? $this->timeout;
        $this->port = $params["port"] ?? $this->port;
        $this->http_version = $params["http_version"] ?? $this->http_version;
        $this->debug = $params["debug"] ?? $this->debug;

        $config = [
            "base_uri" => self::URLS["api"][$this->ambiente],
            "timeout" => $this->timeout,
            "port" => $this->port,
            "http_version" => $this->http_version,
            "debug" => $this->debug
        ];

        $this->services = new Services($config);
    }


    public function send($method, $route, $payload = [])
    {
        $headers = [
            "Authorization: {$this->token}",
            "Content-Type: application/json",
            "Accept: application/json"
        ];

        return $this->services->request($method, $route, $payload, $headers);
    }

    public function sendMultipart($route, $payload = [])
    {
        $headers = [
            "Authorization: {$this->token}",
            "Content-Type: multipart/form-data",
            "Accept: application/json"
        ];

        return $this->services->request("POST", $route, $payload, $headers);
    }
}
