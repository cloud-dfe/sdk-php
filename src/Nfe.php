<?php

namespace CloudDfe\SdkPHP;

class Nfe extends Base
{
    // @param array $payload
    // @return \stdClass
    // @throws \Exception
    public function cria($payload)
    {
        return $this->client->send("POST", "/nfe", $payload);
    }

    // @param array $payload
    // @return \stdClass
    // @throws \Exception
    public function preview($payload)
    {
        return $this->client->send("POST", "/nfe/preview", $payload);
    }

    // @return \stdClass
    // @throws \Exception
    public function status()
    {
        return $this->client->send("GET", "/nfe/status", []);
    }

    // @param array $payload
    // @return \stdClass
    // @throws \Exception
    public function consulta($payload)
    {
        $key = self::checkKey($payload);
        return $this->client->send("GET", "/nfe/{$key}", []);
    }

    // @param array $payload
    // @return \stdClass
    // @throws \Exception
    public function busca($payload)
    {
        return $this->client->send("POST", "/nfe/busca", $payload);
    }

    // @param array $payload
    // @return \stdClass
    // @throws \Exception
    public function cancela($payload)
    {
        return $this->client->send("POST", "/nfe/cancela", $payload);
    }

    // @param array $payload
    // @return \stdClass
    // @throws \Exception
    public function correcao($payload)
    {
        return $this->client->send("POST", "/nfe/correcao", $payload);
    }

    // @param array $payload
    // @return \stdClass
    // @throws \Exception
    public function inutiliza($payload)
    {
        return $this->client->send("POST", "/nfe/inutiliza", $payload);
    }

    // @param array $payload
    // @return \stdClass
    // @throws \Exception
    public function pdf($payload)
    {
        $key = self::checkKey($payload);
        return $this->client->send("GET", "/nfe/pdf/{$key}", []);
    }

    // @param array $payload
    // @return \stdClass
    // @throws \Exception
    public function etiqueta($payload)
    {
        $key = self::checkKey($payload);
        return $this->client->send("GET", "/nfe/pdf/etiqueta/{$key}", []);
    }

    // @param array $payload
    // @return \stdClass
    // @throws \Exception
    public function simples($payload)
    {
        $key = self::checkKey($payload);
        return $this->client->send("GET", "/nfe/pdf/simples/{$key}", []);
    }

    // @param array $payload
    // @return \stdClass
    // @throws \Exception
    public function manifesta($payload)
    {
        return $this->client->send("POST", "/nfe/manifesta", $payload);
    }

    // @param array $payload
    // @return \stdClass
    // @throws \Exception
    public function backup($payload)
    {
        return $this->client->send("POST", "/nfe/backup", $payload);
    }

    // @param array $payload
    // @return \stdClass
    // @throws \Exception
    public function download($payload)
    {
        $key = self::checkKey($payload);
        return $this->client->send("GET", "/nfe/download/{$key}", []);
    }

    // @param array $payload
    // @return \stdClass
    // @throws \Exception
    public function recebidas($payload)
    {
        return $this->client->send("POST", "/nfe/recebidas", $payload);
    }

    // @param array $payload
    // @return \stdClass
    // @throws \Exception
    public function interessado($payload)
    {
        return $this->client->send("POST", "/nfe/interessado", $payload);
    }

    // @param array $payload
    // @return \stdClass
    // @throws \Exception
    public function importa($payload)
    {
        return $this->client->send("POST", "/nfe/importa", $payload);
    }

    // @param array $payload
    // @return \stdClass
    // @throws \Exception
    public function comprovante($payload)
    {
        return $this->client->send("POST", "/nfe/comprovante", $payload);
    }

    // @param array $payload
    // @return \stdClass
    // @throws \Exception
    public function cadastro($payload)
    {
        return $this->client->send("POST", "/nfe/cadastro", $payload);
    }
}
