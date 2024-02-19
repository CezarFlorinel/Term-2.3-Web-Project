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

# Uncomment if you want to install xdebug
# RUN pecl install xdebug && docker-php-ext-enable xdebug