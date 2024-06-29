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
read -p "Enter the server name (SSL): " server_name
read -p "Enter your email address (SSL): " email
sudo certbot --nginx --agree-tos -n -m $email -d $server_name
sudo systemctl restart nginx
