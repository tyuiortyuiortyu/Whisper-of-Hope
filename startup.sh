#!/bin/bash
set -e

echo "🚀 Starting Laravel application deployment..."

# Navigate to Laravel directory
cd Whisper-of-Hope

# Set essential environment variables if missing
export APP_ENV=${APP_ENV:-production}
export APP_DEBUG=${APP_DEBUG:-true}
export LOG_CHANNEL=${LOG_CHANNEL:-stderr}
export SESSION_DRIVER=${SESSION_DRIVER:-database}
export CACHE_STORE=${CACHE_STORE:-database}

echo "📋 Current environment variables:"
echo "APP_ENV: $APP_ENV"
echo "APP_DEBUG: $APP_DEBUG"
echo "DB_CONNECTION: $DB_CONNECTION"
echo "LOG_CHANNEL: $LOG_CHANNEL"

# Generate application key if not exists
echo "🔑 Generating application key..."
php artisan key:generate --force --no-interaction

# Clear all caches first
echo "🧹 Clearing caches..."
php artisan config:clear || echo "Config clear failed"
php artisan cache:clear || echo "Cache clear failed"
php artisan route:clear || echo "Route clear failed"
php artisan view:clear || echo "View clear failed"

# Test database connection
echo "🗄️ Testing database connection..."
php artisan db:show || echo "Warning: Database connection failed"

# Test if models are working
echo "🔍 Testing models..."
php artisan tinker --execute="App\Models\Story::count(); echo 'Stories model OK';" || echo "Warning: Story model issue"
php artisan tinker --execute="App\Models\Category::count(); echo 'Category model OK';" || echo "Warning: Category model issue"

# Run migrations
echo "📊 Running database migrations..."
php artisan migrate --force

# Seed database
echo "🌱 Seeding database..."
php artisan db:seed --force

# Optimize for production only if not debugging
if [ "$APP_DEBUG" = "false" ]; then
    echo "⚡ Optimizing application..."
    php artisan config:cache
    php artisan route:cache
    php artisan view:cache
else
    echo "🔧 Skipping optimization (debug mode)"
fi

# Start the server
echo "🌐 Starting web server on port $PORT..."
php -S 0.0.0.0:$PORT -t public
