# avtosklad

Установка проекта

1. git clone https://github.com/arnautdev/avtosklad.git

2. Создание базъ даннъх (CREATE SCHEMA `avtosklad` DEFAULT CHARACTER SET utf8;)

3. запустите composer install

4. Редактируйте файл phinx.yml необходимо добавить (хост, имя-БД, усер, пароль в development), так-же необходимо в AppModel добавить даннъе для подключение к БД

5. Запустите ./vendor/bin/phinx migrate

6. Откройте проект в браузере http://localhost/директория-проекта

7. Запустить сервер для апи php -S localhost:8000 -t api/ ету команду необходимо исполнить с root директории проекта.
