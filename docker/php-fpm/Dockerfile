FROM mahradbt/php-fpm:8.3

# PHP-FPM defaults
ENV PHP_FPM_PM="dynamic"
ENV PHP_FPM_MAX_CHILDREN="25"
ENV PHP_FPM_START_SERVERS="8"
ENV PHP_FPM_MIN_SPARE_SERVERS="4"
ENV PHP_FPM_MAX_SPARE_SERVERS="10"
ENV PHP_FPM_MAX_REQUESTS="5000"

ENV UPLOAD_MAX_FILESIZE="40M"
ENV POST_MAX_SIZE="40M"

RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"
RUN echo "extension=mongodb.so" >> "$PHP_INI_DIR/php.ini"
RUN echo "extension=timezonedb.so" >> "$PHP_INI_DIR/php.ini"

# Set working directory
WORKDIR /var/www

EXPOSE 9000
CMD ["php-fpm"]
