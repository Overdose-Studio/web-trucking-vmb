#!/bin/bash

# Colors for output
YELLOW='\033[1;33m'
GREEN='\033[0;32m'
NC='\033[0m' # No Color

# Check if `npm` is installed, if not then install it
npm_installed=$(which npm)
if [ -z "$npm_installed" ]; then
    echo -e "${YELLOW}[process] Installing NPM...${NC}"
    sudo apt-get install nodejs -y
    sudo apt-get install npm -y
else
    echo -e "${GREEN}[check] NPM is already installed.${NC}"
fi
