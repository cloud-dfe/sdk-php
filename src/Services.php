<?php

namespace CloudDfe\SdkPHP;

class Services
{
    // @var string
    protected $base_uri = "";

    // @var int
    protected $timeout = 60;

    // @var int
    protected $port = 443;

    // @var int
    protected $http_version = CURL_HTTP_VERSION_NONE;

    // @var bool
    protected $debug = false;

    // @var array
    protected $error = ["code" => null, "message" => null];

    public function __construct($config)
    {
        $this->base_uri = $config["base_uri"];

        $this->timeout = $config["timeout"] ?? $this->timeout;
        $this->port = $config["port"] ?? $this->port;
        $this->http_version = $config["http_version"] ?? $this->http_version;

        $this->debug = $config["debug"] ?? $this->debug;
    }

    // @param string $method
    // @param string $route
    // @param array $payload
    // @param array $headers
    // @return string
    // @throws \Exception
    public function request($method, $route, $payload = [], $headers = [])
    {
        $data = json_encode($payload);

        $oCurl = curl_init();
        curl_setopt_array($oCurl, [
            CURLOPT_URL => "{$this->base_uri}{$route}",
            CURLOPT_IPRESOLVE => CURL_IPRESOLVE_V4,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_HEADER => false,
            CURLOPT_CONNECTTIMEOUT => $this->timeout,
            CURLOPT_TIMEOUT => $this->timeout,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_POSTREDIR => CURL_REDIR_POST_ALL,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_HTTP_VERSION => $this->http_version,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_HTTPHEADER => $headers
        ]);

        $response = curl_exec($oCurl);

        $this->error["message"] = curl_error($oCurl);
        $this->error["code"] = curl_errno($oCurl);

        curl_close($oCurl);

        if (!empty($this->error["message"])) {
            throw new \Exception("Falha de comunicação! [{$this->error["code"]}] {$this->error["message"]}", 500);
        }
        return $response;
    }
}
