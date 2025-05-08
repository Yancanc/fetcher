# API de Simulação de Crédito

Este projeto é uma API RESTful desenvolvida em Laravel para simulação de crédito com diferentes instituições financeiras e convênios.

## Índice

- [Requisitos](#requisitos)
- [Instalação](#instalação)
- [Executando o Projeto](#executando-o-projeto)
- [Rotas Disponíveis](#rotas-disponíveis)
- [Documentação Swagger](#documentação-swagger)
- [Exemplos de Requisições](#exemplos-de-requisições)
- [Testes](#testes)
- [Estrutura do Projeto](#estrutura-do-projeto)

## Requisitos

- PHP 8.2 ou superior
- Composer
- Extensão PHP JSON habilitada

## Instalação

1. Clone o repositório:

```bash
git clone [URL_DO_REPOSITÓRIO]
cd [NOME_DO_DIRETÓRIO]
```

2. Instale as dependências via Composer:

```bash
composer install
```

3. Crie o arquivo de ambiente a partir do exemplo:

```bash
cp .env.example .env
```

4. Configure o arquivo `.env` com a seguinte variável para o Swagger:

```
L5_SWAGGER_CONST_HOST=http://localhost:8000/api/v1
```

5. Gere a documentação Swagger:

```bash
php artisan l5-swagger:generate
```

## Executando o Projeto

Para iniciar o servidor de desenvolvimento:

```bash
php artisan serve
```

A API estará disponível em: http://localhost:8000

## Rotas Disponíveis

Todas as rotas da API começam com o prefixo `/api/v1`.

### Convênios

- **GET /api/v1/convenios** - Lista todos os convênios disponíveis
- **GET /api/v1/convenios/{id}** - Busca um convênio específico pelo ID

### Instituições

- **GET /api/v1/instituicoes** - Lista todas as instituições financeiras disponíveis
- **GET /api/v1/instituicoes/{id}** - Busca uma instituição financeira específica pelo ID

### Simulação de Crédito

- **POST /api/v1/simulacao-credito** - Realiza uma simulação de crédito

## Documentação Swagger

Este projeto utiliza Swagger/OpenAPI para documentação interativa da API.

Para acessar a documentação, inicie o servidor e acesse:

```
http://localhost:8000/api/documentation
```

Na interface do Swagger, você pode:
- Visualizar todos os endpoints disponíveis
- Ver os parâmetros necessários para cada requisição
- Testar os endpoints diretamente na interface
- Verificar os possíveis códigos de resposta

## Exemplos de Requisições

### Listar Convênios

**Requisição:**
```bash
curl -X GET http://localhost:8000/api/v1/convenios
```

**Resposta:**
```json
[
  {
    "id": "INSS",
    "valor": "Instituto Nacional do Seguro Social"
  },
  {
    "id": "SIAPE",
    "valor": "Sistema Integrado de Administração de Pessoal"
  }
]
```

### Simular Crédito

**Requisição:**
```bash
curl -X POST http://localhost:8000/api/v1/simulacao-credito \
  -H "Content-Type: application/json" \
  -d '{
    "valor_emprestimo": 5000,
    "instituicoes": ["banco1", "banco2"],
    "convenios": ["INSS"],
    "parcela": 12
  }'
```

**Resposta:**
```json
[
  {
    "instituicao": "Banco X",
    "convenio": "INSS",
    "parcelas": 12,
    "taxaJuros": 1.99,
    "valorParcela": 458.33,
    "valorTotal": 5500.00,
    "valorEmprestimo": 5000.00
  },
  {
    "instituicao": "Banco Y",
    "convenio": "INSS",
    "parcelas": 12,
    "taxaJuros": 2.05,
    "valorParcela": 460.10,
    "valorTotal": 5521.20,
    "valorEmprestimo": 5000.00
  }
]
```

## Testes

### Exemplo de teste usando cURL

Você pode testar a API usando cURL:

```bash
# Listar todos os convênios
curl -X GET http://localhost:8000/api/v1/convenios

# Buscar convênio específico
curl -X GET http://localhost:8000/api/v1/convenios/INSS

# Simular crédito
curl -X POST http://localhost:8000/api/v1/simulacao-credito \
  -H "Content-Type: application/json" \
  -d '{"valor_emprestimo": 5000}'
```

## Estrutura do Projeto

O projeto segue a arquitetura de serviços do Laravel:

- **Controllers** - Responsáveis pelo tratamento das requisições HTTP
  - `ConvenioController`
  - `InstituicaoController`
  - `SimulacaoCreditoController`

- **Services** - Contêm a lógica de negócio
  - `ConvenioService`
  - `InstituicaoService`
  - `SimulacaoCreditoService`

- **Resources** - Formatam as respostas da API
  - `ConvenioResource`
  - `InstituicaoResource`
  - `SimulacaoCreditoResource`

- **Requests** - Validam os dados de entrada
  - `SimulacaoCreditoRequest`

## Troubleshooting

Se encontrar algum problema ao executar o projeto, verifique:

1. Se todas as dependências foram instaladas
2. Se o arquivo `.env` está corretamente configurado
3. Se o Swagger está configurado corretamente

Para problemas relacionados à documentação Swagger:

```bash
# Limpe o cache da aplicação
php artisan cache:clear

# Regenere a documentação Swagger
php artisan l5-swagger:generate
```

## Contribuição

Para contribuir com o projeto:

1. Faça um fork do repositório
2. Crie uma branch para sua feature (`git checkout -b feature/nova-funcionalidade`)
3. Faça commit das suas alterações (`git commit -m 'Adiciona nova funcionalidade'`)
4. Envie para a branch (`git push origin feature/nova-funcionalidade`)
5. Abra um Pull Request 