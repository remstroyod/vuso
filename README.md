## Установка проекта

Проект разделен на 2 части, Backend и Frontend.
1. Для Frontend используем основной домен: example.com
2. Для Backend используем sub домен: admin.example.com
3. .env файлы конфигураций должны быть в корне папок Backend и Frontend
4. php artisan migrate
5. php admartisan migrate
6. php artisan db:seed --force
---

## Команды

1. Для Backend выполнения команд используем приставку **adm**, например: php admartisan cache:clear и т.д.
2. Для Frontend выполнения команд все стандартно, без приставки **adm**
