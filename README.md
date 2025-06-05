#  GESUAS - Cadastro de Cidadãos

Sistema para cadastro e consulta de cidadãos com geração automática de NIS (Número de Identificação Social), desenvolvido como teste técnico.

##  Funcionalidades
- **Cadastro simplificado**:
  - Formulário HTML com único campo (nome)
  - Geração automática de NIS de 11 dígitos
  - Salva cidadão no banco de dados com campo Nome e NIS
- **Consulta por NIS**:
  - Retorna dados do cidadão ou "Não encontrado"

##  Tecnologias Utilizadas
| Componente       | Tecnologias                  |
|------------------|-----------------------------|
| Frontend         | HTML5 + CSS puro            |
| Backend          | PHP 8.4 (POO puro)          |
| Banco de Dados   | SQLite3                     |
| Testes           | PHPUnit                     |

## Pré-requisitos
- PHP 8.0+
- Composer instalado
- Extensão SQLite ativada no PHP

## Como Verificar Extensão SQLite:

```bash
php -m | grep sqlite
# Deve retornar: pdo_sqlite e sqlite3
```
Se Falhar, no arquivo php.ini, descomente:
```bash
extension=pdo_sqlite
extension=sqlite3
```

##  Instalação
```bash
# Clone o projeto
git clone https://github.com/moraisale/teste-tecnico-gesuas.git
cd teste-tecnico-gesuas

# Instale dependências (autoload)
composer install

# Crie a pasta do banco de dados
mkdir database
chmod 777 database/  # Garante permissão de escrita

# Inicie o servidor
php -S localhost:8000 -t public
```

##  Estrutura do Projeto
```
teste-tecnico-gesuas/
├── public/
|   ├── assets/
|       ├── index.css
|       ├── result.css
│   ├── index.php      # Página inicial
│   └── search.php     # Consulta por NIS
├── src/
│   ├── Model/
│   │   ├── Citizen.php
│   │   ├── NISGenerator.php    # Lógica de geração do NIS
│   │   └── CitizenRepository.php
│   └── Database.php   # Conexão SQLite
├── tests/             # Testes PHPUnit
└── templates/         # Views HTML
```

##  Testes
```bash
# Executar todos os testes
./vendor/bin/phpunit

# Testar apenas a geração de NIS
./vendor/bin/phpunit tests/NISGeneratorTest.php
```

##  Exemplos de Uso

### Via Browser
Acesse http://localhost:8000

Preencha o nome e clique em "Cadastrar Cidadão"

Copie o NIS gerado e consulte no formulário ao lado clicando em "Consultar NIS"


##  Validações Implementadas
| Camada   | Validações                         |
|----------|------------------------------------|
| Frontend | Campo nome obrigatório             |
| Backend  | Formato do NIS, nome válido        |
| Banco    | NIS único, tipo dos dados          |
