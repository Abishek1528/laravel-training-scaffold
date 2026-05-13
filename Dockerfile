FROM richarvey/nginx-php-fpm:3.1.6

COPY . /var/www/html

WORKDIR /var/www/html

# Install dependencies
RUN composer install --no-dev --optimize-autoloader

# Copy over the nginx config
COPY conf/nginx/nginx-site.conf /etc/nginx/sites-available/default.conf

# Add the deploy script
ADD scripts/00-laravel-deploy.sh /etc/my_init.d/00-laravel-deploy.sh
RUN chmod +x /etc/my_init.d/00-laravel-deploy.sh
