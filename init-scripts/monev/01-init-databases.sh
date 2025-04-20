#!/bin/bash
set -e

echo "Creating databases for monev_service..."

psql -v ON_ERROR_STOP=1 --username "$POSTGRES_USER" --dbname "$POSTGRES_DB" << EOSQL
  CREATE DATABASE monev_service_dev;
  GRANT ALL PRIVILEGES ON DATABASE monev_service_dev TO $POSTGRES_USER;
  
  CREATE DATABASE monev_service_test;
  GRANT ALL PRIVILEGES ON DATABASE monev_service_test TO $POSTGRES_USER;
  
  CREATE DATABASE monev_service_staging;
  GRANT ALL PRIVILEGES ON DATABASE monev_service_staging TO $POSTGRES_USER;
EOSQL

echo "Databases for monev_service initialized successfully!"
