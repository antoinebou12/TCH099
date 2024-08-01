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
    docker-php-ext-install zip pdo pdo_mysql && \
    a2enmod rewrite headers && \
    apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html/

# Copy application source
COPY . .

# Install PHP dependencies
RUN composer install --no-interaction --no-progress --prefer-dist

# Set up Python virtual environment and install dependencies
RUN python3 -m venv /opt/venv && \
    /opt/venv/bin/pip install --upgrade pip && \
    /opt/venv/bin/pip install mysql-connector-python python-dotenv

# Expose port 80
EXPOSE 80

# Activate virtual environment for all following commands
ENV PATH="/opt/venv/bin:$PATH"