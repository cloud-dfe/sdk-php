<?php

require_once(__DIR__ . "/../../bootstrap.php");

use CloudDfe\SdkPHP\Gnre;

/**
 * Este exemplo de uma chamada a API usando este SDK
 *
 * Este método cria uma GNRe
 */
try {
    $params = [
        "token" => "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbXAiOiJ0b2tlbl9leGVtcGxvIiwidXNyIjoidGsiLCJ0cCI6InRrIn0.Tva_viCMCeG3nkRYmi_RcJ6BtSzui60kdzIsuq5X-sQ",
        "ambiente" => Gnre::AMBIENTE_HOMOLOGACAO,
        "options" => [
            "debug" => false,
            "timeout" => 60,
            "port" => 443,
            "http_version" => CURL_HTTP_VERSION_NONE
        ]
    ];
    $gnre = new Gnre($params);
    $payload = [
        "numero" => "6",
        "uf_favoverida" => "RO",
        "ie_emitente_uf_favorecida" => null,
        "tipo" => "0",
        "valor" => 12.55,
        "data_pagamento" => "2022-05-22",
        "identificador_guia" => "12345",
        "receitas" => [
            [
                "codigo" => "100102",
                "detalhamento" => null,
                "data_vencimento" => "2022-05-22",
                "convenio" => "Convênio ICMS 142/18",
                "numero_controle" => "1",
                "numero_controle_fecp" => null,
                "documento_origem" => [
                    "numero" => "000000001",
                    "tipo" => "10"
                ],
                "produto" => null,
                "referencia" => [
                    "periodo" => "0",
                    "mes" => "05",
                    "ano" => "2022",
                    "parcela" => null
                ],
                "valores" => [
                    [
                        "valor" => 12.55,
                        "tipo" => "11"
                    ]
                ],
                "contribuinte_destinatario" => [
                    "cnpj" => null,
                    "cpf" => null,
                    "ie" => null,
                    "razao" => null,
                    "ibge" => null
                ],
                "extras" => [
                    [
                        "codigo" => "52",
                        "conteudo" => "32220526434850000191550100000000011015892724"
                    ]
                ]
            ]
        ]
    ];
    //os payloads são sempre ARRAYS
    $resp = $gnre->cria($payload);
    echo "<pre>";
    print_r($resp);
    echo "</pre>";
    if ($resp->sucesso) {
        $chave = $resp->chave;
        if ($resp->codigo == 5023) {
            /**
             * Em alguns casos a SEFAZ pode demorar mais do que esperado pela api
             * para processar o lote, devido a trafego na rede ou sobrecarga de processamento
             * então nesse caso quando vir codigo 5023 é necessario buscar o GNRe pela chave de acesso
             */
            sleep(5);
            $tentativa = 1;
            while ($tentativa <= 5) {
                $payload = [
                    "chave" => $chave
                ];
                $resp = $gnre->consulta($payload);
                if ($resp->codigo != 5023) {
                    if ($resp->sucesso) {
                        // autorizado
                        var_dump($resp);
                        break;
                    } else {
                        // rejeição
                        var_dump($resp);
                        break;
                    }
                }
                sleep(5);
                $tentativa++;
            }
        } else {
            // autorizado
            var_dump($resp);
        }
    } else if (in_array($resp->codigo, [5001, 5002])) {
        // erro nos campos
        var_dump($resp->erros);
    } else if ($resp->codigo == 5008 or $resp->codigo >= 7000) {
        $chave = $resp->chave;
        // >= 7000 erro de timout ou de conexão
        // 5008 documento já criado
        var_dump($resp);
        $payload = [
            "chave" => $chave
        ];
        // recomendamos fazer a consulta pela chave para sincronizar o documento
        $resp = $gnre->consulta($payload);
        if ($resp->sucesso) {
            // autorizado
            var_dump($resp);
        } else {
            // rejeição
            var_dump($resp);
        }
    } else {
        // rejeição
        var_dump($resp);
    }
} catch (\Exception $e) {
    echo $e->getMessage();
}
