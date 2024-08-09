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
    a2enmod rewrite headers && \
    apt-get clean && rm -rf /var/lib/apt/lists/*

# Set working directory
WORKDIR /var/www/html/

# Copy application source
COPY . .

#enable mod rewrite
RUN a2enmod rewrite

# Expose port 80
EXPOSE 80
