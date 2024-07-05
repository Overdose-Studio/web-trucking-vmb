#!/bin/bash

# Colors for output
YELLOW='\033[1;33m'
GREEN='\033[0;32m'
RED='\033[0;31m'
NC='\033[0m' # No Color

# Create Docker Container
echo -e "${YELLOW}[process] Creating Docker Container...${NC}"
docker compose up -d

# Install Laravel Dependencies
echo -e "${YELLOW}[process] Installing Laravel Dependencies...${NC}"
docker compose exec app composer install --no-interaction

# Generate Laravel Key
echo -e "${YELLOW}[process] Generating Laravel Key...${NC}"
docker compose exec app php artisan key:generate

# Generate storage link
echo -e "${YELLOW}[process] Generating Storage Link...${NC}"
docker compose exec app php artisan storage:link

# Ask to run migrations
read -p "Do you want to run migrations? (y/n): " run_migrations
if [ "$run_migrations" == "y" ]; then
    echo -e "${YELLOW}[process] Running Migrations...${NC}"
    docker compose exec app php artisan migrate
else
    echo -e "${RED}[skip] Migrations not run.${NC}"
fi

# Ask to run seeders
read -p "Do you want to run seeders? (y/n): " run_seeders
if [ "$run_seeders" == "y" ]; then
    echo -e "${YELLOW}[process] Running Seeders...${NC}"
    docker compose exec app php artisan db:seed
else
    echo -e "${RED}[skip] Seeders not run.${NC}"
fi