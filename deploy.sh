#!/bin/bash

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[1;34m'
NC='\033[0m' # No Color

# Show Greeting Message
echo -e "${BLUE}Welcome to Laravel 9.x Deployment Script${NC}"

# Ask application name, port, server name, and email
read -p "Enter your application name: " app_name
read -p "Enter the HTTP port number: " port_http
read -p "Enter the HTTPS port number: " port_https
read -p "Enter the server name: " server_name
read -p "Enter your email address: " email

# Run deployment configuration script
./docker/command/deploy_config.sh $app_name $port_http $port_https $server_name $email

# Run all installation scripts
./docker/command/install_curl.sh
./docker/command/install_nginx.sh
./docker/command/install_docker.sh
./docker/command/install_certbot.sh

# Run Laravel deployment script
./docker/command/deploy_laravel.sh
./docker/command/deploy_nginx.sh $app_name $port_http $port_https $server_name $email

# Show completion message
echo -e "${GREEN}[complete] Laravel 9.x deployment script finished.${NC}"
