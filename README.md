# FocusFlow

> Sistema web de produtividade para gerenciamento de tarefas, hábitos e acompanhamento de desempenho.

[![Status](https://img.shields.io/badge/status-em%20desenvolvimento-yellow)](#roadmap)
[![Backend](https://img.shields.io/badge/backend-PHP-777BB4)](https://www.php.net/)
[![Database](https://img.shields.io/badge/database-MySQL-4479A1)](https://www.mysql.com/)

## 📌 Sobre o projeto

O **FocusFlow** é uma aplicação web desenvolvida para centralizar atividades de produtividade em um único ambiente. O sistema começou como um gerenciador de tarefas e evoluiu para incluir hábitos, calendário, estatísticas e uma área voltada ao acompanhamento de atividades acadêmicas.

O projeto também serve como laboratório prático para desenvolvimento web, integração com banco de dados, organização de funcionalidades por branches e evolução incremental de uma aplicação.

## ✨ Funcionalidades

### 📝 Tarefas

- Criação e gerenciamento de tarefas
- Definição de prioridade
- Definição de prazo
- Conclusão de tarefas
- Marcação de tarefas importantes
- Visualização de tarefas concluídas
- Contadores e indicadores atualizados pela aplicação

### 🔁 Hábitos

- Criação de hábitos
- Edição e exclusão
- Acompanhamento de hábitos
- Organização das rotinas por frequência

### 📊 Estatísticas

- Dashboard de estatísticas
- Indicadores relacionados a tarefas
- Acompanhamento do desempenho dos hábitos
- Visualização de informações de produtividade

### 📅 Calendário

- Organização de tarefas por data
- Visualização de prazos
- Integração com o gerenciamento de tarefas

### 🎓 Atividades acadêmicas

- Área dedicada ao gerenciamento de atividades da faculdade
- Organização das atividades dentro da aplicação

### 🔐 Autenticação

- Cadastro de usuários
- Login
- Controle de acesso à aplicação

## 🛠️ Tecnologias

| Camada | Tecnologias |
|---|---|
| Frontend | HTML, CSS3, Bootstrap, Font Awesome, JavaScript |
| Backend | PHP |
| Banco de dados | MySQL |
| Visualização | Chart.js |
| Versionamento | Git e GitHub |

## 🏗️ Organização do projeto

A aplicação é organizada por módulos e recursos, mantendo arquivos de interface, estilos, banco de dados e documentação separados.

```text
PROJETO-EM-COMPUTACAO-APLICADA/
├── database/
│   └── focusflow.sql
├── css/
├── documentação/
├── apresentação/
├── cadastrar.php
├── concluido.php
├── estatisticas.php
├── faculdade.php
├── habitos.php
├── home.php
├── importante.php
└── ...
```

O script do banco de dados está disponível em `database/focusflow.sql`.

## 🗄️ Banco de dados

O projeto utiliza **MySQL** como banco de dados relacional. O script de criação está disponível no diretório `database/`.

```text
Aplicação PHP
      │
      ▼
  Requisições
      │
      ▼
   MySQL
      │
      ▼
 Dados de usuários,
tarefas, hábitos e módulos
```

## 🚀 Como executar localmente

### Pré-requisitos

- PHP
- MySQL
- Servidor web compatível com PHP, como Apache
- Git

### Instalação

1. Clone o repositório:

```bash
git clone https://github.com/Bielbraga/PROJETO-EM-COMPUTACAO-APLICADA.git
cd PROJETO-EM-COMPUTACAO-APLICADA
```

2. Configure o servidor PHP/Apache para apontar para a pasta do projeto.

3. Crie o banco de dados MySQL e importe:

```text
database/focusflow.sql
```

4. Configure as credenciais de acesso ao banco nos arquivos de conexão utilizados pela aplicação.

5. Inicie o servidor e acesse a aplicação pelo endereço local configurado.

> As configurações de ambiente podem variar de acordo com o servidor local utilizado.

## 🌿 Estratégia de branches

Durante o desenvolvimento, o projeto utiliza uma estratégia baseada em branches de funcionalidade:

```text
feature/*
    ↓
develop
    ↓
  main
```

Exemplos de funcionalidades desenvolvidas em branches próprias:

- `feature/login`
- `feature/dashboard`
- `feature/habits-system`
- `feature/statistics-dashboard`
- `feature/tasks-calendar-improvements`
- `feature/sidebar-navigation-update`

Essa organização permite desenvolver funcionalidades de forma isolada antes de integrá-las ao projeto principal.

## 🗺️ Roadmap

- [x] Sistema de autenticação
- [x] Gerenciamento de tarefas
- [x] Prioridades e prazos
- [x] Tarefas importantes
- [x] Sistema de hábitos
- [x] Calendário
- [x] Dashboard de estatísticas
- [x] Módulo acadêmico
- [ ] Sistema de notificações e lembretes
- [ ] Relatórios de produtividade mais completos
- [ ] Melhorias de segurança e validação
- [ ] Testes automatizados
- [ ] Melhorias de arquitetura e separação de responsabilidades
- [ ] Deploy da aplicação

## 📚 Contexto acadêmico

O FocusFlow foi desenvolvido no contexto de estudos de **Ciência da Computação** e evoluiu por meio de diferentes etapas de desenvolvimento, permitindo aplicar conhecimentos de desenvolvimento web, banco de dados, versionamento e organização de software.

## 👨‍💻 Autor

**Gabriel Braga**

Estudante de Ciência da Computação com foco em desenvolvimento backend, bancos de dados e análise de dados.

---

⭐ Se este projeto for útil para você, considere deixar uma estrela no repositório.