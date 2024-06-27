#!/bin/bash

# Colors for output
YELLOW='\033[1;33m'
GREEN='\033[0;32m'
RED='\033[0;31m'
NC='\033[0m' # No Color

# Ask application name, port, and server name
read -p "Enter your application name: " app_name
read -p "Enter the port number: " port
read -p "Enter the server name: " server_name

# Format application name to snake case
app_name=$(echo $app_name | sed -r 's/[^a-zA-Z0-9]+/_/g' | tr -s '_' | tr A-Z a-z)

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
