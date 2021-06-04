<?php

namespace CloudDfe\SdkPHP;

class HttpCurl
{
    /**
     * @var array
     */
    public $headers = [];
    /**
     * @var bool
     */
    protected $debug = false;
    /**
     * @var string
     */
    protected $base_uri = '';
    /**
     * @var array
     */
    protected $options = [];
    /**
     * @var int
     */
    protected $timeout = 10;
    /**
     * @var int
     */
    protected $http_version = 0;
    /**
     * @var int
     */
    protected $port = 443;
    /**
     * @var array
     */
    protected $error = ['code' => null, 'message' => null];
    /**
     * @var string
     */
    protected $token;

    public function __construct($config)
    {
        $this->debug = (bool) $config['debug'];
        $this->base_uri = (string) $config['base_uri'];
        $this->token = (string) $config['token'];

        $this->headers = [
            "Authorization: {$this->token}",
            'Accept: application/json',
            'Content-Type: application/json',
        ];
        $this->options = (array) $config['options'];
        $this->timeout = (int) !empty($config['options']['timeout']) ? $config['options']['timeout'] : 60;
        $this->http_version = (int) !empty($config['options']['http_version'])
            ? $config['options']['http_version']
            : CURL_HTTP_VERSION_NONE;
        $this->port = (int) !empty($config['options']['port']) ? $config['options']['port'] : 443;
    }

    /**
     * Request
     * @param string $method
     * @param string $route
     * @param array $payload
     * @return string
     */
    public function request(string $method, string $route, array $payload = [])
    {
        return $this->send($method, $route, json_encode($payload));
    }

    /**
     * Send
     * @param string $route
     * @param array $payload
     * @return string
     * @throws \Exception
     */
    public function sendMultipart(string $route, array $payload = [])
    {
        $std = (object) $payload;
        $this->headers = [
            "Authorization: {$this->token}",
            'Content-Type: multipart/form-data',
            'Accept: application/json'
        ];
        $payload = [
            'tipo' => $std->tipo,
            'ano' => $std->ano,
            'mes' => $std->mes,
            'arquivo'=> new \CURLFile($std->arquivo)
        ];
        return $this->send('POST', $route, $payload);
    }

    /**
     * @param string $method
     * @param string $route
     * @param array|string|null $payload
     * @return string
     */
    protected function send(string $method, string $route, $payload = null)
    {
        $oCurl = curl_init();
        curl_setopt_array($oCurl, [
            CURLOPT_URL => "{$this->base_uri}{$route}",
            CURLOPT_IPRESOLVE => CURL_IPRESOLVE_V4,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_HEADER => false,
            CURLOPT_CONNECTTIMEOUT => $this->timeout,
            CURLOPT_TIMEOUT => $this->timeout + 20,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_SSL_VERIFYHOST => 2,
            CURLOPT_SSL_VERIFYPEER => 2,
            CURLOPT_HTTP_VERSION => $this->http_version,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_POSTFIELDS => $payload,
            CURLOPT_HTTPHEADER => $this->headers
        ]);
        $resp = curl_exec($oCurl);
        $this->error['message'] = curl_error($oCurl);
        $this->error['code'] = curl_errno($oCurl);
        $httpcode = curl_getinfo($oCurl, CURLINFO_HTTP_CODE);
        curl_close($oCurl);
        if (!empty($this->error['message'])) {
            throw new \Exception("Falha de comunicação! [{$this->error['code']}] {$this->error['message']}", 500);
        }
        if ($httpcode != 200) {
            if (intval($httpcode) == 0) {
                $httpcode = 52;
            }
            throw new \Exception("Falha de comunicação! [{$httpcode}] {$resp}", 500);
        }
        return $resp;
    }
}
