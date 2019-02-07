###Сборка docker + laravel + postgres

Для работы требуется PHP(7.2+), composer, docker

####Начало работы с нуля
* Устанавливаем и убеждаемся что работает php и composer. 
Прописываем пути в `$PATH`;
* Утсанавливаем ларку в композер глобально 
`composer global require "laravel/installer"`. 
Это нужно сделать один раз;
* Инициализация приложения в директории `laravel new blog`, где `blog` название проекта
* Копируем из этого репозитория файл `docker-compose.yml`, `.env` и папку `.docker`
* Делаем `composer update` и `npm install`
* Делаем `docker-compose up -d`. Должно работать.

####Из репозитория
* Качаем
* Делаем `composer update` и `npm install`
* Делаем `docker-compose up -d`. Должно работать.

####Что дальше?
* Соединение с БД прописывается в 'config/database'
* Интерфейс artisan (такой хелпер в ларке) запускать из среды.