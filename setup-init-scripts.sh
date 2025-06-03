#!/bin/bash
set -e

# Remove any existing init scripts to start fresh
rm -rf init-scripts
mkdir -p init-scripts/{auth,user-management,activity-management,matching-management,monev-management,monitoring-management,registration-management,calendar-management,report-management,notification}

# Function to create init script for a service
create_init_script() {
  local service_dir=$1
  local db_name=$2
  
  cat > "init-scripts/$service_dir/01-init-databases.sh" << EOF
#!/bin/bash
set -e

echo "Creating databases for ${db_name}..."

psql -v ON_ERROR_STOP=1 --username "\$POSTGRES_USER" --dbname "\$POSTGRES_DB" << EOSQL
  CREATE DATABASE ${db_name}_dev;
  GRANT ALL PRIVILEGES ON DATABASE ${db_name}_dev TO \$POSTGRES_USER;
  
  CREATE DATABASE ${db_name}_test;
  GRANT ALL PRIVILEGES ON DATABASE ${db_name}_test TO \$POSTGRES_USER;
  
  CREATE DATABASE ${db_name}_staging;
  GRANT ALL PRIVILEGES ON DATABASE ${db_name}_staging TO \$POSTGRES_USER;
EOSQL

echo "Databases for ${db_name} initialized successfully!"
EOF

  # Make the script executable
  chmod +x "init-scripts/$service_dir/01-init-databases.sh"
  echo "Created init script for $service_dir"
}

# Create init scripts for each service with correct database names
create_init_script "auth" "auth_service"
create_init_script "user-management" "user_service" 
create_init_script "activity-management" "activity_service"
create_init_script "matching-management" "matching_service"
create_init_script "monev-management" "monev_service"
create_init_script "monitoring-management" "monitoring_service"
create_init_script "registration-management" "registration_service"
create_init_script "calendar-management" "calendar_service"
create_init_script "report-management" "report_service"
create_init_script "notification" "notification_service"

echo "All initialization scripts have been created!"
echo "To apply these changes:"
echo "1. Run: docker-compose down -v"
echo "2. Then: docker-compose up -d"
echo "This will recreate the containers and volumes with the correct database initialization."