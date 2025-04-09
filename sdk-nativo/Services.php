<?php

class IServicesNFe
{

    protected $base_uri = "";
    protected $timeout = 60;
    protected $port = 443;
    protected $token = "";

    const URLS = [
        'api' => [
            '1' => 'https://api.integranotas.com.br/v1',
            '2' => 'https://hom-api.integranotas.com.br/v1'
        ]
    ];

    const AMBIENTE_PRODUCAO = 1;
    const AMBIENTE_HOMOLOGACAO = 2;

    public function __construct($ambiente, $token)
    {
        if (!in_array($ambiente, [1, 2, self::AMBIENTE_PRODUCAO, self::AMBIENTE_HOMOLOGACAO])) {
            throw new \Exception("O ambiente deve ser 1-produção ou 2-homologação.");
        }

        if (!isset($token) || empty($token)) {
            throw new \Exception("O token de emitente é obrigatório.");
        }

        $this->base_uri = self::URLS["api"][$ambiente];
        $this->token = $token;
    }

    public function request($method, $route, $payload = [])
    {
        $headers = [
            "Authorization: {$this->token}",
            "Content-Type: application/json",
            "Accept: application/json"
        ];

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
            CURLOPT_POSTREDIR => CURL_REDIR_POST_ALL, // VERIFICAR
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_NONE,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_HTTPHEADER => $headers
        ]);

        $response = curl_exec($oCurl);

        $error["message"] = curl_error($oCurl);
        $error["code"] = curl_errno($oCurl);

        curl_close($oCurl);

        if (!empty($error["message"])) {
            throw new \Exception("Erro ao realizar a requisição: {$error["message"]}");
        }

        return $response;
    }

}