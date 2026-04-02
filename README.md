# 🛒 Mini ERP PHP

Sistema web de gerenciamento de produtos, pedidos e carrinho de compras desenvolvido em PHP com arquitetura MVC, com interface moderna em Bootstrap, integração de cupons, controle de estoque, cálculo de frete por CEP e dashboard administrativo.

Projeto criado com foco em organização de código, boas práticas de desenvolvimento web e simulação de um pequeno ERP de e-commerce.

---

# 📦 Funcionalidades:

# 🛍️ Gestão de Produtos

Cadastro de produtos
Listagem de produtos
Edição e remoção
Controle de estoque
Variações (tamanho, modelo, etc.)
SKU e imagem do produto
🛒 Carrinho de Compras
Adição de produtos ao carrinho
Cálculo automático de subtotal
Atualização dinâmica
Finalização de pedido

---

# 🏷️ Cupons de Desconto

Aplicação de cupons
Cálculo automático de desconto
Validação do cupom
Exibição de cupom ativo

---

# 📍 CEP e Frete

Busca de endereço por CEP
Simulação de frete
Atualização automática no resumo do pedido

---

# 📊 Dashboard Administrativo

Vendas do dia
Total de pedidos
Clientes
Produtos cadastrados
Últimos pedidos
Status de pagamento

---

# 📦 Controle de Estoque

Redução automática após pedido
Monitoramento de produtos com estoque baixo

---

# 🧱 Arquitetura

O sistema segue o padrão MVC (Model - View - Controller).

Mini-ERP-PHP
│
├── app
│   ├── controllers
│   ├── models
│   ├── views
│
├── config
│   └── db.php
│
├── public
│   ├── index.php
│   ├── bootstrap.min.css
│   ├── bootstrap.bundle.min.js
│   ├── style.css
│   └── script.js
│
├── database
│   └── mini_erp.sql
│
└── README.md

---

# 🚀 Tecnologias Utilizadas

Backend
PHP 8+
PDO
MySQL
Arquitetura MVC
Sessões PHP
Frontend
HTML5
CSS3
Bootstrap
JavaScript
Integrações
API de CEP
Sistema de Cupons
Dashboard administrativo

---

# 🖥️ Interface do Sistema

Tela principal
Cadastro de produtos
Tabela de produtos
Carrinho
Cupons
CEP
Resumo do pedido
Dashboard
Métricas de vendas
Pedidos recentes
Status de pagamento

---

# ⚙️ Como rodar o projeto
1️⃣ Clonar o repositório
git clone https://github.com/seu-usuario/mini-erp-php.git
2️⃣ Colocar no XAMPP

Mover a pasta para:

htdocs/

Exemplo:

C:\xampp\htdocs\Mini-ERP-PHP
3️⃣ Criar banco de dados

Abrir phpMyAdmin

Criar banco:

mini_erp

Importar:

database/mini_erp.sql
4️⃣ Configurar conexão

Arquivo:

config/db.php

Editar:

$host = "localhost";
$db = "mini_erp";
$user = "root";
$pass = "";
5️⃣ Rodar servidor

Abrir:

Apache
MySQL

No XAMPP.

6️⃣ Acessar no navegador
http://localhost/Mini-ERP-PHP/public

ou

http://localhost/Mini-ERP-PHP

---

# 📊 Objetivo do Projeto

Este projeto foi desenvolvido com foco em:

Prática de PHP MVC
Organização de código
Simulação de ERP
Controle de produtos e pedidos
Integração frontend e backend
Uso de MySQL
Estrutura profissional de sistema web

Projeto ideal para portfólio de desenvolvedor Full Stack Júnior.

---

# 🧠 Aprendizados

Arquitetura MVC
CRUD com PHP
Sessões e carrinho
Integração com MySQL
Dashboard administrativo
Organização de projeto
Bootstrap e responsividade
Estrutura de ERP

---

# 👩‍💻 Autor

Janine
Desenvolvedora Web Full Stack em formação
Projeto educacional para portfólio e prática de desenvolvimento de sistemas web.
