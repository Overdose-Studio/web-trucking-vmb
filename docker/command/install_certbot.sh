#!/bin/bash

# Colors for output
YELLOW='\033[1;33m'
GREEN='\033[0;32m'
NC='\033[0m' # No Color

# Check if `certbot` is installed, if not then install it
certbot_installed=$(which certbot)
if [ -z "$certbot_installed" ]; then
    echo -e "${YELLOW}[process] Installing Certbot...${NC}"
    sudo apt-get install certbot python3-certbot-nginx -y
else
    echo -e "${GREEN}[check] Certbot is already installed.${NC}"
fi
