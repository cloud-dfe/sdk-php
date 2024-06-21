# SDK em PHP para API Integra Notas

Este SDK visa simplificar a integração do seu sistema com a nossa API, oferecendo classes com funções pré-definidas para acessar as rotas da API. Isso elimina a necessidade de desenvolver uma aplicação para se comunicar diretamente com a nossa API, tornando o processo mais eficiente e direto.

*NOTA: usa apenas o cURL diretamente sem usar pacotes de terceiros.*


[![Latest Version on Packagist][ico-version]][link-packagist]


## Forma de instalação do SDK

```
composer require cloud-dfe/sdk-php
```

## Forma de uso

```php

use CloudDfe\SdkPHP\Nfe;

try {
    // DEFINIÇÕES DOS PARAMETROS BASICOS
    $params = [
        "token" => "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbXAiOiJ0b2tlbl9leGVtcGxvIiwidXNyIjoidGsiLCJ0cCI6InRrIn0.Tva_viCMCeG3nkRYmi_RcJ6BtSzui60kdzIsuq5X-sQ",
        "ambiente" => Nfe::AMBIENTE_HOMOLOGACAO,
        "options" => [
            "debug" => false,
            "timeout" => 60,
            "port" => 443,
            "http_version" => CURL_HTTP_VERSION_NONE
        ]
    ];

    // INSTANCIE A CLASSE PARA A OPERAÇÃO DESEJADA

    $nfe = new Nfe($params);

    $resp = $nfe->status();

    // resp RETORNA O OBJETO DE RETORNO DA API

    echo "<pre>";
    print_r($resp);
    echo "</pre>";

} catch (\Exception $e) {
    echo $e->getMessage();
}

```

### Sobre dados de envio e retornos

Para saber os detalhes referente ao dados de envio e os retornos consulte nossa documentação [IntegraNotas Documentação](https://integranotas.com.br/doc).

### Veja alguns exemplos de consumi de nossa API nos link abaixo:

[Pasta de Exemplos](https://github.com/cloud-dfe/sdk-php/tree/master/examples)

[Utilitários](https://github.com/cloud-dfe/sdk-php/tree/master/examples/util)

[Averbação](https://github.com/cloud-dfe/sdk-php/tree/master/examples/averbacao)

[Certificado Digital](https://github.com/cloud-dfe/sdk-php/tree/master/examples/certificado)

[CT-e](https://github.com/cloud-dfe/sdk-php/tree/master/examples/cte)

[CT-e OS](https://github.com/cloud-dfe/sdk-php/tree/master/examples/cteos)

[DF-e](https://github.com/cloud-dfe/sdk-php/tree/master/examples/dfe)

[Emitente](https://github.com/cloud-dfe/sdk-php/tree/master/examples/emitente)

[GNR-e](https://github.com/cloud-dfe/sdk-php/tree/master/examples/gnre)

[MDF-e](https://github.com/cloud-dfe/sdk-php/tree/master/examples/mdfe)

[NFC-e](https://github.com/cloud-dfe/sdk-php/tree/master/examples/nfce)

[NFCom](https://github.com/cloud-dfe/sdk-php/tree/master/examples/nfcom)

[NF-e](https://github.com/cloud-dfe/sdk-php/tree/master/examples/nfe)

[NFS-e](https://github.com/cloud-dfe/sdk-php/tree/master/examples/nfse)

[Softhouse](https://github.com/cloud-dfe/sdk-php/tree/master/examples/softhouse)

[ico-version]: https://img.shields.io/packagist/v/cloud-dfe/sdk-php.svg?style=flat-square
[link-packagist]: https://packagist.org/packages/cloud-dfe/sdk-php
