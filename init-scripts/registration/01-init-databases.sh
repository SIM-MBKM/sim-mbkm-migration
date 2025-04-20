#!/bin/bash
set -e

echo "Creating databases for registration_service..."

psql -v ON_ERROR_STOP=1 --username "$POSTGRES_USER" --dbname "$POSTGRES_DB" << EOSQL
  CREATE DATABASE registration_service_dev;
  GRANT ALL PRIVILEGES ON DATABASE registration_service_dev TO $POSTGRES_USER;
  
  CREATE DATABASE registration_service_test;
  GRANT ALL PRIVILEGES ON DATABASE registration_service_test TO $POSTGRES_USER;
  
  CREATE DATABASE registration_service_staging;
  GRANT ALL PRIVILEGES ON DATABASE registration_service_staging TO $POSTGRES_USER;
EOSQL

echo "Databases for registration_service initialized successfully!"
