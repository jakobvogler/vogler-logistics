#!/usr/bin/env bash

echo "setenv MYSQL_URL ${MYSQL_URL}" >> /etc/apache2/apache2.conf
echo "setenv DB_NAME ${DB_NAME}" >> /etc/apache2/apache2.conf
echo "setenv ADMIN_USERNAME ${ADMIN_USERNAME}" >> /etc/apache2/apache2.conf
echo "setenv ADMIN_PASSWORD ${ADMIN_PASSWORD}" >> /etc/apache2/apache2.conf
echo "setenv CUSTOMER_USERNAME ${CUSTOMER_USERNAME}" >> /etc/apache2/apache2.conf
echo "setenv CUSTOMER_PASSWORD ${CUSTOMER_PASSWORD}" >> /etc/apache2/apache2.conf

exec apache2-foreground
