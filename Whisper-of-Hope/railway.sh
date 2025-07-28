#!/bin/bash

echo "Starting Laravel application setup..."

# Clear caches
php artisan config:clear
php artisan cache:clear 2>/dev/null || echo "Cache clear skipped"
php artisan route:clear
php artisan view:clear

# Generate application key if not set
if [ -z "$APP_KEY" ]; then
    echo "Generating application key..."
    php artisan key:generate --force
fi

# Run database migrations
echo "Running database migrations..."
php artisan migrate --force

# Run database seeders
echo "Running database seeders..."
php artisan db:seed --force

# Cache configuration for production
echo "Caching configuration..."
php artisan config:cache

# Cache routes for production
echo "Caching routes..."
php artisan route:cache

# Cache views for production
echo "Caching views..."
php artisan view:cache

# Create storage link
echo "Creating storage link..."
php artisan storage:link

echo "Laravel setup completed successfully!"
