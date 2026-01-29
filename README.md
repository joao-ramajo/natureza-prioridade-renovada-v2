# 🌱 NPR - Natureza Prioridade Renovada

> API para cadastro e consulta de pontos de coleta de lixo, promovendo a reciclagem e a sustentabilidade

[![Laravel](https://img.shields.io/badge/Laravel-12-FF2D20?style=flat&logo=laravel&logoColor=white)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=flat&logo=php&logoColor=white)](https://php.net)
[![Pest](https://img.shields.io/badge/Tested_with-Pest-FF4088?style=flat)](https://pestphp.com)
[![Swagger](https://img.shields.io/badge/API_Docs-Swagger-85EA2D?style=flat&logo=swagger&logoColor=black)](https://swagger.io)

[🌐 API em Produção](http://npr.salgadinhos-web.blog/) | [📖 Documentação OpenAPI](http://npr.salgadinhos-web.blog/api/docs)

---

## 📖 Sobre o Projeto

**NPR (Natureza Prioridade Renovada)** é uma API RESTful que centraliza informações sobre pontos de coleta de lixo em diversas localidades. O projeto nasceu de um trabalho de conclusão de curso técnico e evoluiu para uma iniciativa que visa **aumentar a visibilidade da importância da reciclagem** através da tecnologia.

### 🎯 Problema Resolvido

Disponibiliza uma plataforma centralizada onde:
- 📍 Pontos de coleta podem ser cadastrados com informações detalhadas
- 🗺️ Usuários podem localizar pontos de coleta próximos
- ✅ Administradores podem moderar e validar as informações
- 🌍 A comunidade pode contribuir com dados sobre reciclagem

### 💚 Impacto Social

Ao facilitar o acesso a informações sobre pontos de coleta, o NPR contribui para:
- Redução do descarte inadequado de resíduos
- Aumento da taxa de reciclagem
- Conscientização ambiental
- Economia circular

---

## ✨ Principais Funcionalidades

| Funcionalidade | Descrição |
|----------------|-----------|
| 📝 **Cadastro de Pontos** | Criação de pontos de coleta com informações detalhadas e imagens |
| ✅ **Sistema de Aprovação** | Moderação de pontos cadastrados (aprovação/reprovação) |
| 🔍 **Listagem Inteligente** | Consulta e filtro de pontos de coleta por diversos critérios |
| 🔄 **Atualizações** | Edição de informações de pontos existentes |
| 📸 **Galeria de Imagens** | Suporte para múltiplas imagens por ponto de coleta |
| 🔐 **Autenticação** | Sistema seguro via Laravel Sanctum |

---

## 🛠️ Tecnologias Utilizadas

Este projeto foi construído com as melhores práticas e tecnologias modernas:

### Core
- **[Laravel 12](https://laravel.com)** - Framework PHP elegante e poderoso
- **[MySQL](https://www.mysql.com)** - Banco de dados relacional
- **[Laravel Sanctum](https://laravel.com/docs/sanctum)** - Autenticação de API segura

### Ferramentas de Desenvolvimento
- **[Swagger API](https://swagger.io)** - Documentação interativa da API
- **[PHPStan](https://phpstan.org)** - Análise estática de código
- **[PHP_CodeSniffer](https://github.com/squizlabs/PHP_CodeSniffer)** - Padrões de código (PSR)
- **[Pest](https://pestphp.com)** - Framework de testes moderno

### Arquitetura

- **Tipo**: Monolito Modular
- **Padrão**: Domain-Driven Design (DDD)
- **Organização**: Separação por módulos (`CollectionPoints`, `Auth`, etc.)
- **Princípios**: Clean Code, PSR Standards

---

## 🚀 Como Começar

### Pré-requisitos

- [PHP 8.2+](https://www.php.net/downloads)
- [Composer](https://getcomposer.org/)
- [Docker](https://www.docker.com/get-started) (para Laravel Sail)

### Instalação

1. **Clone o repositório**
```bash
git clone https://github.com/joao-ramajo/natureza-prioridade-renovada-v2.git
cd npr-api
```

2. **Instale as dependências**
```bash
composer install
```

3. **Configure o ambiente**
```bash
cp .env.example .env
php artisan key:generate
```

**⚠️ Importante**: Configure a variável de ambiente:
```env
APP_LOCALE=pt_BR
```

4. **Suba os containers Docker**
```bash
./vendor/bin/sail up -d
```

5. **Execute as migrations**
```bash
./vendor/bin/sail artisan migrate
```

6. **Acesse a documentação da API**
```
http://localhost/api/documentation
```

### Comandos Úteis

```bash
# Rodar o projeto em desenvolvimento
./vendor/bin/sail up -d

# Parar o projeto
./vendor/bin/sail down

# Executar testes
./vendor/bin/sail artisan test

# Análise estática de código
./vendor/bin/sail composer phpstan

# Verificar padrões de código
./vendor/bin/sail composer phpcs
```

---

## 💡 Como Usar a API

### 🔑 Autenticação

Para consumir a API, você precisa de um token de acesso. 

**Como solicitar acesso:**
- Entre em contato via [LinkedIn: /joao-ramajo](https://linkedin.com/in/joao-ramajo)
- Informe o propósito de uso da API
- Receba suas credenciais de acesso

### 📚 Documentação

A documentação completa da API está disponível via OpenAPI/Swagger:

**Produção**: [http://npr.salgadinhos-web.blog/api/docs](http://npr.salgadinhos-web.blog/api/docs)

**Local**: `http://localhost/api/documentation`

---

## 🧪 Testes

O projeto utiliza **Pest** para testes de integração.

```bash
# Executar todos os testes
./vendor/bin/sail artisan test

# Executar testes com cobertura
./vendor/bin/sail artisan test --coverage
```

**Status atual**: Cobertura básica focada nos fluxos principais da aplicação.

---

## 📈 Status do Projeto

**Status Atual**: 🚧 Em Desenvolvimento Ativo

O projeto possui funcionalidades mínimas operacionais e está em constante evolução.

### 🗺️ Roadmap

Próximas funcionalidades planejadas:

- [ ] **Sistema de Aprovação Aprimorado**
  - Notificações para criadores de pontos
  - Histórico de moderação

- [ ] **Melhorias na Listagem**
  - Busca por geolocalização (pontos próximos)
  - Filtros avançados (tipo de resíduo, horário, etc.)
  - Ordenação por relevância

- [ ] **Recursos Adicionais**
  - Sistema de avaliações e comentários
  - Estatísticas de reciclagem
  - Gamificação para incentivar contribuições

---

## 🤝 Contribuições

Contribuições são bem-vindas! Este projeto segue:

### Padrões de Código
- **PSR-12** - Padrão de estilo de código PHP
- **Clean Code** - Princípios de código limpo
- **DDD** - Domain-Driven Design

### Como Contribuir

1. Faça um fork do projeto
2. Crie uma branch para sua feature (`git checkout -b feature/MinhaFeature`)
3. Siga os padrões de código (realize as análises de código antes de commitar)
4. Escreva testes para novas funcionalidades
5. Commit suas mudanças (`git commit -m 'feat: Adiciona MinhaFeature'`)
6. Push para a branch (`git push origin feature/MinhaFeature`)
7. Abra um Pull Request

### Reportar Bugs

Encontrou um bug? Abra uma [issue](https://github.com/seu-usuario/npr-api/issues) detalhando:
- Descrição do problema
- Passos para reproduzir
- Comportamento esperado vs. atual
- Ambiente (OS, versão do PHP, etc.)

---


## 🔗 Links Úteis

- **API em Produção**: [http://npr.salgadinhos-web.blog/](http://npr.salgadinhos-web.blog/)
- **Documentação OpenAPI**: [http://npr.salgadinhos-web.blog/api/docs](http://npr.salgadinhos-web.blog/api/docs)
- **Documentação do Laravel**: [https://laravel.com/docs](https://laravel.com/docs)
- **Laravel Sanctum**: [https://laravel.com/docs/sanctum](https://laravel.com/docs/sanctum)
- **Pest PHP**: [https://pestphp.com](https://pestphp.com)
- **Swagger/OpenAPI**: [https://swagger.io](https://swagger.io)

---

## 🌍 Contribua para um Mundo Mais Verde

Este projeto é mais do que código - é uma ferramenta para **transformação ambiental**. Ao usar, contribuir ou divulgar o NPR, você está ajudando a construir um futuro mais sustentável.
