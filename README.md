# Desafio PHP

O objetivo deste desafio é testar e aprimorar as habilidades do programador PHP. O desafio se dará através de um projeto de cadastro de funcionários que fará um controle básico das informações funcionais e de pagamentos dos funcionários da prefeitura.

## O Problema

Na prefeitura não há nenhum controle informatizado dos dados dos funcionários.
As informações são mantidas em fichas armazenadas em um grande arquivo físico.
Qualquer tomada de decisão é extremamente lenta e custosa, visto que, para extrair qualquer informação (gerar relatórios) sobre os funcionários, há um grande tabalho manual e muitos papeis físicos precisam ser analisados. Um outro problema é a falta de segurança no armazenamento e controle, as fichas sofrem muito com a ação do tempo e com os descuidos no manuseio.

## A Solução
É necessário o desenvolvimento de um sistema WEB para cadastro e controle das informações dos funcionários. 
Para isso alguns requisitos devem ser seguidos:

### Funcionários
- Cada funcionário só pode ter um cadastro ativo por vez.
- O funcionário pode ser do tipo **Estatutário** ou **Comissionado**.
- Quando um funcionário é cadastrado ele recebe o status **Ativo** quando exonerado ele recebe o status **Exonerado**.
- Uma imagem de cada documento deve ser guardada junto do cadastro.

### Salários
- Todo funcionário possui um **Salário Base**.
- Somente Estatutários possuem **Gratificação**.
- Todo funcionários pode receber **Desconto** no salário.
- O **Salário Líquido** é a soma do Salário Base mais Gratificação menos Descontos:
    > L = (SB + G) - D

### Secretarias
- Todo funcionário pertence a uma secretaria.
- Uma secretaria pode ter muitos funcionários.

### Usuários
- Usuários podem ser do tipo **Administrador**, **Gerente** ou **Operador**.
- **Operadores** podem cadastrar e editar funcionários.
- **Gerentes** podem todas as funções dos Operadores. Também podem cadastrar e editar **Secretarias** e visualizar relatórios.
- **Administradores** podem tudo que os **Gerentes** podem e também manter (Criar, Editar e Excluir) outros usuários.

### Relatórios (xls/pdf)
- Funcionários por período de admissão/exoneração.
- Total do Salário Líquido agrupado por secretaria.

### Requisitos Técnicos
- PHP >=7.1
- Use Orientação a Objeto
- Composer
- Autoload seguindo PSR-4
- Estílo de código seguindo PSR-1 e PSR-2
- Backup para Dropbox
- Escrever testes

### Bibliotecas Recomendadas (Pode usar outra)
| Biblioteca | Função |
| ------ | ------ |
| [PHP Backup Utility](https://github.com/sebastianfeldmann/phpbu) | Backup |
| [MPDF](https://mpdf.github.io/) | Gerar PDF |
| [PHPExcel](https://github.com/PHPOffice/PHPExcel) | Gerar Excel |
| [Code Style](https://github.com/squizlabs/PHP_CodeSniffer) | Estilo de código |
| [PHP Unit](https://phpunit.de/) | Teste |
