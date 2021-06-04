# Operações com MDFe

*NOTA: estas operações funcionam em ambos os ambientes (homologação e produção)*

*NOTA: Esta operação somente pode ser executada com o token do emitente.*

**LEMBRE-SE: as consultas usando o SDK sempre retornam um objeto stdClass;**


## Consulta Status da Sefaz autorizadora

Consulta o status da SEFAZ autorizadora

É muito importante que estude a [nossa documentação](https://doc.cloud-dfe.com.br/v1/mdfe/#!/1-1) para poder enviar essa chamada.

[VIDE EXEMPLO](https://github.com/cloud-dfe/clouddfe-sdk-php-curl/blob/master/examples/mdfe/status.php)



## Cria MDFe

Este método é usado paa GERAR uma nova MDFe

É muito importante que estude a [nossa documentação](https://doc.cloud-dfe.com.br/v1/mdfe/#!/1-6) para poder enviar essa chamada.

[VIDE EXEMPLO](https://github.com/cloud-dfe/clouddfe-sdk-php-curl/blob/master/examples/mdfe/cria.php)


## Preview MDFe

Este método pré-valida os dados de uma MDFe e gera o pdf (DAMDFE) caso os dados sejam validados, sem criar efetivamente o documento.

NOTA: Este método não deve ser usado indiscriminadamente antes da geração do real do NFCe, mas serve como auxilio em caso de duvidas sobre o correto preenchimento de algum campo.

NOTA: Este método não garante que seu documento esteja correto e será autorizado pela SEFAZ, apenas indica se exitem ou não erros de estrutura nos dados fornecidos.

É muito importante que estude a [nossa documentação](https://doc.cloud-dfe.com.br/v1/mdfe/#!/1-13) para poder enviar essa chamada.

[VIDE EXEMPLO](https://github.com/cloud-dfe/clouddfe-sdk-php-curl/blob/master/examples/mdfe/preview.php)


## Busca MDFe

Busca pelos documentos armazenados em nossa base de dados

É muito importante que estude a [nossa documentação](https://doc.cloud-dfe.com.br/v1/mdfe/#!/1-7) para poder enviar essa chamada.

[VIDE EXEMPLO](https://github.com/cloud-dfe/clouddfe-sdk-php-curl/blob/master/examples/mdfe/busca.php)


## Consulta MDFe

Consulta uma MDFe em nossa base de dados. Este método é normalmente usado logo após a MDFe ter sido enviada para api.

É muito importante que estude a [nossa documentação](https://doc.cloud-dfe.com.br/v1/mdfe/#!/1-4) para poder enviar essa chamada.

[VIDE EXEMPLO](https://github.com/cloud-dfe/clouddfe-sdk-php-curl/blob/master/examples/mdfe/consulta.php)

## Encerra

Realiza o evento de encerramento da MDFe, deve ser utilizado os dados da localização de termino da viagem

É muito importante que estude a [nossa documentação](https://doc.cloud-dfe.com.br/v1/mdfe/#!/1-9) para poder enviar essa chamada.

[VIDE EXEMPLO](https://github.com/cloud-dfe/clouddfe-sdk-php-curl/blob/master/examples/mdfe/encerra.php)

## Cancela MDFe

Este método solicita o cancelamento da MDFe à Sefaz autorizadora.

*NOTA: para poder cancelar uma MDFe utilizando a API é necessário que o documento exista em nossa base de dados.*

**NOTA: Atenção para os prazos limite para realizar o cancelamento de MDFe, de forma geral esse limite é de 24 horas a partir da data de emissão do documento. Após esse limite as MDFe não poderão mais serem canceladas e para reverter a operação será necessário fazer uma MDFe de entrada das mercadorias.**

É muito importante que estude a [nossa documentação](https://doc.cloud-dfe.com.br/v1/mdfe/#!/1-10) para poder enviar essa chamada.

[VIDE EXEMPLO](https://github.com/cloud-dfe/clouddfe-sdk-php-curl/blob/master/examples/mdfe/cancela.php)

## Inclui um condutor

É utilizado para incluir conutores ao longo do percurso

É muito importante que estude a [nossa documentação](https://doc.cloud-dfe.com.br/v1/mdfe/#!/1-8) para poder enviar essa chamada.

[VIDE EXEMPLO](https://github.com/cloud-dfe/clouddfe-sdk-php-curl/blob/master/examples/mdfe/condutor.php)

## Gerar DAMDFE (pdf)

Com este método será retornado o PDF da DAMDFE de um documento que exista na nossa base de dados.

*NOTA: este é um EXTRA fornecido pela CloudDFe e os pdf não serão modificados para atender a necessidades particulares de clientes.*

É muito importante que estude a [nossa documentação](https://doc.cloud-dfe.com.br/v1/mdfe/#!/1-5) para poder enviar essa chamada.

[VIDE EXEMPLO](https://github.com/cloud-dfe/clouddfe-sdk-php-curl/blob/master/examples/mdfe/pdf.php)

## Backup

Solicita o backup dos documentos relacionados com as MDFe (MDFe e eventos), gerados e registrados pela API

*NOTA: os backups tem a finalidade de garantir mais uma camada de segurança na guarda dos documentos para a softhouse.*

*NOTA: os backups são gerados no primeiro domingo de cada mês, e não estarão disponíveis até serem gerados.*

É muito importante que estude a [nossa documentação](https://doc.cloud-dfe.com.br/v1/mdfe/#!/1-11) para poder enviar essa chamada.

[VIDE EXEMPLO](https://github.com/cloud-dfe/clouddfe-sdk-php-curl/blob/master/examples/mdfe/backup.php)

## Offline

Será executado o processamento das MDFe que foram criadas em contingência offline.

*NOTA: Existe um prazo limite para que as MDFe emitidas OFFLINE sejam enviadas devidamente para a SEFAZ, protanto é recomendado que esse processo seja realizado pelo menos uma vez ao dia.*

É muito importante que estude a [nossa documentação](https://doc.cloud-dfe.com.br/v1/mdfe/#!/1-3) para poder enviar essa chamada.

[VIDE EXEMPLO](https://github.com/cloud-dfe/clouddfe-sdk-php-curl/blob/master/examples/mdfe/offline.php)

## Abertos(Não encerrados)

Busca os MDFe que ainda não foram encerrados.

**IMPORTANTE: MDFe não devem permanecer ABERTOS, devem ser encerrados assim que a entrga for realizada.**

É muito importante que estude a [nossa documentação](https://doc.cloud-dfe.com.br/v1/mdfe/#!/1-2) para poder enviar essa chamada.

[VIDE EXEMPLO](https://github.com/cloud-dfe/clouddfe-sdk-php-curl/blob/master/examples/mdfe/abertos.php)


## Incluir NFe

Inclui a chave de uma NFe quando o MDFe foi emitido com o campo carregamento_posterior = 1

*NOTA: Para ser possivel realizar esse evento o MDFe além do campo carregamento_posterior = 1 deve ser feito em operação interna, e não deve ser informado nenhuma chave de acesso nos municipios de descarregamento.*

É muito importante que estude a [nossa documentação](https://doc.cloud-dfe.com.br/v1/mdfe/#!/1-12) para poder enviar essa chamada.

[VIDE EXEMPLO](https://github.com/cloud-dfe/clouddfe-sdk-php-curl/blob/master/examples/mdfe/incluir_nfe.php)
