<?php

namespace CloudDfe\SdkPHP;

class Cte extends Base
{
    /**
     * Consulta status da SEFAZ
     * @return \stdClass
     */
    public function status()
    {
        return $this->client->send('GET', '/cte/status', []);
    }

    /**
     * Consulta CTe pela Chave
     * @param array $payload
     * @return \stdClass
     * @throws \Exception
     */
    public function consulta($payload)
    {
        $key = self::checkKey($payload);
        return $this->client->send('GET', "/cte/{$key}", []);
    }

    /**
     * Solicita DACTE
     * @param array $payload
     * @return \stdClass
     * @throws \Exception
     */
    public function pdf($payload)
    {
        $key = self::checkKey($payload);
        return $this->client->send('GET', "/cte/pdf/{$key}", []);
    }

    /**
     * Cria uma nova CTe
     * @param array $payload
     * @return \stdClass
     */
    public function cria($payload)
    {
        return $this->client->send('POST', "/cte", $payload);
    }

    /**
     * Consulta CTes na base de dados
     * @param array $payload
     * @return \stdClass
     */
    public function busca($payload)
    {
        return $this->client->send('POST', "/cte/busca", $payload);
    }

    /**
     * Cancela CTe
     * @param array $payload
     * @return \stdClass
     */
    public function cancela($payload)
    {
        return $this->client->send('POST', "/cte/cancela", $payload);
    }

    /**
     * Gera carta de correção de CTe
     * @param array $payload
     * @return \stdClass
     */
    public function correcao($payload)
    {
        return $this->client->send('POST', "/cte/correcao", $payload);
    }

    /**
     * Inutiliza faixa de CTe
     * @param array $payload
     * @return \stdClass
     */
    public function inutiliza($payload)
    {
        return $this->client->send('POST', "/cte/inutiliza", $payload);
    }

    /**
     * Busca por backup de CTe emitidas
     * @param array $payload
     * @return \stdClass
     */
    public function backup($payload)
    {
        return $this->client->send('POST', "/cte/backup", $payload);
    }

    /**
     * Importa o XML de um CTe
     * @param array $payload
     * @return \stdClass
     */
    public function importa($payload)
    {
        return $this->client->send('POST', "/cte/importa", $payload);
    }

    /**
     * Prevalida dados para emissão de CTe
     * @param array $payload
     * @return \stdClass
     */
    public function preview($payload)
    {
        return $this->client->send('POST', "/cte/preview", $payload);
    }

    /**
     * Solicita o evento de manifestação de desacordo da operação
     * @param array $payload
     * @return \stdClass
     */
    public function desacordo($payload)
    {
        return $this->client->send('POST', "/cte/desacordo", $payload);
    }
}
