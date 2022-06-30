# SDK em PHP puro para API CloudDFe

Este SDK em PHP puro tem por objetivo simplificar a tarefa de intalação e preparação do seu sistema para uso da nossa API, removendo parte da complexidade subjacente ao uso da mesma.

*NOTA: usa apenas o cURL diretamente sem usar pacotes de terceiros.*


[![Latest Version on Packagist][ico-version]][link-packagist]


## Forma de instalação do SDK

```
composer require cloud-dfe/sdk-php
```

## Forma de uso

Uma vez instalado o SDK é uma tarefa muito simples invocar o seu uso, por exemplo:

```php

use CloudDfe\SdkPHP\Nfe;

try {
    //defina os parametros basicos
    $params = [
        'token' => 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbXAiOjcwLCJ1c3IiOiIyIiwidHAiOjIsImlhdCI6MTU4MDkzNzM3MH0.KvSUt2x8qcu4Rtp2XNTOINqR',
        'ambiente' => Nfe::AMBIENTE_HOMOLOGACAO,
        'options' => [
            'debug' => false,
            'timeout' => 60,
            'port' => 443,
            'http_version' => CURL_HTTP_VERSION_NONE,
            'contingencia' => false
        ]
    ];
    //instancie a classe para a operação desejada
    $nfe = new Nfe($params);

    //realize a operação desejada
    $resp = $nfe->status();

    //$resp irá conter um OBJETO stdClass com o retorno da API
    echo "<pre>";
    print_r($resp);
    echo "</pre>";

} catch (\Exception $e) {
    echo $e->getMessage();
}
```

Para saber os detalhes referentes ao dados de envio e os retornos consulte nossa documentação [CloudDocs](https://doc.cloud-dfe.com.br/).

E veja alguns detalhes na pasta dos [EXEMPLOS](https://github.com/cloud-dfe/clouddfe-sdk-php-curl/tree/master/examples).

[Operações da SOFTHOUSE](SOFTHOUSE.md)

[Operações com cadastro do EMITENTE](EMITENTE.md)

[Operações com os CERTIFICADOS](CERTIFICADO.md)

[Operações com NFE](NFE.md)

[Operações com NFCE](NFCE.md)

[Operações com NFSE](NFSE.md)

[Operações com CTE](CTE.md)

[Operações com CTEOS](CTEOS.md)

[Operações com MDFE](MDFE.md)

[Operações com DFE](DFE.md)

[Operações com SINTEGRA](SINTEGRA.md)

[ico-version]: https://img.shields.io/packagist/v/cloud-dfe/sdk-php.svg?style=flat-square
[link-packagist]: https://packagist.org/packages/cloud-dfe/sdk-php
