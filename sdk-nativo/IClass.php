<?php
class IClass // Nome do serviço aqui
{
    protected $services;

    public function __construct($ambiente, $token)
    {
        $this->services = new IServicesNFe($ambiente, $token);
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

    public function exemplo_post($payload)
    {
        return $this->services->request("POST", "/rota", $payload);
    }

    public function exemple_consulta($payload)
    {
        $key = self::checkKey($payload);
        return $this->services->request("GET", "/rota/{$key}", []);
    }
    
}