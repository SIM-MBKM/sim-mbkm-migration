<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

return new class extends Migration
{
  protected $dbConn = 'user_management';
  protected $table = 'group_permissions';

  public function up()
  {
    $groups = [
      ['id' => Str::uuid(), 'name' => 'auth_service', 'description' => 'Group for auth service', 'created_at' => now(), 'updated_at' => now()],
      ['id' => Str::uuid(), 'name' => 'activity_management_service', 'description' => 'Group for activity management service', 'created_at' => now(), 'updated_at' => now()],
      ['id' => Str::uuid(), 'name' => 'user_management_service', 'description' => 'Group for user management service', 'created_at' => now(), 'updated_at' => now()],
      ['id' => Str::uuid(), 'name' => 'matching_service', 'description' => 'Group for matching service', 'created_at' => now(), 'updated_at' => now()],
      ['id' => Str::uuid(), 'name' => 'report_service', 'description' => 'Group for report statistic service', 'created_at' => now(), 'updated_at' => now()],
      ['id' => Str::uuid(), 'name' => 'registration_service', 'description' => 'Group for registration service', 'created_at' => now(), 'updated_at' => now()],
      ['id' => Str::uuid(), 'name' => 'monev_service', 'description' => 'Group for monitoring & evaluation service', 'created_at' => now(), 'updated_at' => now()],
      ['id' => Str::uuid(), 'name' => 'calendar_service', 'description' => 'Group for calendar service', 'created_at' => now(), 'updated_at' => now()],
      ['id' => Str::uuid(), 'name' => 'monitoring_service', 'description' => 'Group for monitoring documents such as logbook', 'created_at' => now(), 'updated_at' => now()],
      ['id' => Str::uuid(), 'name' => 'notification_service', 'description' => 'Group for notification service', 'created_at' => now(), 'updated_at' => now()],
    ];

    DB::connection($this->dbConn)->table($this->table)->insert($groups);
  }

  public function down()
  {
    DB::connection($this->dbConn)->table($this->table)->whereIn('name', [
      'auth_service',
      'activity_management_service',
      'user_management_service',
      'matching_service',
      'statistic_service',
      'export_import_service',
      'registration_service',
      'monitoring_evaluation_service',
      'consultation_approval_service',
      'calendar_service',
    ])->delete();
  }
};
