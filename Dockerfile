FROM php:7.3
RUN apt-get update \
  && apt-get install -y --no-install-recommends \
    git \
    iputils-ping \
    libicu-dev \
    libxml2-dev \
    libxslt-dev \
    libzip-dev \
    vim \
    wget \
    zlib1g-dev \
  && rm -rf /var/lib/apt/lists/*
RUN docker-php-ext-configure pdo_mysql --with-pdo-mysql \
	&& docker-php-ext-configure mbstring --enable-mbstring \
    && docker-php-ext-install pdo_mysql \
    && docker-php-ext-install opcache \
    intl \
    mbstring \
    xml \
    xsl \
    zip
RUN curl -sS https://getcomposer.org/installer | php -- \
    --install-dir=/usr/bin \
    --filename=composer

