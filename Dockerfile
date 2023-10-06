FROM richarvey/nginx-php-fpm:3.1.4

COPY . .

# Image config
ENV SKIP_COMPOSER 1
ENV WEBROOT /var/www/html/public
ENV PHP_ERRORS_STDERR 1
ENV RUN_SCRIPTS 1
ENV REAL_IP_HEADER 1

# Laravel config
ENV APP_ENV production
ENV APP_DEBUG false
ENV DB_CONNECTION mysql
ENV DB_HOST aws.connect.psdb.cloud
ENV DB_PORT 3306
ENV DB_DATABASE ecom-db
ENV DB_USERNAME 7c6xsr4o0qq8xbtjxtzw
ENV DB_PASSWORD pscale_pw_Lu8ZULv3Ga2AxfIkAHxe75tIOaqgCroZ5K7qLFSGqPa
ENV MYSQL_ATTR_SSL_CA cacert-2023-08-22.pem

# Allow composer to run as root
ENV COMPOSER_ALLOW_SUPERUSER 1

CMD ["/start.sh"]