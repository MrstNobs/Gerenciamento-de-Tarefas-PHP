# Gerenciamento de Tarefas — PHP

Projeto de gerenciamento de tarefas desenvolvido com foco no aprendizado de PHP e no funcionamento geral de uma aplicação web.

A proposta é entender como diferentes tecnologias trabalham em conjunto, desde as requisições HTTP até a comunicação com o banco de dados, incluindo a configuração do ambiente e o uso de variáveis de ambiente.

## Tecnologias utilizadas

- **PHP:** processamento das requisições e lógica da aplicação.
- **HTML, CSS e JavaScript:** interface e interatividade.
- **MariaDB e MySQLi:** armazenamento e acesso aos dados.
- **Docker, Docker Compose e Dockerfile:** configuração e execução do ambiente.
- **Composer:** gerenciamento de dependências PHP.
- **Apache e `.htaccess`:** servidor web e regras de configuração.
- **`.env`:** variáveis de ambiente.
- **Git:** versionamento do código.

## Objetivo do projeto

Praticar PHP e entender como uma aplicação web funciona na prática, explorando requisições HTTP, integração com banco de dados, variáveis de ambiente, dependências e configuração de ambientes com Docker.

## Pré-requisitos

Para executar o projeto, é necessário ter instalado:

- Docker.
- Docker Compose.

As demais dependências e os serviços necessários são configurados pelos arquivos Docker do projeto.

## Configuração do ambiente

O arquivo `.env` reúne as configurações necessárias para executar a aplicação, como credenciais e parâmetros de conexão com o banco de dados.

Configure as variáveis conforme os nomes esperados pelo projeto. Por segurança, não publique senhas ou credenciais reais no GitHub.

## Banco de dados

O MariaDB armazena as tarefas, enquanto o MySQLi permite que o PHP acesse e manipule os dados.

As configurações de inicialização definem o banco, o usuário e a senha. A aplicação utiliza as credenciais correspondentes para estabelecer a conexão.

**Observação:** se o banco já tiver sido inicializado e estiver usando um volume persistente, alterar as variáveis do `.env` não garante que os usuários ou as senhas existentes sejam modificados.

## Como executar o projeto

1. Clone este repositório.
2. Acesse a pasta do projeto.
3. Configure o arquivo `.env`.
4. No terminal, dentro da pasta do projeto, execute:

   `docker compose up -d --build`

Após a inicialização, acesse a aplicação pelo navegador:

**[http://localhost:8080](http://localhost:8080)**

### Comandos úteis

Execute estes comandos no terminal, dentro da pasta do projeto:

- **Verificar os serviços:** `docker compose ps`
- **Consultar os logs:** `docker compose logs`
- **Interromper os serviços:** `docker compose down`

Os dados do banco podem permanecer armazenados em um volume, conforme a configuração do Docker Compose.

## Sobre o `.htaccess`

O arquivo `.htaccess` permite definir regras e configurações específicas do Apache, incluindo restrições de acesso e outras diretivas.

A aplicação pode funcionar sem determinadas regras desse arquivo, dependendo da configuração do servidor. Seu uso deve considerar as necessidades do projeto e as medidas de segurança aplicáveis.

## Considerações

Este é um projeto de estudo voltado à prática de desenvolvimento web e à compreensão de como as tecnologias utilizadas em uma aplicação trabalham em conjunto.

O conhecimento adquirido serve como base para projetos futuros e para o aprofundamento em PHP e desenvolvimento de sistemas.