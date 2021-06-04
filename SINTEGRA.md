# Operações com SINTEGRA

*NOTA: estas operações com o SINTEGRA funcionam apenas ambiente de produção*

*NOTA: Esta operação somente pode ser executada com o token do emitente.*

**LEMBRE-SE: as consultas usando o SDK sempre retornam um objeto stdClass.**

*NOTA: todo o processamento do sintegra é ASSINCRONO, ou seja é realizado através de filas de processamento, portanto caso se deseje saber a situação do processamento será necessaria realizar uma consulta. A depender do volume de dados o processamento completo pode levar algumas horas.*

A geração do SINTEGRA (obrigação acessória), é realizada sobre os dados consistidos na base de dados do sistema do emitente, portanto se faz necessário que sejam extraidos e processados os dados do SEU sistema a fim de ser possível a geração do arquivo do SINTEGRA.

- Etapa 1 - processar os dados necessários e enviar para a API os arquivos zip obtidos

- Etapa 2 - consultar a situação do processamento, caso todos os arquivos tenham sido processados com sucesso, estará autorizado a solicitar a geração do Sintegra desses dados.

- Etapa 3 - solicitar a geração do arquivo SINTEGRA

**NOTA: caso o emitente cadastrado possua um webhook para receber notificações, o resultado das operações será retornado por esse canal de forma automática ao término do processamento, seja com sucesso ou com alguma falha.**

## Envio de dados das NFe (emitidas e recebidas)

São necessários os dados das NFe emitidas e recebidas pelo emitente.
Estes dados deverão ser extraídos, processados e colocados em arquivo no formato json, e compactado com ZIP para ser enviado para analise e processamento na API.

```php
use CloudDfe\SdkPHP\Sintegra;

try {
    $params = [
        'token' => 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbXAiOjcwLCJ1c3IiOiIyIiwidHAiOjIsImlhdCI6MTU4MDkzNzM3MH0.KvSUt2x8qcu4Rtp2XNTOINqR',
        'ambiente' => Sintegra::AMBIENTE_HOMOLOGACAO,
        'options' => [
            'debug' => false,
        ]
    ];
    $sintegra = new Sintegra($params);

    //informar tipo e o periodo a que se referem os dados contidos no arquivo zip
    $payload = [
        'ano' => 2021,
        'mes' => 2,
        'tipo' => 'nfe',
        'arquivo' => __DIR__.'/nfes_2021_01.zip'
    ];
    //os payloads são sempre ARRAYS
    $resp = $sintegra->upload($payload);

    echo "<pre>";
    print_r($resp);
    echo "</pre>";

} catch (\Exception $e) {
    echo $e->getMessage();
}

```


## Envio de dados dos CTe (emitidos e recebidos)

São necessários os dados das CTe emitidos e recebidos pelo emitente.
Estes dados deverão ser extraidos, processados e colocados em um arquivo no formato json, e compactado com ZIP para ser enviado para analise e processamento na API.

```php
use CloudDfe\SdkPHP\Sintegra;

try {
    $params = [
        'token' => 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbXAiOjcwLCJ1c3IiOiIyIiwidHAiOjIsImlhdCI6MTU4MDkzNzM3MH0.KvSUt2x8qcu4Rtp2XNTOINqR',
        'ambiente' => Sintegra::AMBIENTE_HOMOLOGACAO,
        'options' => [
            'debug' => false,
        ]
    ];
    $sintegra = new Sintegra($params);

    //informar tipo e o periodo a que se referem os dados contidos no arquivo zip
    $payload = [
        'ano' => 2021,
        'mes' => 2,
        'tipo' => 'cte',
        'arquivo' => __DIR__.'/ctes_2021_01.zip'
    ];
    //os payloads são sempre ARRAYS
    $resp = $sintegra->upload($payload);

    echo "<pre>";
    print_r($resp);
    echo "</pre>";

} catch (\Exception $e) {
    echo $e->getMessage();
}
```
## Envio de dados do Inventário realizado

São necessários (periodicamente) os dados relativos ao inventário realizado sobre os estoques existentes, com a contagem e precificação do itens desse estoque.
Estes dados deverão ser extraidos, processados e colocados em um arquivo no formato json, e compactado com ZIP para ser enviado para analise e processamento na API.

```php
use CloudDfe\SdkPHP\Sintegra;

try {
    $params = [
        'token' => 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbXAiOjcwLCJ1c3IiOiIyIiwidHAiOjIsImlhdCI6MTU4MDkzNzM3MH0.KvSUt2x8qcu4Rtp2XNTOINqR',
        'ambiente' => Sintegra::AMBIENTE_HOMOLOGACAO,
        'options' => [
            'debug' => false,
        ]
    ];
    $sintegra = new Sintegra($params);

    //informar tipo e o periodo a que se referem os dados contidos no arquivo zip
    $payload = [
        'ano' => 2021,
        'mes' => 2,
        'tipo' => 'inventario',
        'arquivo' => __DIR__.'/inventario_2021_01.zip'
    ];
    //os payloads são sempre ARRAYS
    $resp = $sintegra->upload($payload);

    echo "<pre>";
    print_r($resp);
    echo "</pre>";

} catch (\Exception $e) {
    echo $e->getMessage();
}
```

## Consulta da situação do processamento dos dados enviados

Este método permite que seja consultada a situação do processamento dos arquivos enviados. Caso algum arquivo apresente erros o SINTEGRA não será gerado.

```php
use CloudDfe\SdkPHP\Sintegra;

try {
    $params = [
        'token' => 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbXAiOjcwLCJ1c3IiOiIyIiwidHAiOjIsImlhdCI6MTU4MDkzNzM3MH0.KvSUt2x8qcu4Rtp2XNTOINqR',
        'ambiente' => Sintegra::AMBIENTE_HOMOLOGACAO,
        'options' => [
            'debug' => false,
        ]
    ];
    $sintegra = new Sintegra($params);

    //informar a que período essa consulta se refere
    $payload = [
        'ano' => 2021,
        'mes' => 2
    ];
    //os payloads são sempre ARRAYS
    $resp = $sintegra->consultar($payload);

    echo "<pre>";
    print_r($resp);
    echo "</pre>";

} catch (\Exception $e) {
    echo $e->getMessage();
}
```

## Geração do Sintegra

Este método solicita a criação do arquivo SINTEGRA, como é uma operação ASSINCRINA outras soliciatações identicas subsequentes irão retornar o status desse processamento.

```php
use CloudDfe\SdkPHP\Sintegra;

try {
    $params = [
        'token' => 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbXAiOjcwLCJ1c3IiOiIyIiwidHAiOjIsImlhdCI6MTU4MDkzNzM3MH0.KvSUt2x8qcu4Rtp2XNTOINqR',
        'ambiente' => Sintegra::AMBIENTE_HOMOLOGACAO,
        'options' => [
            'debug' => false,
        ]
    ];
    $sintegra = new Sintegra($params);
    //informar os dados para a geração do Sintegra para o período desejado
    $payload = [
        'ano' => 2021,
        'mes' => 2,
        'natureza' => 3,
        'finalidade' => 1,
        'processar_novamente' => false
    ];
    $resp = $sintegra->gerar($payload);

    echo "<pre>";
    print_r($resp);
    echo "</pre>";

} catch (\Exception $e) {
    echo $e->getMessage();
}
```
