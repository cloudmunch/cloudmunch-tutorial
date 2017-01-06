#!/bin/bash

BASEDIR=$(dirname "$0")
echo "Script location: ${BASEDIR}"
cd "${BASEDIR}"

#Install composer
if hash composer 2>/dev/null; then
    echo "Composer is available"
    composer install
    composer update
elif [ -f ./composer.phar ]; then
	echo "Composer is available locally"
	php composer.phar install
        php composer.phar update
else
	echo "Installing composer ..."
	curl -sS https://getcomposer.org/installer | php
	php composer.phar install
	php composer.phar update
fi
