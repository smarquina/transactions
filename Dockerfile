FROM bitnami/laravel
COPY . .
ENV APP_NAME="transactions-demo" \
    APP_DEBUG="false" \
    APP_URL="localhost:3000" \
    DB_DATABASE="transactions" \
    DB_USERNAME="transactions" \
    DB_PASSWORD="transactions" \
    CACHE_DRIVER="redis"
