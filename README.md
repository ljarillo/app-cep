# Sistema de Consulta de CEP

Este é um sistema desenvolvido em Laravel que permite aos usuários consultar informações de endereço usando um CEP.

## Funcionalidades

- Consulta de endereço por CEP através de uma API externa (exemplo: ViaCEP).
- Autenticação de usuários com Sanctum.
- Proteção de rotas para acesso apenas por usuários autenticados.
- Revogação de token de acesso ao fazer logout.

## Requisitos do Sistema

- PHP >= 8.2
- MySQL ou outro banco de dados suportado pelo Laravel

# Setup Docker Laravel

Este repositório contém um ambiente Docker configurado para desenvolvimento Laravel.

## Requisitos do Sistema

- Docker
- Docker Compose

## Instalação e Configuração

1. Clone o repositório:

    ```bash
    git clone https://github.com/ljarillo/app-cep.git
    ```

2. Navegue até o diretório clonado:

    ```bash
    cd app-cep
    ```

3. Copie o arquivo de ambiente de exemplo para `.env`:

    ```bash
    cp .env.example .env
    ```

4. Inicie os contêineres Docker:

    ```bash
    docker compose up -d
    ```

5. Acesse o contêiner da aplicação Laravel:

    ```bash
    docker compose exec app bash
    ```

6. Instale as dependências PHP com Composer:

    ```bash
    composer install
    ```

7. Gere a chave de aplicação:

    ```bash
    php artisan key:generate
    ```

8. Execute as migrações do banco de dados:

    ```bash
    php artisan migrate
    ```

9. Opcionalmente, se desejar, popule o banco de dados com dados de exemplo:

    ```bash
    php artisan db:seed
    ```

Após seguir esses passos, seu ambiente Laravel Docker estará configurado e pronto para uso. Você pode acessar sua aplicação Laravel em `http://localhost:8989`.

## Rotas Disponíveis

- `POST /api/login`: Endpoint para autenticar um usuário. Requer um payload JSON contendo `email` e `password`.
- `POST /api/logout`: Endpoint para fazer logout de um usuário autenticado.
- `GET /endereco/{cep}`: Endpoint para consultar informações de endereço usando um CEP. Requer Beare autenticação.

## Usuário de Teste

Você pode usar o seguinte usuário para autenticar e usar a rota:

- **Email:** test@user.com
- **Senha:** 123

## Licença

Este projeto é licenciado sob a [MIT License](https://opensource.org/licenses/MIT).
