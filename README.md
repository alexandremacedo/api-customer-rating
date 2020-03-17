<h1 align="center">
  <img alt="GoBarber" title="GoBarber" src=".github/icon.png" width="120px" />
</h1>

<h3 align="center">
  Rating API
</h3>

<h4 align="center">
  Backend + PHP + Lumen
</h4>

<p align="center">
  <img alt="GitHub language count" src="https://img.shields.io/github/languages/count/AlexandreMacedoo/api-customer-rating?color=%2304D361">

  <a href="https://github.com/AlexandreMacedoo">
    <img alt="Made by Alexandre" src="https://img.shields.io/badge/made%20by-Alexandre-%2304D361">
  </a>

  <img alt="License" src="https://img.shields.io/badge/license-MIT-%2304D361">

  <a href="https://github.com/AlexandreMacedoo/api-customer-rating/stargazers">
    <img alt="Stargazers" src="https://img.shields.io/github/stars/AlexandreMacedoo/api-customer-rating?style=social">
  </a>
</p>

<p align="center">
  <a href="#pré-requisitos">Pré requisitos</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
  <a href="#instalação">Instalação</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
  <a href="#endpoints">Endpoints</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
  <a href="#consulte-a-documentação">Documentação</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
  <a href="#license">Licença</a>
</p>

# api-customer-rating

API para medir o nível de satisfação de clientes

# Pré requisitos

- Git (https://git-scm.com/)
- Composer (https://getcomposer.org/)
- Docker (https://www.docker.com/)

# Instalação
### Clonando o repositório

Com o Git instalado em sua sua máquina, abra o terminal. 
Windows -> **cmd** ou **powershell** execute os comandos abaixo:
```ssh
$ git clone https://github.com/AlexandreMacedoo/api-customer-rating.git
$ cd api-customer-rating
```

### Docker
Com o docker instalado e configurado em sua máquina, execute os comandos abaixo:

```ssh
$ docker-compose up -d --build
$ docker exec -it api-customer-rating_app_1 bash
$ composer install
$ php artisan migrate
```

### Acesse a API

(http://localhost:8000)

# Endpoints

Rotas disponíveis:

Verb | Path | Controller | Action 
--- | --- | --- | --- 
GET    | /clients                           | \app\Http\Controllers\ClientsController                | all        
POST   | /clients                           | \app\Http\Controllers\ClientsController                | store      
GET    | /clients/{id}                      | \app\Http\Controllers\ClientsController                | index      
PUT    | /clients/{id}                      | \app\Http\Controllers\ClientsController                | update     
DELETE | /clients/{id}                      | \app\Http\Controllers\ClientsController                | destroy    
GET    | /contributors                      | \app\Http\Controllers\ContributorsController           | all        
POST   | /contributors                      | \app\Http\Controllers\ContributorsController           | store      
GET    | /contributors/{id}                 | \app\Http\Controllers\ContributorsController           | index      
PUT    | /contributors/{id}                 | \app\Http\Controllers\ContributorsController           | update     
DELETE | /contributors/{id}                 | \app\Http\Controllers\ContributorsController           | destroy    
GET    | /stores                            | \app\Http\Controllers\StoresController                 | all        
POST   | /stores                            | \app\Http\Controllers\StoresController                 | store      
GET    | /stores/{id}                       | \app\Http\Controllers\StoresController                 | index      
PUT    | /stores/{id}                       | \app\Http\Controllers\StoresController                 | update     
DELETE | /stores/{id}                       | \app\Http\Controllers\StoresController                 | destroy    
GET    | /ratings                           | \app\Http\Controllers\RatingsController                | all        
POST   | /ratings                           | \app\Http\Controllers\RatingsController                | store      
GET    | /ratings/{id}                      | \app\Http\Controllers\RatingsController                | index      
GET    | /transactions                      | \app\Http\Controllers\TransactionsController           | all        
POST   | /transactions                      | \app\Http\Controllers\TransactionsController           | store      
GET    | /transactions/{id}                 | \app\Http\Controllers\TransactionsController           | index 
PUT    | /transactions/{id}                 | \app\Http\Controllers\TransactionsController           | update     

# Consulte a documentação
[Documentação da API](https://app.swaggerhub.com/apis/AlexandreMacedoo/CUSTOMER_RATING_OAS3.0/1.0.0)

# License
The api-customer-rating is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
