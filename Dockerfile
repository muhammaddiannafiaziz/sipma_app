FROM php:8.2-fpm

# 1. Install system dependencies (Linux libraries)
# libicu-dev penting untuk Filament (Format Tanggal/Uang)
# zip/unzip penting untuk Composer
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libzip-dev \
    libicu-dev

# 2. Clear cache agar image tidak bengkak
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# 3. Install PHP extensions yang Wajib untuk Laravel & Filament
RUN docker-php-ext-configure intl \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd intl zip

# 4. Install Composer (Manajer Paket PHP)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 5. Install Node.js & NPM (Wajib untuk Filament v4 / Vite)
# Kita pakai Node versi 20 (LTS - Long Term Support)
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs

# 6. Set working directory
WORKDIR /var/www