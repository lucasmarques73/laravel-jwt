<!-- # Setup Php 7.2 - Nginx - Composer - PostgreSQL - Adminer -->
# API - Laravel JWT L5 Repository

<!-- Containers
- my-php | php7.2-fpm
- my-nginx | nginx
- my-database | postgres
- my-adminer | adminer
- composer -->

Add in `/etc/hosts`
```
127.0.0.1   api.local
```

Up
```
docker-compose up -d --build
```

Down
```
docker-compose down
```

Composer Install
```
docker exec -it -u "$(id -u):$(id -g)" -w /api my-php composer install
```

Composer build - Migrate and Seed
```
docker exec -it -u "$(id -u):$(id -g)" -w /api my-php composer build
```