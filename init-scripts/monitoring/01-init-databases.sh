#!/bin/bash
set -e

echo "Creating databases for monitoring_service..."

psql -v ON_ERROR_STOP=1 --username "$POSTGRES_USER" --dbname "$POSTGRES_DB" << EOSQL
  CREATE DATABASE monitoring_service_dev;
  GRANT ALL PRIVILEGES ON DATABASE monitoring_service_dev TO $POSTGRES_USER;
  
  CREATE DATABASE monitoring_service_test;
  GRANT ALL PRIVILEGES ON DATABASE monitoring_service_test TO $POSTGRES_USER;
  
  CREATE DATABASE monitoring_service_staging;
  GRANT ALL PRIVILEGES ON DATABASE monitoring_service_staging TO $POSTGRES_USER;
EOSQL

echo "Databases for monitoring_service initialized successfully!"
