# Use an official PHP image as the base image
FROM php:8.0-cli

# Install system dependencies
RUN apt-get update \
    && apt-get install -y \
        git \
        unzip \
        curl \
        libpng-dev \
        libjpeg-dev \
        libfreetype6-dev \
    && rm -rf /var/lib/apt/lists/*

# Install Symfony CLI
RUN curl -sS https://get.symfony.com/cli/installer | bash
RUN mv /root/.symfony/* /usr/local/bin/
ENV PATH="${PATH}:/root/.symfony/bin"

# Install Node.js and npm
RUN curl -sL https://deb.nodesource.com/setup_14.x | bash -
RUN apt-get install -y nodejs

# Verify installation
RUN symfony --version
RUN node --version
RUN npm --version

# Set the working directory in the container
WORKDIR /app

# Copy the composer.json and composer.lock files to the container
COPY composer.json composer.lock ./

# Install PHP dependencies
RUN composer install --no-scripts --no-autoloader

# Copy the rest of the application code
COPY . .

# Install Symfony and npm dependencies
RUN symfony check:requirements
RUN npm install

# Expose port 8000
EXPOSE 8000

# Run Symfony server
CMD ["symfony", "server:start", "--port=8000", "--allow-http", "--no-tls"]
