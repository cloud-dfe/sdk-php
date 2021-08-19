# Operações com o cadastro do EMITENTE

*NOTA: estas operações funcionam em ambos os ambientes (homologação e produção)*

*NOTA: Estas operações somente podem ser executada com o token do emitente.*

*NOTA: campos opcionais nos payloads podem e devem ser NULIFICADOS ou não passados caso não sejam usados, nunca deixa-los como string vazia ou zero.*

**LEMBRE-SE: as consultas usando o SDK sempre retornam um objeto stdClass;**


## Atualização de cadastro do Emitente

Este método solicita a alteração dos dodos cadastrais do emitente, isso normalmente ocorre quando existe alguma alteração como mudança de endereço por exemplo.

*NOTA: não podem ser alterados o CNPJ ou o CPF do emitente.*

É muito importante que estude a [nossa documentação](https://doc.cloud-dfe.com.br/v1/emitente/#!/1-5) para poder enviar essa chamada.

```php
use CloudDfe\SdkPHP\Emitente;

try {
    $params = [
        'ambiente' => Emitente::AMBIENTE_HOMOLOGACAO,
        'token' => 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbXAiOjcwLCJ1c3IiOiIyIiwidHAiOjIsImlhdCI6MTU4MDkzNzM3MH0.KvSUt2x8qcu4Rtp2XNTOINqR-3c5V8iyITDmLoUF_SE',
        'options' => [
            'debug' => false,
        ]
    ];
    $emitente = new Emitente($params);

    $payload = [
        'nome' => 'FULANO DA SILVA',
        'razao' => 'FULANO DA SILVA LTDA',
        "cnae" => '1234567',
        "crt" => 3,
        'ie' => '9876544321',
        'im' => '1234',
        'csc' => '9KLRH4IEMIQ58TKBOLRPHNDAN0SJEOKFK453',
        'cscid' => '2',
        'tar' => null,
        'login_prefeitura' => null,
        'senha_prefeitura' => null,
        'client_id_prefeitura' => null,
        'client_secret_prefeitura' =>null,
        'telefone' => '115555555',
        'email' => 'fulano@fulano.com.br',
        'rua' => 'AL JAPURUS',
        'numero' => '1345',
        'complemento' => 'Sala 111',
        'bairro' => 'BRAS',
        'municipio' => 'São Paulo',
        'cmun' => '3550308',
        'uf' => 'SP',
        'cep' => '02233000',
        'logo' => null
    ];
    //os payloads são sempre ARRAYS
    $resp = $emitente->atualiza($payload);

    echo "<pre>";
    print_r($resp); //imprime o objeto $resp em tela
    echo "</pre>";

} catch (\Exception $e) {
    echo $e->getMessage();
}
```


## Troca do TOKEN de acesso a API

Este método solicita a troca de token do emitente.

*NOTA: Isso pode ocorrer caso haja suspeita de violação da segurança do seu aplicativo.*

*NOTA: Ao executar essa chamada o TOKEN anterior deixará de validar e apenas o novo TOKEN criado porderá ser usado.*

É muito importante que estude a [nossa documentação](https://doc.cloud-dfe.com.br/v1/emitente/#!/1-3) para poder enviar essa chamada.

```php
use CloudDfe\SdkPHP\Emitente;

try {
    $params = [
        'ambiente' => Emitente::AMBIENTE_HOMOLOGACAO,
        'token' => 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbXAiOjcwLCJ1c3IiOiIyIiwidHAiOjIsImlhdCI6MTU4MDkzNzM3MH0.KvSUt2x8qcu4Rtp2XNTOINqR-3c5V8iyITDmLoUF_SE',
        'options' => [
            'debug' => false,
        ]
    ];
    $emitente = new Emitente($params);

    $resp = $emitente->token();

    echo "<pre>";
    print_r($resp); //imprime o objeto $resp em tela
    echo "</pre>";

} catch (\Exception $e) {
    echo $e->getMessage();
}
```

## Mostra os dados do emitente

Este método mostra os dados atuais do emitente em nossas bases de dados.

É muito importante que estude a [nossa documentação](https://doc.cloud-dfe.com.br/v1/emitente/) para poder enviar essa chamada.

```php
use CloudDfe\SdkPHP\Emitente;

try {
    $params = [
        'ambiente' => Emitente::AMBIENTE_HOMOLOGACAO,
        'token' => 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbXAiOjcwLCJ1c3IiOiIyIiwidHAiOjIsImlhdCI6MTU4MDkzNzM3MH0.KvSUt2x8qcu4Rtp2XNTOINqR-3c5V8iyITDmLoUF_SE',
        'options' => [
            'debug' => false,
        ]
    ];
    $emitente = new Emitente($params);

    $resp = $emitente->mostra();

    echo "<pre>";
    print_r($resp); //imprime o objeto $resp em tela
    echo "</pre>";

} catch (\Exception $e) {
    echo $e->getMessage();
}
```
