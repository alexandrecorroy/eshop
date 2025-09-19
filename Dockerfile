FROM php:5.6-apache

# Activer mod_rewrite
RUN a2enmod rewrite \
 && printf '<Directory /var/www/html/>\n    AllowOverride All\n    Require all granted\n</Directory>\n' > /etc/apache2/conf-available/allowoverride.conf \
 && a2enconf allowoverride

# Dépôts archivés + install minimal
RUN sed -i 's|deb.debian.org|archive.debian.org|g' /etc/apt/sources.list \
 && sed -i 's|security.debian.org|archive.debian.org|g' /etc/apt/sources.list \
 && sed -i '/stretch-updates/d' /etc/apt/sources.list \
 && apt-get update \
 && apt-get install -y --no-install-recommends --allow-unauthenticated zlib1g-dev \
 && rm -rf /var/lib/apt/lists/*

# Extensions PHP nécessaires
RUN docker-php-ext-install mysqli pdo pdo_mysql mbstring zip

WORKDIR /var/www/html

COPY . /var/www/html

EXPOSE 80
