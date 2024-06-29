#!/bin/bash

# Colors for output
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

# Test Nginx configuration
echo -e "${YELLOW}[process] Testing Nginx Configuration...${NC}"
sudo nginx -t

# Restart Nginx
echo -e "${YELLOW}[process] Restarting Nginx...${NC}"
sudo systemctl restart nginx

# Generate SSL Certificate
echo -e "${YELLOW}[process] Generating SSL Certificate...${NC}"
sudo certbot --nginx -d $server_name -n -m $email --agree-tos
sudo systemctl restart nginx
