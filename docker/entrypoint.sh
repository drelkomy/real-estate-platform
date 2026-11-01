#!/bin/sh
set -e

echo "🚀 Starting Real Estate Platform Container..."

# Ensure required directories exist
mkdir -p \
    /var/www/html/storage/framework/sessions \
    /var/www/html/storage/framework/views \
    /var/www/html/storage/framework/cache \
    /var/www/html/storage/logs \
    /var/www/html/storage/app/public \
    /var/www/html/bootstrap/cache \
    /var/log/supervisor

chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Re-create storage symlink cleanly
rm -f /var/www/html/public/storage
php /var/www/html/artisan storage:link || ln -sf /var/www/html/storage/app/public /var/www/html/public/storage

# Ensure APP_KEY is present
if [ -z "$APP_KEY" ]; then
    echo "Notice: Generating APP_KEY..."
    php /var/www/html/artisan key:generate --force
fi

# Wait for database if configured
if [ -n "$DB_HOST" ]; then
    echo "⏳ Checking database connection ($DB_HOST)..."
    MAX_RETRIES=20
    RETRY_COUNT=0
    until php /var/www/html/artisan db:show --json 2>/dev/null | grep -q "tables\|name" || [ $RETRY_COUNT -ge $MAX_RETRIES ]; do
        echo "Waiting for database at $DB_HOST:${DB_PORT:-3306}... ($RETRY_COUNT/$MAX_RETRIES)"
        sleep 2
        RETRY_COUNT=$((RETRY_COUNT+1))
    done
    if [ $RETRY_COUNT -ge $MAX_RETRIES ]; then
        echo "⚠️ Database connection wait timed out. Proceeding..."
    else
        echo "✅ Database connection established!"
    fi
fi

# Run database migrations
if [ "${RUN_MIGRATIONS:-true}" = "true" ]; then
    echo "📦 Running database migrations..."
    php /var/www/html/artisan migrate --force || true
fi

# Wait for Redis if configured
if [ -n "$REDIS_HOST" ]; then
    echo "⏳ Checking Redis connection ($REDIS_HOST)..."
    for i in $(seq 1 10); do
        if redis-cli -h "$REDIS_HOST" -p "${REDIS_PORT:-6379}" ${REDIS_PASSWORD:+-a "$REDIS_PASSWORD"} ping 2>/dev/null | grep -q "PONG"; then
            echo "✅ Redis ready!"
            break
        fi
        sleep 1
    done
fi

# Optimization and Caching for local vs production
if [ "${APP_ENV:-production}" = "production" ] && [ "${LARAVEL_CACHE:-true}" = "true" ]; then
    echo "⚡ Caching configuration, routes, and views for production..."
    php /var/www/html/artisan config:cache  || true
    php /var/www/html/artisan route:cache   || true
    php /var/www/html/artisan view:cache    || true
else
    echo "🧹 Development environment: clearing cached files..."
    php /var/www/html/artisan optimize:clear || true
fi

echo ""
echo "🌟 Container initialization complete. Handing over to Supervisor..."
exec "$@"
