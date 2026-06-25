## About

thrun_laravel example project

## Run

cp .env.example .env
insert key
APP_KEY=base64:cwQW3ENmiR+h2o1b6p2IjYbfuVTKRz8W+e4NSNnk0ss=

docker compose up -d
docker compose exec app php artisan thrun:benchmark:dispatch io 10
docker compose exec app php artisan thrun:email:dispatch 1
