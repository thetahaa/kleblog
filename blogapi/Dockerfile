# PHP-FPM 8.3 İmajını kullan 
FROM php:8.3-fpm 

# Laravel için gerekli bağımlılıkları yükle 
RUN apt-get update && apt-get install -y \ 
    build-essential \ 
    libpng-dev \ 
    libjpeg62-turbo-dev \ 
    libfreetype6-dev \ 
    libonig-dev \ 
    libicu-dev \
    libzip-dev \ 
    zip \ 
    unzip \ 
    git \ 
    curl \ 
    supervisor \ 
    && docker-php-ext-install pdo_mysql intl 

# Composer yükle (PHP bağımlılık yöneticisi) 
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer 

# Çalışma dizini oluştur 
WORKDIR /var/www 

# PHP genişletmelerini ayarla 
RUN docker-php-ext-install pdo pdo_mysql mbstring zip exif pcntl 
RUN sed -i 's/listen = .*/listen = 9000/' /usr/local/etc/php-fpm.d/www.conf

# # Node.js ve npm'i yükle 
# RUN curl -fsSL https://deb.nodesource.com/setup_16.x | bash - && \ 
#     apt-get install -y nodejs && \ 
#     apt-get clean && \ 
#     rm -rf /var/lib/apt/lists/* 

# Uygulama için 8080 portunu expose edelim 
EXPOSE 8000 

# Laravel uygulamasını çalıştıracak başlangıç komutu (opsiyonel)
CMD ["php-fpm"]