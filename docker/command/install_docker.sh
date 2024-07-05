#!/bin/bash

# Colors for output
YELLOW='\033[1;33m'
GREEN='\033[0;32m'
NC='\033[0m' # No Color

# Check if `docker` is installed, if not then install it
docker_installed=$(which docker)
if [ -z "$docker_installed" ]; then
    echo -e "${YELLOW}[process] Installing Docker...${NC}"
    sudo apt-get install apt-transport-https ca-certificates software-properties-common -y
    sudo curl -fsSL https://download.docker.com/linux/ubuntu/gpg | sudo apt-key add -
    sudo add-apt-repository "deb [arch=amd64] https://download.docker.com/linux/ubuntu $(lsb_release -cs) stable"
    sudo apt-get update
    sudo apt-get install docker-ce -y
else
    echo -e "${GREEN}[check] Docker is already installed.${NC}"
fi
