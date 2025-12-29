<?php

require_once ('services.php');
class IClass // Renomeie para o nome do serviço que irá utilizar exemplo NF-e fica INfe
{
    protected $services;

    public function __construct($ambiente, $token)
    {
        $this->services = new IServices($ambiente, $token);
    }

    public static function checkKey($payload)
    {
        if (!isset($payload["chave"])) {
            throw new \Exception("A chave não foi informada.");
        }

        $key = preg_replace("/[^0-9]/", "", $payload["chave"]);

        if (empty($key) || strlen($key) != 44) {
            throw new \Exception("A chave deve ter 44 dígitos numéricos.");
        }

        return $key;
    }

    public static function encode($data)
    {
        return base64_encode($data);
    }

    public static function decode($data)
    {
        $decoded = @base64_decode($data);
        $gz = @gzdecode($decoded);
        if ($gz !== false) {
            return $gz;
        }
        return $decoded;
    }

    // ENDPOINTS
    // Mude apenas o servico para o servico que irá utilizar exemplo NF-e fica /nfe

    public function cria($payload)
    {
        return $this->services->request("POST", "/servico", $payload);
    }

    public function cancela($payload)
    {
        return $this->services->request("POST", "/servico/cancela", $payload);
    }

    public function consulta($payload)
    {
        $key = self::checkKey($payload);
        return $this->services->request("GET", "/servico/{$key}", []);
    }
    
}