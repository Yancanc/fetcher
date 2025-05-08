# Configuração do Swagger para Documentação da API

Para visualizar a documentação Swagger da API, siga os passos abaixo para instalar e configurar o pacote L5-Swagger no Laravel.

## Instalação

1. Instale o pacote L5-Swagger através do Composer:

```bash
composer require darkaonline/l5-swagger
```

2. Publique os arquivos de configuração:

```bash
php artisan vendor:publish --provider "L5Swagger\L5SwaggerServiceProvider"
```

## Configuração

1. Adicione a constante `L5_SWAGGER_CONST_HOST` no arquivo `.env`:

```
L5_SWAGGER_CONST_HOST=http://localhost:8000/api/v1
```

2. Verifique o arquivo de configuração `config/l5-swagger.php` e ajuste conforme necessário.

3. Adicione o namespace do OpenAPI annotations no arquivo `composer.json`:

```json
"autoload": {
    "psr-4": {
        "App\\": "app/",
        "Database\\Factories\\": "database/factories/",
        "Database\\Seeders\\": "database/seeders/"
    },
    "files": [
        "app/OpenApi/Constants.php"
    ]
},
```

4. Regenere o autoloader:

```bash
composer dump-autoload
```

## Gerar Documentação

Para gerar a documentação Swagger, execute:

```bash
php artisan l5-swagger:generate
```

## Acessar Documentação

A documentação Swagger estará disponível em:

```
http://localhost:8000/api/documentation
```

## Observações Importantes

1. As anotações OpenAPI foram adicionadas a:
   - Controllers (ConvenioController, InstituicaoController, SimulacaoCreditoController)
   - Schemas (app/OpenApi/Schemas.php)
   - Controller base com informações gerais da API

2. Certifique-se de que os namespaces e imports estão corretos em todos os arquivos com anotações OpenAPI.

3. Se você encontrar erros ao gerar a documentação, verifique a sintaxe das anotações OpenAPI e os paths definidos.

4. Para adicionar autenticação à documentação (se necessário no futuro), consulte a documentação do L5-Swagger. 