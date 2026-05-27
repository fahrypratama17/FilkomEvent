FROM php:8.4-cli

RUN apt-get update && apt-get install -y \
    git unzip curl zip libpq-dev libzip-dev nodejs npm \
    && docker-php-ext-install pdo pdo_pgsql zip

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY . .

# bersihkan build lama
RUN rm -rf node_modules public/build

# install dependency
RUN composer install --no-dev --optimize-autoloader

# install node modules
RUN npm install

# build vite
RUN npm run build

# clear cache
RUN php artisan optimize:clear || true

# migrate database
RUN php artisan migrate --force

# optional seeder
RUN php artisan db:seed --force

EXPOSE 8080

CMD php artisan serve --host=0.0.0.0 --port=8080
