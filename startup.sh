#!/bin/bash
set -e

echo "🚀 Starting Laravel application deployment..."

# Navigate to Laravel directory
cd Whisper-of-Hope

# Set essential environment variables if missing
export APP_ENV=${APP_ENV:-production}
export APP_DEBUG=${APP_DEBUG:-false}
export LOG_CHANNEL=${LOG_CHANNEL:-stderr}
export SESSION_DRIVER=${SESSION_DRIVER:-database}
export CACHE_STORE=${CACHE_STORE:-database}

# Generate application key if not exists
echo "🔑 Generating application key..."
php artisan key:generate --force --no-interaction

# Clear all caches first
echo "🧹 Clearing caches..."
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

# Test database connection
echo "🗄️ Testing database connection..."
php artisan db:show || echo "Warning: Database connection failed"

# Run migrations
echo "📊 Running database migrations..."
php artisan migrate --force

# Seed database
echo "🌱 Seeding database..."
php artisan db:seed --force

# Optimize for production
echo "⚡ Optimizing application..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Start the server
echo "🌐 Starting web server on port $PORT..."
php -S 0.0.0.0:$PORT -t public
