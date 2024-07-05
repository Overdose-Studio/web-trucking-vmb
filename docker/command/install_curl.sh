#!/bin/bash

# Colors for output
YELLOW='\033[1;33m'
GREEN='\033[0;32m'
NC='\033[0m' # No Color

# Check if `curl` is installed, if not then install it
curl_installed=$(which curl)
if [ -z "$curl_installed" ]; then
    echo -e "${YELLOW}[process] Installing cURL...${NC}"
    sudo apt-get install curl -y
else
    echo -e "${GREEN}[check] cURL is already installed.${NC}"
fi
