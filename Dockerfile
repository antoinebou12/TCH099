FROM php:8.1-apache

# Install system dependencies
RUN apt-get update && \
    apt-get install -y \
    libzip-dev \
    zip \
    gnupg2 \
    unixodbc-dev \
    git \
    libssl-dev \
    default-mysql-client \
    python3 \
    python3-pip \
    python3-venv && \
    docker-php-ext-install zip && \
    a2enmod rewrite headers && \
    apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html/

# Copy application source
COPY . .

# Expose port 80
EXPOSE 80
