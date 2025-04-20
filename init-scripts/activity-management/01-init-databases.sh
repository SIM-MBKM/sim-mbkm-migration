#!/bin/bash
set -e

echo "Creating databases for activity_management_service..."

psql -v ON_ERROR_STOP=1 --username "$POSTGRES_USER" --dbname "$POSTGRES_DB" << EOSQL
  CREATE DATABASE activity_management_service_dev;
  GRANT ALL PRIVILEGES ON DATABASE activity_management_service_dev TO $POSTGRES_USER;
  
  CREATE DATABASE activity_management_service_test;
  GRANT ALL PRIVILEGES ON DATABASE activity_management_service_test TO $POSTGRES_USER;
  
  CREATE DATABASE activity_management_service_staging;
  GRANT ALL PRIVILEGES ON DATABASE activity_management_service_staging TO $POSTGRES_USER;
EOSQL

echo "Databases for activity_management_service initialized successfully!"
