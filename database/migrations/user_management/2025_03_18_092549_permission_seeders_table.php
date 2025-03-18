<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

return new class extends Migration
{
  protected $dbConn = 'user_management';
  protected $table = 'permissions';

  public function up()
  {
    $authService          = DB::connection($this->dbConn)->table('group_permissions')->where('name', 'auth_service')->first();
    $activityManagement   = DB::connection($this->dbConn)->table('group_permissions')->where('name', 'activity_management_service')->first();
    $userManagement       = DB::connection($this->dbConn)->table('group_permissions')->where('name', 'user_management_service')->first();
    $matchingService      = DB::connection($this->dbConn)->table('group_permissions')->where('name', 'matching_service')->first();
    $statisticService     = DB::connection($this->dbConn)->table('group_permissions')->where('name', 'statistic_service')->first();
    $exportImportService  = DB::connection($this->dbConn)->table('group_permissions')->where('name', 'export_import_service')->first();
    $registrationService  = DB::connection($this->dbConn)->table('group_permissions')->where('name', 'registration_service')->first();
    $monitorEvalService   = DB::connection($this->dbConn)->table('group_permissions')->where('name', 'monitoring_evaluation_service')->first();
    $consultApproval      = DB::connection($this->dbConn)->table('group_permissions')->where('name', 'consultation_approval_service')->first();
    $calendarService      = DB::connection($this->dbConn)->table('group_permissions')->where('name', 'calendar_service')->first();
    $permissions = [
      // Migration Service
      // [
      //     'id' => Str::uuid(),
      //     'group_permission_id' => $authService->id,
      //     'name' => 'migration_service.create.?', -- perlu migration service kh
      //     'created_at' => now(),
      //     'updated_at' => now(),
      // ],

      // Auth Service
      [
        'id' => Str::uuid(),
        'group_permission_id' => $authService->id,
        'name' => 'auth_service.create.users',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'id' => Str::uuid(),
        'group_permission_id' => $authService->id,
        'name' => 'auth_service.read.users',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'id' => Str::uuid(),
        'group_permission_id' => $authService->id,
        'name' => 'auth_service.update.users',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'id' => Str::uuid(),
        'group_permission_id' => $authService->id,
        'name' => 'auth_service.delete.users',
        'created_at' => now(),
        'updated_at' => now(),
      ],

      // User Management
      [
        'id' => Str::uuid(),
        'group_permission_id' => $userManagement->id,
        'name' => 'user_management.create.roles',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'id' => Str::uuid(),
        'group_permission_id' => $userManagement->id,
        'name' => 'user_management.read.roles',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'id' => Str::uuid(),
        'group_permission_id' => $userManagement->id,
        'name' => 'user_management.update.roles',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'id' => Str::uuid(),
        'group_permission_id' => $userManagement->id,
        'name' => 'user_management.delete.roles',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'id' => Str::uuid(),
        'group_permission_id' => $userManagement->id,
        'name' => 'user_management.create.users',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'id' => Str::uuid(),
        'group_permission_id' => $userManagement->id,
        'name' => 'user_management.read.users',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'id' => Str::uuid(),
        'group_permission_id' => $userManagement->id,
        'name' => 'user_management.update.users',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'id' => Str::uuid(),
        'group_permission_id' => $userManagement->id,
        'name' => 'user_management.delete.users',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'id' => Str::uuid(),
        'group_permission_id' => $userManagement->id,
        'name' => 'user_management.create.permissions',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'id' => Str::uuid(),
        'group_permission_id' => $userManagement->id,
        'name' => 'user_management.read.permissions',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'id' => Str::uuid(),
        'group_permission_id' => $userManagement->id,
        'name' => 'user_management.update.permissions',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'id' => Str::uuid(),
        'group_permission_id' => $userManagement->id,
        'name' => 'user_management.delete.permissions',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'id' => Str::uuid(),
        'group_permission_id' => $userManagement->id,
        'name' => 'user_management.create.group_permissions',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'id' => Str::uuid(),
        'group_permission_id' => $userManagement->id,
        'name' => 'user_management.read.group_permissions',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'id' => Str::uuid(),
        'group_permission_id' => $userManagement->id,
        'name' => 'user_management.update.group_permissions',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'id' => Str::uuid(),
        'group_permission_id' => $userManagement->id,
        'name' => 'user_management.delete.group_permissions',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'id' => Str::uuid(),
        'group_permission_id' => $userManagement->id,
        'name' => 'user_management.create.role_permissions',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'id' => Str::uuid(),
        'group_permission_id' => $userManagement->id,
        'name' => 'user_management.read.role_permissions',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'id' => Str::uuid(),
        'group_permission_id' => $userManagement->id,
        'name' => 'user_management.update.role_permissions',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'id' => Str::uuid(),
        'group_permission_id' => $userManagement->id,
        'name' => 'user_management.delete.role_permissions',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'id' => Str::uuid(),
        'group_permission_id' => $userManagement->id,
        'name' => 'user_management.create.user_permissions',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'id' => Str::uuid(),
        'group_permission_id' => $userManagement->id,
        'name' => 'user_management.read.user_permissions',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'id' => Str::uuid(),
        'group_permission_id' => $userManagement->id,
        'name' => 'user_management.update.user_permissions',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'id' => Str::uuid(),
        'group_permission_id' => $userManagement->id,
        'name' => 'user_management.delete.user_permissions',
        'created_at' => now(),
        'updated_at' => now(),
      ],

      //===== SOON ===== 
      // Activity Management
      [
        'id' => Str::uuid(),
        'group_permission_id' => $activityManagement->id,
        'name' => 'activity_management.create.activities',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'id' => Str::uuid(),
        'group_permission_id' => $activityManagement->id,
        'name' => 'activity_management.read.activities',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'id' => Str::uuid(),
        'group_permission_id' => $activityManagement->id,
        'name' => 'activity_management.update.activities',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'id' => Str::uuid(),
        'group_permission_id' => $activityManagement->id,
        'name' => 'activity_management.delete.activities',
        'created_at' => now(),
        'updated_at' => now(),
      ],

      // Matching Service
      [
        'id' => Str::uuid(),
        'group_permission_id' => $matchingService->id,
        'name' => 'matching_service.create.matches',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'id' => Str::uuid(),
        'group_permission_id' => $matchingService->id,
        'name' => 'matching_service.read.matches',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'id' => Str::uuid(),
        'group_permission_id' => $matchingService->id,
        'name' => 'matching_service.update.matches',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'id' => Str::uuid(),
        'group_permission_id' => $matchingService->id,
        'name' => 'matching_service.delete.matches',
        'created_at' => now(),
        'updated_at' => now(),
      ],

      // Statistic Service
      [
        'id' => Str::uuid(),
        'group_permission_id' => $statisticService->id,
        'name' => 'statistic_service.create.statistics',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'id' => Str::uuid(),
        'group_permission_id' => $statisticService->id,
        'name' => 'statistic_service.read.statistics',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'id' => Str::uuid(),
        'group_permission_id' => $statisticService->id,
        'name' => 'statistic_service.update.statistics',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'id' => Str::uuid(),
        'group_permission_id' => $statisticService->id,
        'name' => 'statistic_service.delete.statistics',
        'created_at' => now(),
        'updated_at' => now(),
      ],

      // Export Import Service
      [
        'id' => Str::uuid(),
        'group_permission_id' => $exportImportService->id,
        'name' => 'export_import_service.create.exports',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'id' => Str::uuid(),
        'group_permission_id' => $exportImportService->id,
        'name' => 'export_import_service.read.exports',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'id' => Str::uuid(),
        'group_permission_id' => $exportImportService->id,
        'name' => 'export_import_service.update.exports',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'id' => Str::uuid(),
        'group_permission_id' => $exportImportService->id,
        'name' => 'export_import_service.delete.exports',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'id' => Str::uuid(),
        'group_permission_id' => $exportImportService->id,
        'name' => 'export_import_service.create.imports',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'id' => Str::uuid(),
        'group_permission_id' => $exportImportService->id,
        'name' => 'export_import_service.read.imports',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'id' => Str::uuid(),
        'group_permission_id' => $exportImportService->id,
        'name' => 'export_import_service.update.imports',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'id' => Str::uuid(),
        'group_permission_id' => $exportImportService->id,
        'name' => 'export_import_service.delete.imports',
        'created_at' => now(),
        'updated_at' => now(),
      ],

      // Registration Service
      [
        'id' => Str::uuid(),
        'group_permission_id' => $registrationService->id,
        'name' => 'registration_service.create.registrations',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'id' => Str::uuid(),
        'group_permission_id' => $registrationService->id,
        'name' => 'registration_service.read.registrations',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'id' => Str::uuid(),
        'group_permission_id' => $registrationService->id,
        'name' => 'registration_service.update.registrations',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'id' => Str::uuid(),
        'group_permission_id' => $registrationService->id,
        'name' => 'registration_service.delete.registrations',
        'created_at' => now(),
        'updated_at' => now(),
      ],

      // Monitoring & Evaluation
      [
        'id' => Str::uuid(),
        'group_permission_id' => $monitorEvalService->id,
        'name' => 'monitoring_evaluation_service.create.monitorings',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'id' => Str::uuid(),
        'group_permission_id' => $monitorEvalService->id,
        'name' => 'monitoring_evaluation_service.read.monitorings',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'id' => Str::uuid(),
        'group_permission_id' => $monitorEvalService->id,
        'name' => 'monitoring_evaluation_service.update.monitorings',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'id' => Str::uuid(),
        'group_permission_id' => $monitorEvalService->id,
        'name' => 'monitoring_evaluation_service.delete.monitorings',
        'created_at' => now(),
        'updated_at' => now(),
      ],

      // Consultation & Approval
      [
        'id' => Str::uuid(),
        'group_permission_id' => $consultApproval->id,
        'name' => 'consultation_approval_service.create.consultations',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'id' => Str::uuid(),
        'group_permission_id' => $consultApproval->id,
        'name' => 'consultation_approval_service.read.consultations',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'id' => Str::uuid(),
        'group_permission_id' => $consultApproval->id,
        'name' => 'consultation_approval_service.update.consultations',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'id' => Str::uuid(),
        'group_permission_id' => $consultApproval->id,
        'name' => 'consultation_approval_service.delete.consultations',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'id' => Str::uuid(),
        'group_permission_id' => $consultApproval->id,
        'name' => 'consultation_approval_service.create.approvals',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'id' => Str::uuid(),
        'group_permission_id' => $consultApproval->id,
        'name' => 'consultation_approval_service.read.approvals',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'id' => Str::uuid(),
        'group_permission_id' => $consultApproval->id,
        'name' => 'consultation_approval_service.update.approvals',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'id' => Str::uuid(),
        'group_permission_id' => $consultApproval->id,
        'name' => 'consultation_approval_service.delete.approvals',
        'created_at' => now(),
        'updated_at' => now(),
      ],

      // Calendar Service
      [
        'id' => Str::uuid(),
        'group_permission_id' => $calendarService->id,
        'name' => 'calendar_service.create.calendars',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'id' => Str::uuid(),
        'group_permission_id' => $calendarService->id,
        'name' => 'calendar_service.read.calendars',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'id' => Str::uuid(),
        'group_permission_id' => $calendarService->id,
        'name' => 'calendar_service.update.calendars',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'id' => Str::uuid(),
        'group_permission_id' => $calendarService->id,
        'name' => 'calendar_service.delete.calendars',
        'created_at' => now(),
        'updated_at' => now(),
      ],
    ];

    DB::connection($this->dbConn)->table($this->table)->insert($permissions);
  }

  public function down()
  {
    $permissions = [
      'auth_service.create.users',
      'auth_service.read.users',
      'auth_service.update.users',
      'auth_service.delete.users',

      'user_management.create.roles',
      'user_management.read.roles',
      'user_management.update.roles',
      'user_management.delete.roles',
      'user_management.create.users',
      'user_management.read.users',
      'user_management.update.users',
      'user_management.delete.users',
      'user_management.create.permissions',
      'user_management.read.permissions',
      'user_management.update.permissions',
      'user_management.delete.permissions',
      'user_management.create.group_permissions',
      'user_management.read.group_permissions',
      'user_management.update.group_permissions',
      'user_management.delete.group_permissions',
      'user_management.create.role_permissions',
      'user_management.read.role_permissions',
      'user_management.update.role_permissions',
      'user_management.delete.role_permissions',
      'user_management.create.user_permissions',
      'user_management.read.user_permissions',
      'user_management.update.user_permissions',
      'user_management.delete.user_permissions',

      'activity_management.create.activities',
      'activity_management.read.activities',
      'activity_management.update.activities',
      'activity_management.delete.activities',
    ];

    DB::connection($this->dbConn)
      ->table($this->table)
      ->whereIn('name', $permissions)
      ->delete();
  }
};
