#!/bin/bash

# Script to run all migrations for different services
echo "Starting migrations for all services..."

# Auth Service
echo "Migrating Auth Service..."
php artisan migrate:fresh --path=database/migrations/auth_management --database=auth_management
echo "Auth Service migration complete."

# User Management Service
echo "Migrating User Management Service..."
php artisan migrate:fresh --path=database/migrations/user_management --database=user_management
echo "User Management Service migration complete."

# Activity Management Service
echo "Migrating Activity Management Service..."
php artisan migrate:fresh --path=database/migrations/activity_management --database=activity_management
echo "Activity Management Service migration complete."

# Registration Management Service
echo "Migrating Registration Management Service..."
php artisan migrate:fresh --path=database/migrations/registration_management --database=registration_management
echo "Registration Management Service migration complete."

# Matching Management Service
echo "Migrating Matching Management Service..."
php artisan migrate:fresh --path=database/migrations/matching_management --database=matching_management
echo "Matching Management Service migration complete."

# Monitoring Management Service
echo "Migrating Monitoring Management Service..."
php artisan migrate:fresh --path=database/migrations/monitoring_management --database=monitoring_management
echo "Monitoring Management Service migration complete."

# Include Monev Service if needed
echo "Migrating Monev Service..."
php artisan migrate:fresh --path=database/migrations/monev_management --database=monev_management
echo "Monev Service migration complete."

# Include Calendar Service if needed
echo "Migrating Calendar Service..."
php artisan migrate:fresh --path=database/migrations/calendar_management --database=calendar_management
echo "Calendar Service migration complete."

# Include Report Service if needed
echo "Migrating Report Service..."
php artisan migrate:fresh --path=database/migrations/report_management --database=report_management

echo "All migrations completed successfully!"