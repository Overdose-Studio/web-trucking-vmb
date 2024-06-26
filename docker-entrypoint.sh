#!/bin/sh

# Run Laravel migrations
echo "Running migrations..."
php artisan migrate

# Seed the database
echo "Running seeders..."
php artisan db:seed

# Create storage link
echo "Creating storage link..."
php artisan storage:link

# Execute the main container command
exec "$@"
