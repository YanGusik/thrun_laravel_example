FROM trueasync/php-true-async:latest

RUN apt-get update && apt-get install -y \
    build-essential autoconf libtool curl git unzip \
    && rm -rf /var/lib/apt/lists/*

# phpredis
RUN git clone --depth 1 --branch true-async https://github.com/true-async/phpredis.git /tmp/phpredis \
    && cd /tmp/phpredis \
    && phpize && ./configure && make -j$(nproc) && make install \
    && echo 'extension=redis.so' > /etc/php.d/redis.ini \
    && rm -rf /tmp/phpredis

# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app
COPY . .

RUN composer install --ignore-platform-reqs
