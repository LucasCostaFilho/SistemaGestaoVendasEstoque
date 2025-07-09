# 📦 SistemaGestaoVendasEstoque

Sistema de Gestão de Vendas e Estoque desenvolvido para facilitar o controle de produtos, monitorar vendas e gerenciar o estoque de forma eficiente e automatizada. Ideal para pequenas e médias empresas.

## 🚀 Funcionalidades

- Cadastro de produtos com informações como nome, categoria, preço e quantidade em estoque.
- Controle de estoque com atualização automática após vendas.
- Registro e histórico de vendas.
- Relatórios simples de vendas e movimentação de estoque.
- Interface intuitiva e fácil de usar.

## 🛠️ Tecnologias Utilizadas

- **Frontend**: `Blade` 
- **Backend**: `Laravel`
- **Banco de Dados**: `MySQL`
- **Outros**: (`Aiven`)

## 💻 Como Executar o Projeto

1. **Clone o repositório:**

```bash
git clone https://github.com/LucasCostaFilho/SistemaGestaoVendasEstoque.git
```
2. **Acesse o diretório do projeto:**

```bash
cd SistemaGestaoVendasEstoque
```

3. **Instale as dependências do PHP:**

Certifique-se de ter o [Composer](https://getcomposer.org/) instalado. Em seguida, execute:

```bash
composer install
```

4. **Instale as dependências do Node.js:**

Certifique-se de ter o [Nodejs](https://nodejs.org/en) instalado. Em seguida, execute:

```bash
npm install
```

5. **Configure o arquivo de ambiente:**

Copie o arquivo `.env.example` para `.env` e ajuste as configurações, como conexão com o banco de dados:

```bash
cp .env.example .env
```

Edite o arquivo `.env` com as credenciais do seu banco de dados MySQL e outras configurações necessárias, como:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nome_do_banco
DB_USERNAME=seu_usuario
DB_PASSWORD=sua_senha
```

6. **Gere a chave da aplicação:**

```bash
php artisan key:generate
```

7. **Execute as migrações do banco de dados:**

Para criar as tabelas no banco de dados, execute:

```bash
php artisan migrate
```

8. **Inicie os servidores locais:**

```bash
php artisan serve
```
Em outro terminal execute:
```bash
npm run dev
```
O projeto estará disponível em `http://localhost:8000` (ou outra porta especificada).
