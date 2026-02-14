# Lib-on (CakePHP) — Manual de execução

Este guia mostra como rodar a plataforma, criar o banco e validar as funcionalidades de login, cadastro, consulta IA e reserva com ticket.

## 1) Pré-requisitos

- PHP 8.1+ com extensão `pdo_sqlite` habilitada
- Composer
- Estrutura de app CakePHP (projeto base com `bin/cake`)

> Observação: este repositório contém os arquivos de app (controllers, templates, services e rotas). Em um projeto CakePHP completo, basta copiar esses arquivos para os mesmos caminhos.

## 2) Instalação de dependências

```bash
composer install
```

## 3) Criar o banco de dados

O projeto usa SQLite e inicializa automaticamente no primeiro acesso via `DatabaseService`.

- Arquivo do banco: `var/data/libon.sqlite`
- Tabelas criadas automaticamente:
  - `users`
  - `books`
  - `reservations`
  - `reservation_tickets`
  - `ai_consultations`

Também existe o schema de referência em `config/schema.sql`.

### Usuário inicial padrão

No primeiro bootstrap, um usuário é criado automaticamente:

- **E-mail:** `admin@libon.local`
- **Senha:** `123456`

## 4) Subir o servidor

```bash
bin/cake server -H 0.0.0.0 -p 8765
```

Acesse no navegador:

- Home: `http://localhost:8765/`
- Login: `http://localhost:8765/login`
- Cadastro: `http://localhost:8765/cadastro`
- Consulta IA: `http://localhost:8765/consulta-ia`
- Reservas + ticket: `http://localhost:8765/reservas`

## 5) Fluxo recomendado para validar

1. Abrir `/cadastro` e criar um novo usuário.
2. Fazer login em `/login` com o novo cadastro.
3. Consultar a IA em `/consulta-ia`.
4. Reservar um livro em `/reservas`.
5. Confirmar exibição do ticket com código `LIB-...`.

## 6) Verificações rápidas (lint)

```bash
php -l config/routes.php
php -l src/Controller/UsersController.php
php -l src/Controller/AiController.php
php -l src/Controller/ReservationsController.php
php -l src/Service/DatabaseService.php
php -l src/Service/LibraryService.php
php -l templates/Users/login.php
php -l templates/Users/register.php
php -l templates/Ai/consult.php
php -l templates/Reservations/index.php
```

## 7) Troubleshooting

- Se o login falhar com usuário novo, verifique se o arquivo `var/data/libon.sqlite` foi criado e se a tabela `users` existe.
- Se a reserva não gerar ticket, valide se `reservation_tickets` foi criada e se o livro selecionado possui `available_copies > 0`.
- Se a consulta IA não aparecer, confira se `ai_consultations` foi criada e se o formulário está enviando `POST`.


## 8) Preparar criação de PR (quando estiver bloqueado)

Se não estiver conseguindo abrir PR, rode o script abaixo para validar o que está faltando:

```bash
./scripts/prepare-pr.sh
```

Ele verifica:

- se existe `remote` configurado
- se não há alterações pendentes sem commit
- se a branch atual tem `upstream` configurado

Se apontar falta de upstream, execute:

```bash
git push -u origin <sua-branch>
```

Depois disso, abra o PR normalmente pela UI do GitHub/GitLab ou via CLI (`gh pr create`).

