# 📚 PHP Biblioteca V1

Sistema simples de gerenciamento de livros (CRUD) desenvolvido em **PHP puro** e **MySQL**, sem o uso de frameworks. Projeto de estudo focado em reforçar os fundamentos de uma aplicação web: conexão com banco de dados, formulários, manipulação de requisições HTTP e boas práticas de segurança.

## ✨ Funcionalidades

- **Cadastrar** novos livros (título, autor e ano)
- **Listar** todos os livros cadastrados
- **Editar** os dados de um livro existente
- **Deletar** um livro
- Mensagens de feedback visual após cada ação (adicionado, atualizado, deletado)
- Interface estilizada em cards, com formulário destacado

## 🛠️ Tecnologias

- PHP puro (sem frameworks)
- MySQL
- PDO com *prepared statements* (proteção contra SQL Injection)
- HTML5 e CSS3

## 📁 Estrutura do projeto

```
├── t3.php                  # Página principal: lista, cadastra e deleta livros
├── editar.php               # Página de edição de um livro específico
├── database.php              # Conexão com o banco (NÃO versionado - veja abaixo)
├── database.example.php      # Modelo de conexão para configurar localmente
├── style.css                  # Estilização da interface
└── .gitignore
```

## ⚙️ Como rodar o projeto localmente

### Pré-requisitos

- PHP 7.4 ou superior
- MySQL ou MariaDB
- Servidor local (Apache, Nginx ou o servidor embutido do PHP)

### Passo a passo

1. Clone o repositório:
   ```bash
   git clone https://github.com/DevBocchi/PHP-BIBLIOTECA-V1.git
   cd PHP-BIBLIOTECA-V1
   ```

2. Crie o banco de dados e a tabela `livros`:
   ```sql
   CREATE DATABASE biblioteca;

   USE biblioteca;

   CREATE TABLE livros (
       id INT AUTO_INCREMENT PRIMARY KEY,
       titulo VARCHAR(255) NOT NULL,
       autor VARCHAR(255) NOT NULL,
       ano INT NOT NULL
   );
   ```

3. Copie o arquivo de exemplo de conexão e configure com suas credenciais:
   ```bash
   cp database.example.php database.php
   ```
   Edite o `database.php` com o usuário, senha e nome do seu banco local.

4. Inicie um servidor local (exemplo usando o servidor embutido do PHP):
   ```bash
   php -S localhost:8000
   ```

5. Acesse no navegador:
   ```
   http://localhost:8000/t3.php
   ```

## 🔒 Segurança

- Todas as consultas ao banco usam **prepared statements via PDO**, prevenindo SQL Injection.
- O arquivo `database.php`, que contém as credenciais reais do banco, **não é versionado** (está no `.gitignore`). Use o `database.example.php` como modelo.

## 🚧 Status do projeto

Este é o **V1** do projeto — a base funcional do CRUD está completa. Próximas melhorias planejadas:

- [ ] Validação de campos (front e back-end)
- [ ] Proteção contra XSS na exibição dos dados
- [ ] Paginação da listagem de livros
- [ ] Sistema de busca/filtro

## 👤 Autor

Desenvolvido por [DevBocchi](https://github.com/DevBocchi) como parte de estudos em PHP e desenvolvimento back-end.