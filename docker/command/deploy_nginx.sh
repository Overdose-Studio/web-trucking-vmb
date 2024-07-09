#!/bin/bash

# Colors for output
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

# Get parameters
app_name=$1
port_http=$2
port_https=$3
server_name=$4
email=$5

# Test Nginx configuration
echo -e "${YELLOW}[process] Testing Nginx Configuration...${NC}"
sudo nginx -t

# Restart Nginx
echo -e "${YELLOW}[process] Restarting Nginx...${NC}"
sudo systemctl restart nginx

# Generate SSL Certificate
echo -e "${YELLOW}[process] Generating SSL Certificate...${NC}"
sudo certbot --nginx --agree-tos -n -m $email -d $server_name

# Update Nginx configuration file ports
echo -e "${YELLOW}[process] Updating Nginx Configuration...${NC}"
sudo -i "s|http://localhost:$port_http|https://localhost:$port_http|g" /etc/nginx/sites-available/$app_name.conf

# Restart Nginx
sudo systemctl restart nginx