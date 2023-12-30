#!/bin/bash

# Provide docker environment variables
printenv > /etc/environment

# Create installation log file
log_file="/var/log/php/installation.log"
touch "$log_file"

# Report about start installation to log file
echo "Composer start to install dependencies" >> "$log_file"
# Install composer dependencies
composer install
# Report about finished installation to log file
echo "Composer finished to install dependencies" >> "$log_file"

# Allow php-fpm to write to storage folder
chown www-data:www-data -R /app/storage
chmod 775 -R /app/storage

# Allow php-fpm to write to logs
chown www-data:www-data /var/log/php
chmod 775 /var/log/php

# Report about end of entrypoint.sh to log file
echo "Entrypoint.sh finished" >> "$log_file"

# Run original entrypoint
docker-php-entrypoint php-fpm
