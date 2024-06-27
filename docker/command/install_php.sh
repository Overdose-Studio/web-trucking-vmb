#!/bin/bash

# Colors for output
YELLOW='\033[1;33m'
GREEN='\033[0;32m'
NC='\033[0m' # No Color

# Check if `php` is installed, if not then install it
php_installed=$(which php)
if [ -z "$php_installed" ]; then
    echo -e "${YELLOW}[process] Installing PHP...${NC}"
    sudo apt-get install php -y

    # Get PHP version
    php_version=$(php -v | grep -oP "PHP \K[0-9]+\.[0-9]+")

    # Install required PHP extensions 
    echo -e "${YELLOW}[process] Installing PHP extensions...${NC}"
    sudo apt-get install php${php_version}-opcache php${php_version}-curl php${php_version}-common php${php_version}-dom php${php_version}-gd php${php_version}-zip -y
else
    echo -e "${GREEN}[check] PHP is already installed.${NC}"
fi
