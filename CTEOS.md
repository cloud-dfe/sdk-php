# Operações com CTeOS

*NOTA: estas operações funcionam em ambos os ambientes (homologação e produção)*

*NOTA: Esta operação somente pode ser executada com o token do emitente.*

**LEMBRE-SE: as consultas usando o SDK sempre retornam um objeto stdClass;**

## Consulta Status da Sefaz autorizadora

Consulta o status da SEFAZ autorizadora

É muito importante que estude a [nossa documentação](https://doc.cloud-dfe.com.br/v1/cteos/#!/1-1) para poder enviar essa chamada.

[VIDE EXEMPLO](https://github.com/cloud-dfe/clouddfe-sdk-php-curl/blob/master/examples/cteos/status.php)

## Cria CTeOS

Este método é usado para GERAR uma nova CTe

É muito importante que estude a [nossa documentação](https://doc.cloud-dfe.com.br/v1/cteos/#!/1-4) para poder enviar essa chamada.

[VIDE EXEMPLO](https://github.com/cloud-dfe/clouddfe-sdk-php-curl/blob/master/examples/cteos/cria.php)

## Preview CTeOS

Este método pré-valida os dados de uma CTe e gera o pdf (DACTE) caso os dados sejam validados, sem criar efetivamente o documento.

*NOTA: Este método não deve ser usado indiscriminadamente antes da geração do real do CTeOS, mas serve como auxilio em caso de duvidas sobre o correto preenchimento de algum campo.*

*NOTA: Este método não garante que seu documento esteja correto e será autorizado pela SEFAZ, apenas indica se exitem ou não erros de estrutura nos dados fornecidos.*

É muito importante que estude a [nossa documentação](https://doc.cloud-dfe.com.br/v1/cteos/#!/1-4) para poder enviar essa chamada.

[VIDE EXEMPLO](https://github.com/cloud-dfe/clouddfe-sdk-php-curl/blob/master/examples/cteos/preview.php)

## Busca CTe

Busca pelos documentos armazenados em nossa base de dados

É muito importante que estude a [nossa documentação](https://doc.cloud-dfe.com.br/v1/cteos/#!/1-5) para poder enviar essa chamada.

[VIDE EXEMPLO](https://github.com/cloud-dfe/clouddfe-sdk-php-curl/blob/master/examples/cteos/busca.php)

## Consulta CTe

Consulta uma CTe em nossa base de dados. Este método é normalmente usado logo após a CTe ter sido enviada para api.

É muito importante que estude a [nossa documentação](https://doc.cloud-dfe.com.br/v1/cteos/#!/1-2) para poder enviar essa chamada.

[VIDE EXEMPLO](https://github.com/cloud-dfe/clouddfe-sdk-php-curl/blob/master/examples/cteos/consulta.php)


## Carta da Correção

A carta de correção é usada para corrigir algum equivoco simples que tenha ocorrido na emissão da CTe, e que não tem impacto nos dados fiscais da mesma.

É muito importante que estude a [nossa documentação](https://doc.cloud-dfe.com.br/v1/cteos/#!/1-7) para poder enviar essa chamada.

[VIDE EXEMPLO](https://github.com/cloud-dfe/clouddfe-sdk-php-curl/blob/master/examples/cteos/correcao.php)

## Cancela CTe

Este método solicita o cancelamento da CTe à Sefaz autorizadora.

*NOTA: para poder cancelar uma CTe utilizando a API é necessário que o documento exista em nossa base de dados.*

**NOTA: Atenção para os prazos limite para realizar o cancelamento de CTe, de forma geral esse limite é de 24 horas a partir da data de emissão do documento. Após esse limite as CTe não poderão mais serem canceladas e para reverter a operação será necessário fazer uma CTe de entrada das mercadorias.**

É muito importante que estude a [nossa documentação](https://doc.cloud-dfe.com.br/v1/cteos/#!/1-6) para poder enviar essa chamada.

[VIDE EXEMPLO](https://github.com/cloud-dfe/clouddfe-sdk-php-curl/blob/master/examples/cteos/cancela.php)


## Inutiliza Faixa de Numeros de CTe

Sempre que por algum motivo tenham sido pulados numeros de CTe, esses numeros deve ser inulizados.

*NOTA: mesmo que deseje encerrar apenas um unico numero de CTe, nessa chamada deve ser passado o numero inicial e final IGUAIS.*

É muito importante que estude a [nossa documentação](https://doc.cloud-dfe.com.br/v1/cteos/#!/1-8) para poder enviar essa chamada.

[VIDE EXEMPLO](https://github.com/cloud-dfe/clouddfe-sdk-php-curl/blob/master/examples/cteos/inutiliza.php)

## Gerar DACTE (pdf)

Com este método será retornado o PDF da DACTE de um documento que exista na nossa base de dados.

*NOTA: este é um EXTRA fornecido pela CloudDFe e os pdf não serão modificados para atender a necessidades particulares de clientes.*

É muito importante que estude a [nossa documentação](https://doc.cloud-dfe.com.br/v1/cteos/#!/1-3) para poder enviar essa chamada.

[VIDE EXEMPLO](https://github.com/cloud-dfe/clouddfe-sdk-php-curl/blob/master/examples/cteos/pdf.php)


## Backup

Solicita o backup dos documentos relacionados com as CTe (CTe e eventos), gerados e registrados pela API

*NOTA: os backups tem a finalidade de garantir mais uma camada de segurança na guarda dos documentos para a softhouse.*

*NOTA: os backups são gerados no primeiro domingo de cada mês, e não estarão disponíveis até serem gerados.*

É muito importante que estude a [nossa documentação](https://doc.cloud-dfe.com.br/v1/cteos/#!/1-10) para poder enviar essa chamada.

[VIDE EXEMPLO](https://github.com/cloud-dfe/clouddfe-sdk-php-curl/blob/master/examples/cteos/backup.php)

