FROM php:8.2-cli

# Install system dependencies
RUN apt-get update -y && apt-get install -y libpq-dev libpng-dev libzip-dev zip unzip git

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_pgsql gd zip pcntl bcmath

# Set working directory
WORKDIR /app

# Copy application files
COPY . /app

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install dependencies (ignoring scripts during installation)
RUN composer install --no-dev --optimize-autoloader --no-scripts

# Expose port (Render sets PORT env)
EXPOSE 8000

# Start script
CMD php artisan migrate --force && php artisan db:seed --class=ProductionSeeder --force && php artisan serve --host=0.0.0.0 --port=${PORT:=8000}
