<?php

namespace CloudDfe\SdkPHP;

class Client
{
    /**
     * @var int
     */
    protected $ambiente = 2;
    /**
     * @var string
     */
    protected $token = '';
    /**
     * @var array
     * [
     *    'debug' => false,
     *    'timeout' => 10,
     *    'http_version' => '1.1',
     *    'port' => 443
     * ]
     */
    protected $options = [];
    /**
     * @var string
     */
    protected $uri = '';
    /**
     * @var array
     */
    protected $params = [];
    /**
     * @var HttpCurl
     */
    protected $client;

    const AMBIENTE_PRODUCAO = 1;
    const AMBIENTE_HOMOLOGACAO = 2;

    /**
     * Client constructor.
     * @param array $params
     * @param string $direction
     * @throws \Exception
     */
    public function __construct($params = [], $direction = 'api')
    {
        $this->params = $params;
        if (empty($params)) {
            throw new \Exception("Devem ser passados os parametros básicos.");
        }
        if (!in_array($params['ambiente'], [self::AMBIENTE_PRODUCAO, self::AMBIENTE_HOMOLOGACAO])) {
            throw new \Exception("O ambiente de ser 1-produção ou 2-homologação.");
        }
        if (empty($params['token'])) {
            throw new \Exception("O token é obrigatorio.");
        }
        $this->ambiente = !empty($params['ambiente']) ? $params['ambiente'] : 2;
        $this->token = !empty($params['token']) ? $params['token'] : '';
        $this->options = !empty($params['options']) ? $params['options'] : [];
        $debug = false;
        if (!empty($params['options'])) {
            $debug = $params['options']['debug'] == true ? true : false;
        }
        $config = json_decode(file_get_contents(__DIR__ . '/config.json'), true);
        $this->uri = $config[$direction][$this->ambiente];
        if (!empty($params['options']['contingencia']) && $this->ambiente == 1 && $direction == 'api') {
            $this->uri = $config[$direction]['svc'];
        }
        $this->client = new HttpCurl([
            'debug' => $debug,
            'base_uri' => $this->uri,
            'token' => $this->token,
            'options' => $this->options
        ]);
    }

    /**
     * @param string $route
     * @param array $payload
     * @return \stdClass
     * @throws \Exception
     */
    public function sendMultpart($route, $payload)
    {
        return json_decode($this->client->sendMultipart($route, $payload));
    }

    /**
     * Envia os dados ao servidor
     * @param string $method
     * @param string $route
     * @param array $payload
     * @return \stdClass
     */
    public function send($method, $route, $payload = [])
    {
        return json_decode($this->client->request($method, $route, $payload));
    }
}
