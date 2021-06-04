# Operações com DFe

*NOTA: estas operações funcionam APENAS em produção.*

*NOTA: Esta operação somente pode ser executada com o token do emitente, desde de que tenha contratado o serviço de coleta de documentos destinados (DFe).*

**LEMBRE-SE: as consultas usando o SDK sempre retornam um objeto stdClass;**


## Busca as NFe destinadas

Este metodo traz as NFe destinadas que já foram localizadas e já baixadas pelo processo automático do DFe.

NOTA: Esta busca não irá trazer as NFe que ainda não foram localizadas no webservice da Receita Federal. Lembrando que esse processo roda automáticamente nos nossos servidores a cada 2 horas e que a Receita Federal recebe as NFe em batch das SEFAZ autorizadoras e portanto existe um lapso de tempo entre a emissão e o recebimento do documento.

É muito importante que estude a [nossa documentação](https://doc.cloud-dfe.com.br/v1/dfe/#!/1-1) para poder enviar essa chamada.

[VIDE EXEMPLO](https://github.com/cloud-dfe/clouddfe-sdk-php-curl/blob/master/examples/dfe/buscaNfe.php)



## Busca as CTe destinadas

Este metodo traz as CTe destinadas que já foram localizadas e já baixadas pelo processo automático do DFe.

NOTA: Esta busca não irá trazer as CTe que ainda não foram localizadas no webservice da Receita Federal. Lembrando que esse processo roda automáticamente nos nossos servidores a cada 2 horas e que a Receita Federal recebe as CTe em batch das SEFAZ autorizadoras e portanto existe um lapso de tempo entre a emissão e o recebimento do documento.

É muito importante que estude a [nossa documentação](https://doc.cloud-dfe.com.br/v1/dfe/#!/1-2) para poder enviar essa chamada.

[VIDE EXEMPLO](https://github.com/cloud-dfe/clouddfe-sdk-php-curl/blob/master/examples/dfe/buscaCTe.php)


## Download de NFe destinada

Este método baixa a NFe destinada que já foi localizada e está disponível em nossa base de dados.

É muito importante que estude a [nossa documentação](https://doc.cloud-dfe.com.br/v1/dfe/#!/1-5) para poder enviar essa chamada.

[VIDE EXEMPLO](https://github.com/cloud-dfe/clouddfe-sdk-php-curl/blob/master/examples/dfe/downloadNfe.php)


## Download de CTe destinada

Este método baixa o CTe destinado que já foi localizado e está disponível em nossa base de dados.

É muito importante que estude a [nossa documentação](https://doc.cloud-dfe.com.br/v1/dfe/#!/1-4) para poder enviar essa chamada.

[VIDE EXEMPLO](https://github.com/cloud-dfe/clouddfe-sdk-php-curl/blob/master/examples/dfe/downloadCte.php)


## Busca o BACKUP dos documentos Destinados

No primeiro domingo de cada mês, o sistema DFe irá criar um backup em ZIP de todos os documentos recebidos naquele período, e você pode receber o link de download desse arquivo para manter os documentos de forma segura e repassa-los ao contador.

*NOTA: Esse metodo não irá criar o backup mas apenas liberar o seu download por alguns dias, para que você possa baixa-lo. Portanto se o backup não estiver disponível ainda aguarde até o dia seguinte ao primeiro domingo do mês subsequente ao mês desejado.*

É muito importante que estude a [nossa documentação](https://doc.cloud-dfe.com.br/v1/dfe/#!/1-3) para poder enviar essa chamada.

[VIDE EXEMPLO](https://github.com/cloud-dfe/clouddfe-sdk-php-curl/blob/master/examples/dfe/backup.php)

