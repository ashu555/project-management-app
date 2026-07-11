#!/bin/sh
set -e

cd /var/www/html

if [ ! -f .env ]; then
    echo "Creating .env from .env.example..."
    cp .env.example .env
fi

# Align .env with Docker MySQL service defaults.
sed -i 's/^DB_CONNECTION=.*/DB_CONNECTION=mysql/' .env
sed -i 's/^# DB_HOST=.*/DB_HOST=mysql/' .env
sed -i 's/^DB_HOST=.*/DB_HOST=mysql/' .env
sed -i 's/^# DB_PORT=.*/DB_PORT=3306/' .env
sed -i 's/^DB_PORT=.*/DB_PORT=3306/' .env
sed -i 's/^# DB_DATABASE=.*/DB_DATABASE=project_management/' .env
sed -i 's/^DB_DATABASE=.*/DB_DATABASE=project_management/' .env
sed -i 's/^# DB_USERNAME=.*/DB_USERNAME=sail/' .env
sed -i 's/^DB_USERNAME=.*/DB_USERNAME=sail/' .env
sed -i 's/^# DB_PASSWORD=.*/DB_PASSWORD=password/' .env
sed -i 's/^DB_PASSWORD=.*/DB_PASSWORD=password/' .env

if [ -z "${APP_URL}" ]; then
    sed -i 's|^APP_URL=.*|APP_URL=http://localhost:8000|' .env
else
    sed -i "s|^APP_URL=.*|APP_URL=${APP_URL}|" .env
fi

if ! grep -q '^DB_HOST=' .env; then
    printf '\nDB_HOST=mysql\nDB_PORT=3306\nDB_DATABASE=project_management\nDB_USERNAME=sail\nDB_PASSWORD=password\n' >> .env
fi

echo "Installing PHP dependencies..."
composer install --no-interaction --prefer-dist --optimize-autoloader

if ! grep -q '^APP_KEY=base64:' .env; then
    echo "Generating application key..."
    php artisan key:generate --force
fi

echo "Waiting for MySQL..."
until php -r "new PDO(
    sprintf('mysql:host=%s;port=%s', getenv('DB_HOST') ?: 'mysql', getenv('DB_PORT') ?: '3306'),
    getenv('DB_USERNAME') ?: 'sail',
    getenv('DB_PASSWORD') ?: 'password'
);" 2>/dev/null; do
    sleep 2
done
echo "MySQL is ready."

echo "Running migrations..."
php artisan migrate --force

USER_COUNT=$(php artisan tinker --execute="echo \\App\\Models\\User::count();" 2>/dev/null | tr -d '\r' | tail -n 1)
if [ "${USER_COUNT}" = "0" ]; then
    echo "Seeding database with sample users, projects, and tasks..."
    php artisan db:seed --force
else
    echo "Database already has data (users=${USER_COUNT}); skipping seed."
fi

php artisan storage:link --force 2>/dev/null || true

echo "App ready at ${APP_URL:-http://localhost:8000}"
exec "$@"
