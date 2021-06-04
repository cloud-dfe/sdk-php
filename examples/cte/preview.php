<?php

require_once(__DIR__ . '/../../bootstrap.php');

use CloudDfe\SdkC\Cte;

try {
    $params = [
        'token' => 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbXAiOjcwLCJ1c3IiOiIyIiwidHAiOjIsImlhdCI6MTU4MDkzNzM3MH0.KvSUt2x8qcu4Rtp2XNTOINqR',
        'ambiente' => Cte::AMBIENTE_HOMOLOGACAO,
        'options' => [
            'debug' => false,
        ]
    ];

    $cte = new Cte($params);

    $paylod = [
        "cfop" => "5353",
        "natureza_operacao" => "PRESTACAO DE SERVIÇO",
        "numero" => "64",
        "serie" => "1",
        "data_emissao" => "2020-11-24T03:00:00-03:00",
        "tipo_operacao" => "0",
        "codigo_municipio_envio" => "2408003",
        "nome_municipio_envio" => "MOSSORO",
        "uf_envio" => "RN",
        "tipo_servico" => "0",
        "codigo_municipio_inicio" => "2408003",
        "nome_municipio_inicio" => "Mossoró",
        "uf_inicio" => "RN",
        "codigo_municipio_fim" => "2408003",
        "nome_municipio_fim" => "Mossoró",
        "uf_fim" => "RN",
        "retirar_mercadoria" => "1",
        "detalhes_retirar" => null,
        "tipo_programacao_entrega" => "0",
        "sem_hora_tipo_hora_programada" => "0",
        "remetente" => [
            "cnpj" => "15493526000128",
            "inscricao_estadual" => "239084510",
            "nome" => "EMPRESA MODELO",
            "razao_social" => "MODELO LTDA",
            "telefone" => "8433163070",
            "endereco" => [
                "logradouro" => "AVENIDA TESTE",
                "numero" => "444",
                "bairro" => "CENTRO",
                "codigo_municipio" => "2408003",
                "nome_municipio" => "MOSSORÓ",
                "uf" => "RN"
            ]
        ],
        "valores" => [
            "valor_total" => "0.00",
            "valor_receber" => "0.00",
            "valor_total_carga" => "224.50",
            "produto_predominante" => "SAL",
            "quantidades" => [
                [
                    "codigo_unidade_medida" => "01",
                    "tipo_medida" => "Peso Bruto",
                    "quantidade" => "500.00"
                ]
            ]
        ],
        "imposto" => [
            "icms" => [
                "situacao_tributaria" => "20",
                "valor_base_calculo" => "0.00",
                "aliquota" => "12.00",
                "valor" => "0.00",
                "reducao_base_calculo" => "50.00"
            ]
        ],
        "nfes" => [
            [
                "chave" => "24201001243220000109550010000010611650858974"
            ]
        ],
        "modal_rodoviario" => [
            "rntrc" => "02033517"
        ],
        "destinatario" => [
            "cnpj" => "15495526000128",
            "inscricao_estadual" => "212055510",
            "nome" => "EMPRESA MODELO",
            "telefone" => "8499995555",
            "endereco" => [
                "logradouro" => "AVENIDA TESTE",
                "numero" => "444",
                "bairro" => "CENTRO",
                "codigo_municipio" => "2408003",
                "nome_municipio" => "Mossoró",
                "cep" => "59603330",
                "uf" => "RN",
                "codigo_pais" => "1058",
                "nome_pais" => "BRASIL",
                "email" => "teste@teste.com.br"
            ]
        ],
        "componentes_valor" => [
            [
                "nome" => "teste2",
                "valor" => "1999.00"
            ]
        ],
        "tomador" => [
            "tipo" => "3",
            "indicador_inscricao_estadual" => "1"
        ],
        "observacao" => ""
    ];

    //os payloads são sempre ARRAYS
    $resp = $cte->preview($paylod);

    echo "<pre>";
    print_r($resp);
    echo "</pre>";

} catch (\Exception $e) {
    echo $e->getMessage();
}
