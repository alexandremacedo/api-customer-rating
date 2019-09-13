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

### Configure o docker 

- Docker for Mac (https://docs.docker.com/docker-for-mac/)
- Docker for Linux (https://docs.docker.com/engine/installation/linux/)
- Docker for Windows (https://docs.docker.com/docker-for-windows/)

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

# Consulte a documentação

- Documentação da API (https://drive.google.com/open?id=1Mh3dkwE2lwueBwFOhzF1Xm4ciqYz4ZEU)

# License
The api-customer-rating is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).