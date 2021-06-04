# Operações da SOFTHOUSE

*NOTA: estas operações funcionam em ambos os ambientes (homologação e produção)*

*NOTA: Esta operação somente pode ser executada com o token da SOFTHOUSE.*

**LEMBRE-SE: as consultas usando o SDK sempre retornam um objeto stdClass;**

## Registrar um novo Emitente

A softhouse pode registrar seu emitente através do método abaixo.



## Consultar os dados do Emitente

Os dados cadastrais de um emitente pode ser retornados a softhouse pr este método.



## Altera dados cadastrais do Emitente

No caso de uma atualização de dados cadastrais do emitente, prefira usar o método do próprio emitente.

*NOTA: Nem o CNPJ, nem o CPF poderão ser alterados por esse método.*



## Listar os emitentes já cadastrados (ativos ou deletados)

Use este método para obter uma listagem de todos os emitentes cadastrados da sua empresa.




## Deletar o emitente

Caso a softhouse deixe de trabalhar com algum emitente, será necessário enviar a solicitação de DELEÇÃO do mesmo.

Esse processo é um SOFTDELETE, e portanto os dados não serão removidos imediatamente, porém será interrompida a cobrança reletiva a esse emitente, se existir alguma.

**Além disso, após 30 dias, TODOS os dados relativos a esse emitente serão removidos de forma definitiva e irreversivel da API.**


