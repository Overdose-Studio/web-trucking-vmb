#!/bin/bash

# Colors for output
YELLOW='\033[1;33m'
GREEN='\033[0;32m'
RED='\033[0;31m'
NC='\033[0m' # No Color

# Ask application name, port, server name, and email
read -p "Enter your application name: " app_name
read -p "Enter the port number: " port
read -p "Enter the server name: " server_name
read -p "Enter your email address: " email

# Format application name to kebab-case
app_name=$(echo "$app_name" | tr '[:upper:]' '[:lower:]' | tr -s ' ' '-' | tr -s '_' '-')

# Remove any characters that are not letters, numbers, or hyphens
app_name=$(echo "$app_name" | tr -cd '[:alnum:]-')

# Update the docker-compose.yaml file
echo -e "${YELLOW}[process] Setting up Docker Compose...${NC}"
sed -i "s|<name>|$app_name|g" docker-compose.yaml
sed -i "s|<port>|$port|g" docker-compose.yaml

# Update the Nginx configuration file
echo -e "${YELLOW}[process] Setting up Nginx...${NC}"
sed -i "s|<port>|$port|g" docker/nginx/app.conf
sed -i "s|<server_name>|$server_name|g" docker/nginx/app.conf

# Copy the Nginx configuration file to the Nginx sites-available directory
echo -e "${YELLOW}[process] Move Nginx Configuration...${NC}"
sudo cp docker/nginx/app.conf /etc/nginx/sites-available/$app_name.conf

# Create a symbolic link to the Nginx sites-enabled directory
echo -e "${YELLOW}[process] Create Nginx Symbolic Link...${NC}"
sudo ln -s /etc/nginx/sites-available/$app_name.conf /etc/nginx/sites-enabled/
