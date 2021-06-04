# Operações com NFCe

*NOTA: estas operações funcionam em ambos os ambientes (homologação e produção)*

*NOTA: Esta operação somente pode ser executada com o token do emitente.*

**LEMBRE-SE: as consultas usando o SDK sempre retornam um objeto stdClass;**


## Consulta Status da Sefaz autorizadora

Consulta o status da SEFAZ autorizadora

É muito importante que estude a [nossa documentação](https://doc.cloud-dfe.com.br/v1/nfce/#!/1-3) para poder enviar essa chamada.

[VIDE EXEMPLO](https://github.com/cloud-dfe/clouddfe-sdk-php-curl/blob/master/examples/nfce/status.php)


## Cria NFCe

Este método é usado para GERAR uma nova NFCe

É muito importante que estude a [nossa documentação](https://doc.cloud-dfe.com.br/v1/nfce/#!/1-4) para poder enviar essa chamada.

[VIDE EXEMPLO](https://github.com/cloud-dfe/clouddfe-sdk-php-curl/blob/master/examples/nfce/cria.php)


## Preview NFCe

Este método pré-valida os dados de uma NFCe e gera o pdf (DANFCE) caso os dados sejam validados, sem criar efetivamente o documento.

NOTA: Este método não deve ser usado indiscriminadamente antes da geração do real do NFCe, mas serve como auxilio em caso de duvidas sobre o correto preenchimento de algum campo.

NOTA: Este método não garante que seu documento esteja correto e será autorizado pela SEFAZ, apenas indica se exitem ou não erros de estrutura nos dados fornecidos.

É muito importante que estude a [nossa documentação](https://doc.cloud-dfe.com.br/v1/nfce/#!/1-12) para poder enviar essa chamada.

[VIDE EXEMPLO](https://github.com/cloud-dfe/clouddfe-sdk-php-curl/blob/master/examples/nfce/preview.php)

## Busca NFCe

Busca pelos documentos armazenados em nossa base de dados

É muito importante que estude a [nossa documentação](https://doc.cloud-dfe.com.br/v1/nfce/#!/1-6) para poder enviar essa chamada.

[VIDE EXEMPLO](https://github.com/cloud-dfe/clouddfe-sdk-php-curl/blob/master/examples/nfce/busca.php)


## Consulta NFCe

Consulta uma NFCe em nossa base de dados. Este método é normalmente usado logo após a NFCe ter sido enviada para api.

É muito importante que estude a [nossa documentação](https://doc.cloud-dfe.com.br/v1/nfce/#!/1-1) para poder enviar essa chamada.

[VIDE EXEMPLO](https://github.com/cloud-dfe/clouddfe-sdk-php-curl/blob/master/examples/nfce/consulta.php)



## Cancela NFCe

Este método solicita o cancelamento da NFCe à Sefaz autorizadora.

*NOTA: para poder cancelar uma NFCe utilizando a API é necessário que o documento exista em nossa base de dados.*

**NOTA: Atenção para os prazos limite para realizar o cancelamento de NFCe, de forma geral esse limite é de 24 horas a partir da data de emissão do documento. Após esse limite as NFCe não poderão mais serem canceladas e para reverter a operação será necessário fazer uma NFCe de entrada das mercadorias.**

É muito importante que estude a [nossa documentação](https://doc.cloud-dfe.com.br/v1/nfce/#!/1-7) para poder enviar essa chamada.

[VIDE EXEMPLO](https://github.com/cloud-dfe/clouddfe-sdk-php-curl/blob/master/examples/nfce/cancela.php)



## Offline

Será executado o processamento das NFCe que foram criadas em contingencia offline.

*NOTA: Existe um prazo limite para que as NFCe emitidas OFFLINE sejam enviadas devidamente para a SEFAZ, protanto é recomendado que esse processo seja realizado pelo menos uma vez ao dia.*

É muito importante que estude a [nossa documentação](https://doc.cloud-dfe.com.br/v1/nfce/#!/1-10) para poder enviar essa chamada.

[VIDE EXEMPLO](https://github.com/cloud-dfe/clouddfe-sdk-php-curl/blob/master/examples/nfce/offline.php)



## Inutiliza Faixa de Numeros de NFCe

Sempre que por algum motivo tenham sido pulados numeros de NFCe, esses numeros deve ser inulizados.

*NOTA: mesmo que deseje encerrar apenas um unico numero de NFCe, nessa chamada deve ser passado o numero inicial e final IGUAIS.*

É muito importante que estude a [nossa documentação](https://doc.cloud-dfe.com.br/v1/nfce/#!/1-9) para poder enviar essa chamada.

[VIDE EXEMPLO](https://github.com/cloud-dfe/clouddfe-sdk-php-curl/blob/master/examples/nfce/inutiliza.php)


## Gerar DANFCE (pdf)

Com este método será retornado o PDF da DANFCE de um documento que exista na nossa base de dados.

*NOTA: este é um EXTRA fornecido pela CloudDFe e os pdf não serão modificados para atender a necessidades particulares de clientes.*

É muito importante que estude a [nossa documentação](https://doc.cloud-dfe.com.br/v1/nfce/#!/1-2) para poder enviar essa chamada.

[VIDE EXEMPLO](https://github.com/cloud-dfe/clouddfe-sdk-php-curl/blob/master/examples/nfce/pdf.php)


## Substitui uma NFCe por outra

Este método solicita a substituição de uma NFCe na Sefaz autorizadora por outra.

É muito importante que estude a [nossa documentação](https://doc.cloud-dfe.com.br/v1/nfce/#!/1-11) para poder enviar essa chamada.

[VIDE EXEMPLO](https://github.com/cloud-dfe/clouddfe-sdk-php-curl/blob/master/examples/nfce/subistitui.php)


## Backup

Solicita o backup dos documentos relacionados com as NFCe (NFCe e eventos), gerados e registrados pela API

*NOTA: os backups tem a finalidade de garantir mais uma camada de segurança na guarda dos documentos para a softhouse.*

*NOTA: os backups são gerados no primeiro domingo de cada mês, e não estarão disponíveis até serem gerados.*

É muito importante que estude a [nossa documentação](https://doc.cloud-dfe.com.br/v1/nfce/#!/1-5) para poder enviar essa chamada.

[VIDE EXEMPLO](https://github.com/cloud-dfe/clouddfe-sdk-php-curl/blob/master/examples/nfce/backup.php)
