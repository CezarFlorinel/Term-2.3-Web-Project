FROM php:fpm

# Install gnupg for adding the Microsoft key
RUN apt-get update && apt-get install -y gnupg2

# Add the Microsoft repository GPG keys and repository
RUN curl https://packages.microsoft.com/keys/microsoft.asc | gpg --dearmor > /usr/share/keyrings/microsoft-archive-keyring.gpg \
    && echo "deb [arch=amd64 signed-by=/usr/share/keyrings/microsoft-archive-keyring.gpg] https://packages.microsoft.com/debian/12/prod bookworm main" > /etc/apt/sources.list.d/mssql-release.list

# Install required packages and PHP extensions
RUN apt-get update \
    && ACCEPT_EULA=Y apt-get install -y --no-install-recommends msodbcsql17 mssql-tools unixodbc-dev \
    && pecl install sqlsrv pdo_sqlsrv \
    && docker-php-ext-enable sqlsrv pdo_sqlsrv

# Install Composer globally
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer


# Install system dependencies for Composer, zip extension, and other necessary tools
RUN apt-get update && \
    apt-get install -y git unzip libzip-dev && \
    docker-php-ext-install zip

# Install GD dependencies and enable the GD extension
RUN apt-get update -y && apt-get install -y zlib1g-dev libpng-dev libfreetype6-dev libjpeg62-turbo-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd


# Install TCPDF using Composer
RUN composer require tecnickcom/tcpdf

# Cleanup to reduce image size
RUN rm -rf /var/lib/apt/lists/*

# Uncomment if you want to install xdebug
# RUN pecl install xdebug && docker-php-ext-enable xdebug