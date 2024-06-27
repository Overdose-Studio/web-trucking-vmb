#!/bin/bash

# Colors for output
YELLOW='\033[1;33m'
GREEN='\033[0;32m'
NC='\033[0m' # No Color

# Check if `nginx` is installed, if not then install it
nginx_installed=$(which nginx)
if [ -z "$nginx_installed" ]; then
    echo -e "${YELLOW}[process] Installing Nginx...${NC}"
    sudo apt-get install nginx -y
    sudo systemctl start nginx
    sudo systemctl enable nginx
else
    echo -e "${GREEN}[check] Nginx is already installed.${NC}"
fi
