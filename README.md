# Product Management API

Этот проект представляет собой API для управления продуктами. Он позволяет извлекать данные о продуктах из внешних API, сохранять и обновлять их в базе данных. Также API предоставляет возможность получения списка всех сохраненных продуктов.

## Установка и настройка

### Предварительные требования

- Установленный PHP (рекомендуется версия 8.0 и выше)
- Установленный Composer
- Установленный Laravel (рекомендуется версия 8.x и выше)
- Установленный MySQL 
- Установленный Docker

## Запуск 

```docker-compose up -d```

```php artisan serve```

## Эндпоинты API
Получение всех продуктов

### Метод: GET
URL: http://127.0.0.1:8000/api/products
Описание: Возвращает список всех продуктов, сохраненных в базе данных.
Получение и сохранение продуктов из API

### Метод: POST
URL: http://127.0.0.1:8000/api/fetch-and-save
Описание: Извлекает данные о продуктах из внешнего API и сохраняет их в базе данных. Возвращает сообщение об успешном сохранении и данные о сохраненных продуктах.

## Структура проекта
- app/Http/Controllers/ProductController.php - Контроллер для работы с продуктами.
- app/Models/Product.php - Модель продукта, определяющая структуру таблицы.
- database/migrations/ - Миграции для создания таблиц базы данных.
- routes/api.php - Определение маршрутов API.
