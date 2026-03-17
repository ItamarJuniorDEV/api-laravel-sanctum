# API com Sanctum

API RESTful para gerenciamento de clientes com autenticação segura, construída com Laravel, MySQL e Laravel Sanctum.

## Funcionalidades

* Autenticação com Laravel Sanctum e tokens de acesso
* Gerenciamento de clientes (CRUD)
* Respostas padronizadas via ApiResponse
* Expiração de tokens (1 hora)
* Permissões baseadas em abilities do token

## Tecnologias

* **PHP** - Linguagem de programação
* **Laravel** - Framework PHP
* **MySQL** - Banco de dados relacional
* **Laravel Sanctum** - Autenticação via token para APIs
* **Factories e Seeders** - Geração de dados para desenvolvimento
* **Migrations** - Versionamento do banco de dados
* **Eloquent ORM** - Mapeamento objeto-relacional

## Instalação

```bash
# Clone o repositório
git clone https://github.com/ItamarJuniorDEV/api-laravel-sanctum
cd api-laravel-sanctum

# Instale as dependências
composer install

# Configure as variáveis de ambiente (.env)
cp .env.example .env
# Edite o arquivo .env com suas configurações de banco de dados

# Gere a chave de aplicação
php artisan key:generate

# Execute as migrações e seeders
php artisan migrate --seed

# Inicie o servidor
php artisan serve
```

## Autenticação

A API usa Laravel Sanctum para autenticação com tokens. Para acessar rotas protegidas:

1. Faça login via endpoint `POST /api/login`
2. Use o token recebido no cabeçalho: `Authorization: Bearer {seu_token}`

**Credenciais de teste:**
* Email: `app001@api.com`
* Senha: `Aa123456`

## Endpoints

| Recurso      | Método | Endpoint              | Descrição                           |
|--------------|--------|-----------------------|-------------------------------------|
| Autenticação | POST   | /api/login            | Fazer login e obter token           |
| Autenticação | POST   | /api/logout           | Encerrar sessão e revogar tokens    |
| Status       | GET    | /api/status           | Verificar status da API             |
| Clientes     | GET    | /api/clients          | Listar todos os clientes            |
| Clientes     | POST   | /api/clients          | Criar um novo cliente               |
| Clientes     | GET    | /api/clients/{id}     | Obter detalhes de um cliente        |
| Clientes     | PUT    | /api/clients/{id}     | Atualizar informações de um cliente |
| Clientes     | DELETE | /api/clients/{id}     | Excluir um cliente                  |

## Modelos de Dados

**Usuário**
* ID, nome, email, senha (hash), remember_token, timestamps

**Cliente**
* ID, nome, email, telefone, timestamps

**Personal Access Token**
* ID, tokenable_type, tokenable_id, nome, token, abilities, timestamps, expires_at

## Testes com Postman

A coleção Postman está incluída no projeto:
* `API Sanctum.postman_collection.json`

Inclui todos os endpoints necessários para:
1. Login para obter token
2. Verificar status da API
3. Gerenciar clientes (listar, criar, visualizar, atualizar, excluir)
4. Logout

## Desenvolvimento

Para gerar dados de teste adicionais:

```bash
# Executar seeders para criar dados de teste
php artisan db:seed --class=ClientSeeder

# Criar um novo usuário para acesso à API
php artisan db:seed --class=UserSeeder
```

## Estrutura do Projeto

* **Routes**: `routes/api.php` - Definição dos endpoints da API
* **Controllers**: `app/Http/Controllers` - Lógica de negócios
* **Models**: `app/Models` - Modelos Eloquent
* **Migrations**: `database/migrations` - Estrutura do banco de dados
* **Factories/Seeders**: `database/factories`, `database/seeders` - Geração de dados
* **Services**: `app/Services` - Serviços auxiliares

## Licença

Este projeto está licenciado sob a licença MIT.

## Autor

Itamar Junior
