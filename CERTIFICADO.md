# Operações com os CERTIFICADOS

*NOTA: estas operações funcionam em ambos os ambientes (homologação e produção)*

*NOTA: Esta operação somente pode ser executada com o token do emitente.*

**LEMBRE-SE: as consultas usando o SDK sempre retornam um objeto stdClass;**

O certificado usado é apenas o modelo A1, esse tipo de certificado vence a cada 12 meses, então necessita ser atualizado periodicamente.

## Atualização do CERTIFICADO DIGITAL

Este método serve para inserir o certificado para o emitente ou atualizar o certificado vencido (ou a vencer) do emitente.

*NOTA: O certificado será VALIDADO antes de ser inserido no registro do emitente, e deve estar válido e pertencer ao CNPJ/CPF do emitente, caso contrario você receberá um aviso de erro e o certificado não será aceito.*

É muito importante que estude a [nossa documentação](https://doc.cloud-dfe.com.br/v1/certificado/#!/1-1) para poder enviar essa chamada.

```php

use CloudDfe\SdkPHP\Certificado;

try {
    $params = [
        'token' => 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbXAiOjcwLCJ1c3IiOiIyIiwidHAiOjIsImlhdCI6MTU4MDkzNzM3MH0.KvSUt2x8qcu4Rtp2XNTOINqR',
        'ambiente' => Certificado::AMBIENTE_HOMOLOGACAO,
        'options' => [
            'debug' => false,
        ]
    ];
    $certificado = new Certificado($params);

    $payload = [
        'certificado' => base64_encode(file_get_contents('expired_certificate.pfx')),
        'senha' => 'associacao'
    ];
    //os payloads são sempre ARRAYS
    $resp = $certificado->atualiza($payload);

    echo "<pre>";
    print_r($resp);
    echo "</pre>";

} catch (\Exception $e) {
    echo $e->getMessage();
}
```

## Consulta da disponibilidade e validade do Certificado

Quando for necessário pode ser consultado o certificado que está cadastrado para o emitente, para saber se o mesmo já foi enviado e registrado na API.

É muito importante que estude a [nossa documentação](https://doc.cloud-dfe.com.br/v1/certificado/#!/1-3) para poder enviar essa chamada.

```php
use CloudDfe\SdkPHP\Certificado;

try {
    $params = [
        'token' => 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbXAiOjcwLCJ1c3IiOiIyIiwidHAiOjIsImlhdCI6MTU4MDkzNzM3MH0.KvSUt2x8qcu4Rtp2XNTOINqR',
        'ambiente' => Certificado::AMBIENTE_HOMOLOGACAO,
        'options' => [
            'debug' => false,
        ]
    ];
    $certificado = new Certificado($params);

    $resp = $certificado->mostra();

    echo "<pre>";
    print_r($resp);
    echo "</pre>";

} catch (\Exception $e) {
    echo $e->getMessage();
}
```
