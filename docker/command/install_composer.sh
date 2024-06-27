#!/bin/bash

# Colors for output
YELLOW='\033[1;33m'
GREEN='\033[0;32m'
NC='\033[0m' # No Color

# Check if `composer` is installed, if not then install it
composer_installed=$(which composer)
if [ -z "$composer_installed" ]; then
    echo -e "${YELLOW}[process] Installing Composer...${NC}"
    curl -sS https://getcomposer.org/installer -o composer-setup.php
    php composer-setup.php --install-dir=/usr/local/bin --filename=composer
    rm composer-setup.php
else
    echo -e "${GREEN}[check] Composer is already installed.${NC}"
fi
