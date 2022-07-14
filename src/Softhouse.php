<?php

namespace CloudDfe\SdkPHP;

class Softhouse extends Base
{
    /**
     * @param array $payload
     * @return \stdClass
     */
    public function criaEmitente($payload)
    {
        return $this->client->send('POST', "/soft/emitente", $payload);
    }

    /**
     * @param array $payload
     * @return \stdClass
     */
    public function atualizaEmitente($payload)
    {
        return $this->client->send('PUT', "/soft/emitente", $payload);
    }

    /**
     * @param array $payload
     * @return \stdClass
     */
    public function mostraEmitente($payload)
    {
        if (empty($payload) || empty($payload['doc'])) {
            throw new \Exception('Deve ser passado um CNPJ ou um CPF para efetuar a deleçao do emitente.');
        }
        $doc = $payload['doc'];
        return $this->client->send('GET', "/soft/emitente/$doc");
    }

    /**
     * @param array $payload
     * @return \stdClass
     */
    public function listaEmitentes($payload)
    {
        $status = !empty($payload['status']) ? $payload['status'] : '';
        $rota = '/soft/emitente';
        if ($status == 'deletados' || $status == 'inativos') {
            $rota = '/soft/emitente/deletados';
        }
        return $this->client->send('GET', $rota, []);
    }

    /**
     * @param array $payload
     * @return \stdClass
     * @throws \Exception
     */
    public function deletaEmitente($payload)
    {
        if (empty($payload) || empty($payload['doc'])) {
            throw new \Exception('Deve ser passado um CNPJ ou um CPF para efetuar a deleçao do emitente.');
        }
        $doc = $payload['doc'];
        return $this->client->send('DELETE', "/soft/emitente/$doc", []);
    }
}
