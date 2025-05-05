#!/bin/bash

services=(
  "db-auth-service"
  "db-user-management-service"
  "db-activity-management-service"
  "db-matching-service"
  "db-monev-service"
  "db-monitoring-service"
  "db-registration-service"
  "db-calendar-service"
  "db-report-service"
)

for service in "${services[@]}"; do
  echo "===== Checking databases in $service ====="
  docker exec $service psql -U postgres -c "\l"
  echo ""
done