# Operações com NFSe

*NOTA: estas operações funcionam em ambos os ambientes (homologação e produção)*

*NOTA: Esta operação somente pode ser executada com o token do emitente.*

*NOTA: os campos opcionais não usados podem ser NULIFICADOS ou não passados no array, mas não devem estar em branco ou com zero.*

**LEMBRE-SE: as consultas usando o SDK sempre retornam um objeto stdClass;**


## Cria NFSe

Este método é usado para GERAR uma nova NFSe.

*NOTA: algumas prefeituras operam de mode ASSINCRONO, então nesses casos é necessária que uma segunda chamada (**Consulta**) seja feita alguns segundos (e em alguns casos pelo menos 30 minutos) após o envio desta chamada para se obter o resultado do processamento da NFSe pela prefeitura autorizadora, isso se esta chamada retornar sucesso, é claro.*

*NOTA: em caso de erro no documento, o mesmo será deletado de nossa base de dados e após a correção dos erros reportados, poderá ser feita nova solicitação de criação.*

É muito importante que estude a [nossa documentação](https://doc.cloud-dfe.com.br/v1/nfse/#!/1-4) para poder enviar essa chamada.

```php
use CloudDfe\SdkPHP\Nfse;

try {
    $params = [
        'token' => 'eyJ0eXAiOiJKV1QiLCJh...',
        'ambiente' => Nfse::AMBIENTE_HOMOLOGACAO,
        'options' => ['debug' => true],
    ];
    $nfse = new Nfse($params);
    //dados do RPS para geração da NFSe
    $payload = [
        "numero" => "1",
        "serie" => "0",
        "tipo" => "1",
        "status" => "1",
        "data_emissao" => "2017-12-27T17:43:14-03:00",
        "tomador" => [
            "cnpj" => "12345678901234",
            "cpf" => null,
            "im" => null,
            "razao_social" => "Fake Tecnologia Ltda",
            "endereco" => [
                "logradouro" => "Rua New Horizon",
                "numero" => "16",
                "complemento" => null,
                "bairro" => "Jardim America",
                "codigo_municipio" => "4119905",
                "uf" => "PR",
                "cep" => "81530945"
            ]
        ],
        "servico" => [
            "codigo_tributacao_municipio" => "10500",
            "discriminacao" => "Exemplo Serviço",
            "codigo_municipio" => "4119905",
            "valor_servicos" => "1.00",
            "valor_pis" => "1.00",
            "valor_cofins" => "1.00",
            "valor_inss" => "1.00",
            "valor_ir" => "1.00",
            "valor_csll" => "1.00",
            "valor_outras" => "1.00",
            "valor_aliquota" => "1.00",
            "valor_desconto_incondicionado" => "1.00"
        ],
        "intermediario" => [
            "cnpj" => "12345678901234",
            "cpf" => null,
            "im" => null,
            "razao_social" => "Fake Tecnologia Ltda"
        ],
        "obra" => [
            "codigo" => "2222",
            "art" => "1111"
        ]
    ];
    //os payloads são sempre ARRAYS
    $resp = $nfse->cria($payload);

    echo "<pre>";
    print_r($resp); //imprime o objeto $resp em tela
    echo "</pre>";

} catch (\Exception $e) {
    echo $e->getMessage();
}
```

## Busca NFSe

Este método busca pelos documentos NFSe armazenados em nossa base de dados.

É muito importante que estude a [nossa documentação](https://doc.cloud-dfe.com.br/v1/nfse/#!/1-6) para poder enviar essa chamada.

```php
use CloudDfe\SdkPHP\Nfse;

try {
    $params = [
        'token' => 'eyJ0eXAiOiJKV1QiLCJh...',
        'ambiente' => Nfse::AMBIENTE_HOMOLOGACAO,
        'options' => ['debug' => true],
    ];
    $nfse = new Nfse($params);
    $payload = [
        "numero_rps_inicial" => 1210, //opcional
        "numero_rps_final" => 1210, //opcional
        "serie_rps" => 1, //opcional
        "numero_nfse_inicial" => 1210, //opcional
        "numero_nfse_final" => 1210, //opcional
        "data_inicial" => "2019-12-01", //opcional dada Autorização
        "data_final" => "2019-12-31", //opcional dada Autorização
        "cancel_inicial" => "2019-12-01", //opcional data Cancelamento
        "cancel_final" => "2019-12-31" //opcional data Cancelamento
    ];
    //os payloads são sempre ARRAYS
    $resp = $nfse->busca($payload);

    echo "<pre>";
    print_r($resp); //imprime o objeto $resp em tela
    echo "</pre>";

} catch (\Exception $e) {
    echo $e->getMessage();
}
```

## Consulta NFSe

Este método consulta uma NFSe em nossa base de dados pela sua chave.

*NOTA: Este método é normalmente usado em operações ASSINCRONAS, enviado após o RPS ter sido enviada para api para gerar uma NFSe.*

*NOTA: em caso de erro no documento, o registro deste documento é deletado da API, e após as devidas correções dos erros encontrados pode ser feita outra solicitação para a caiação de nova NFSe.*

É muito importante que estude a [nossa documentação](https://doc.cloud-dfe.com.br/v1/nfse/#!/1-1) para poder enviar essa chamada.

```php
use CloudDfe\SdkPHP\Nfse;

try {
    $params = [
        'token' => 'eyJ0eXAiOiJKV1QiLCJh...',
        'ambiente' => Nfse::AMBIENTE_HOMOLOGACAO,
        'options' => ['debug' => true],
    ];
    $nfse = new Nfse($params);

    $payload = [
        'chave' => '41210222545265000108550010001010021121093113'
    ];
    //os payloads são sempre ARRAYS
    $resp = $nfse->consulta($payload);

    echo "<pre>";
    print_r($resp);
    echo "</pre>";

} catch (\Exception $e) {
    echo $e->getMessage();
}
```

## Localiza na prefeitura

Este método busca por registros nas Prefeituras de acordo com alguns parametros de busca.

*NOTA: Existem prefeituras que não possuem este método, e outras restrigem os dados de busca.*

É muito importante que estude a [nossa documentação](https://doc.cloud-dfe.com.br/v1/nfse/#!/1-8) para poder enviar essa chamada.

```php
use CloudDfe\SdkPHP\Nfse;

try {
    $params = [
        'token' => 'eyJ0eXAiOiJKV1QiLCJh...',
        'ambiente' => Nfse::AMBIENTE_HOMOLOGACAO,
        'options' => ['debug' => true],
    ];
    $nfse = new Nfse($params);

    $payload = [
        "data_emissao_inicial" => "2020-01-01", //opcional
        "data_emissao_final" => "2020-01-31", //opcional
        "data_competencia_inicial" => "2020-01-01", //opcional
        "data_competencia_final" => "2020-01-31", //opcional
        "tomador_cnpj" => null, //opcional
        "tomador_cpf" => null, //opcional
        "tomador_im" => null, //opcional
        "nfse_numero" => null, //opcional
        "nfse_numero_inicial" => null, //opcional
        "nfse_numero_final" => null, //opcional
        "rps_numero" => null, //opcional
        "rps_serie" => null, //opcional
        "rps_tipo" => null, //opcional
        "pagina" => "1" //opcional
    ];
    //os payloads são sempre ARRAYS
    $resp = $nfse->localiza($payload);

    echo "<pre>";
    print_r($resp); //imprime o objeto $resp em tela
    echo "</pre>";

} catch (\Exception $e) {
    echo $e->getMessage();
}

```

## Cancela NFSe

Este método solicita o cancelamento da NFSe na prefeitura.

*NOTA: Existem prefeituras que não possuem este método.*

É muito importante que estude a [nossa documentação](https://doc.cloud-dfe.com.br/v1/nfse/#!/1-7) para poder enviar essa chamada.

```php
use CloudDfe\SdkPHP\Nfse;

try {
    $params = [
        'token' => 'eyJ0eXAiOiJKV1QiLCJh...',
        'ambiente' => Nfse::AMBIENTE_HOMOLOGACAO,
        'options' => ['debug' => true],
    ];
    $nfse = new Nfse($params);

    $payload = [
        'chave' => '41210222545265000108550010001010021121093113',
        'justificativa' => 'teste de cancelamento' //minimo de 15 caracteres
    ];
    //os payloads são sempre ARRAYS
    $resp = $nfse->cancela($payload);

    echo "<pre>";
    print_r($resp); //imprime o objeto $resp em tela
    echo "</pre>";

} catch (\Exception $e) {
    echo $e->getMessage();
}
```

## Gerar DANFSE (pdf)

Com este método será retornado o PDF da DANFSE de um documento que exista na nossa base de dados.

*NOTA: este é um EXTRA fornecido pela CloudDFe, o formado do DANFSE não será ajustados a necessidades especificas de nenhum cliente.*

É muito importante que estude a [nossa documentação](https://doc.cloud-dfe.com.br/v1/nfse/#!/1-2) para poder enviar essa chamada.

```php
use CloudDfe\SdkPHP\Nfse;

try {
    $params = [
        'token' => 'eyJ0eXAiOiJKV1QiLCJh...',
        'ambiente' => Nfse::AMBIENTE_HOMOLOGACAO,
        'options' => ['debug' => true],
    ];
    $nfse = new Nfse($params);

    $payload = [
        'chave' => '41210222545265000108550010001010031384099675'
    ];
     //os payloads são sempre ARRAYS
    $resp = $nfse->pdf($payload);

    echo "<pre>";
    print_r($resp); //imprime o objeto $resp em tela
    echo "</pre>";

} catch (\Exception $e) {
    echo $e->getMessage();
}
```


## Backup

Este método solicita o backup dos documentos relacionados com as NFSe, gerados e registrados pela API.

*NOTA: A finalidade desses backups é fornecer mais uma camada de segurança para a softhouse mantendo uma copia dos documentos fiscais eletrônicos.*

*NOTA: este é um EXTRA fornecido pela CloudDFe, o formado do backup bem como a data de sua criação não serão ajustados a necessidades especificas de nenhum cliente.*

*NOTA: os backups são processados de forma automática no primeiro domingo de cada mês, portanto somente estão disponíveis após estada data.*

É muito importante que estude a [nossa documentação](https://doc.cloud-dfe.com.br/v1/nfse/#!/1-5) para poder enviar essa chamada.

```php
use CloudDfe\SdkPHP\Nfse;

try {
    $params = [
        'token' => 'eyJ0eXAiOiJKV1QiLCJh...',
        'ambiente' => Nfse::AMBIENTE_HOMOLOGACAO,
        'options' => ['debug' => true],
    ];
    $nfse = new Nfse($params);

    //os payloads são sempre ARRAYS
    $payload = [
        'ano' => '2021',
        'mes' => '2'
    ];
    $resp = $nfse->backup($payload);

    echo "<pre>";
    print_r($resp); //imprime o objeto $resp em tela
    echo "</pre>";

} catch (\Exception $e) {
    echo $e->getMessage();
}
```
