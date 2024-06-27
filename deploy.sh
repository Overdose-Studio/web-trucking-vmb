#!/bin/bash

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[1;34m'
NC='\033[0m' # No Color

# Show Greeting Message
echo -e "${BLUE}Welcome to Laravel 9.x Deployment Script${NC}"

# Run deployment configuration script
./docker/command/deploy_config.sh

# Run all installation scripts
./docker/command/install_curl.sh
./docker/command/install_php.sh
./docker/command/install_composer.sh
./docker/command/install_npm.sh
./docker/command/install_nginx.sh
./docker/command/install_docker.sh

# Run Laravel deployment script
./docker/command/deploy_laravel.sh
./docker/command/deploy_nginx.sh

# Show completion message
echo -e "${GREEN}[complete] Laravel 9.x deployment script finished.${NC}"