#  GESUAS - Cadastro de Cidadãos

Sistema para cadastro e consulta de cidadãos com geração automática de NIS (Número de Identificação Social), desenvolvido como teste técnico.

##  Funcionalidades
- **Cadastro simplificado**:
  - Formulário HTML com único campo (nome)
  - Geração automática de NIS de 11 dígitos
- **Consulta por NIS**:
  - Retorna dados do cidadão ou "Não encontrado"

## ⚙ Tecnologias Utilizadas
| Componente       | Tecnologias                  |
|------------------|-----------------------------|
| Frontend         | HTML5 + CSS puro            |
| Backend          | PHP 8.4 (POO puro)          |
| Banco de Dados   | SQLite3                     |
| Testes           | PHPUnit                     |

##  Instalação
```bash
# Clone o projeto
git clone https://github.com/seu-usuario/gesuas.git

# Instale dependências (autoload)
composer install

# Crie a pasta do banco de dados
mkdir database

# Inicie o servidor
php -S localhost:8000 -t public
```

##  Estrutura do Projeto
```
gesuas/
├── public/
│   ├── index.php      # Ponto de entrada
│   └── search.php     # Consulta por NIS
├── src/
│   ├── Model/
│   │   ├── Citizen.php
│   │   ├── NISGenerator.php    # Lógica de geração
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

Copie o NIS gerado e consulte no formulário ao lado


##  Validações Implementadas
| Camada   | Validações                        |
|----------|------------------------------------|
| Frontend | Campo nome obrigatório             |
| Backend  | Formato do NIS, nome válido        |
| Banco    | NIS único, tipo dos dados          |
