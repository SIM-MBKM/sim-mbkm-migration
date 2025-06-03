<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

return new class extends Migration
{
  // Config
  protected $dbConn = 'user_management';
  protected $table = 'role_permissions';
  protected $role = 'ADMIN';

  // Permission configuration - supports multiple groups
  protected $permissions = [
    // Format: 'group_name' => ['permission1', 'permission2', ...]
    'user_management_service' => [
      // User management permissions
      'read.users',
      'read-all.users',
      'update.users',
      'update-all.users',
      'create.users',
      'delete.users',

      // Role permissions
      'read.roles',
      'read-all.roles',
      'create.roles',
      'update.roles',
      'update-all.roles',
      'delete.roles',

      // Permission management
      'read.permissions',
      'read-all.permissions',
      'create.permissions',
      'update.permissions',
      'delete.permissions',

      // Role permissions
      'read.role_permissions',
      'read-all.role_permissions',
      'create.role_permissions',
      'update.role_permissions',
      'delete.role_permissions',

      // Group permissions
      'read.group_permissions',
      'read-all.group_permissions',
      'create.group_permissions',
      'update.group_permissions',
      'delete.group_permissions',

      // User permissions
      'read.user_permissions',
      'read-all.user_permissions',
      'create.user_permissions',
      'update.user_permissions',
      'update-all.user_permissions',
      'delete.user_permissions',
      'delete-all.user_permissions',
    ],

    'monev_service' => [
      // Monitoring and evaluation permissions
      'read.evaluations',
      'read-all.evaluations',
      'create.evaluations',
      'update.evaluations',
      'update-all.evaluations',
      'delete.evaluations',

      // Evaluation Scores
      'read.evaluation_scores',
      'read-all.evaluation_scores',
      'create.evaluation_scores',
      'update.evaluation_scores',
      'update-all.evaluation_scores',
      'delete.evaluation_scores',

      // Partner ratings
      'read.partner_ratings',
      'read-all.partner_ratings',
      'create.partner_ratings',
      'update.partner_ratings',
      'update-all.partner_ratings',
      'delete.partner_ratings',
    ],

    'calendar_service' => [
      // Calendar permissions
      'read.events',
      'read-all.events',
      'create.events',
      'update.events',
      'update-all.events',
      'delete.events',

      // Event participants
      'read.event_participants',
      'read-all.event_participants',
      'create.event_participants',
      'update.event_participants',
      'update-all.event_participants',
      'delete.event_participants',
    ],

    'report_service' => [
      // Report permissions
      'read.reports',
      'read-all.reports',
      'create.reports',
      'update.reports',
      'update-all.reports',
      'delete.reports'
    ]
  ];

  public function up()
  {
    // Get the role
    $role = $this->getRole();
    if (!$role) {
      return;
    }

    // Get permissions to assign
    $permissions = $this->getPermissions();
    if ($permissions->isEmpty()) {
      return;
    }

    // Create role permission entries
    $rolePermissions = $this->createRolePermissions($role, $permissions);

    // Insert role permissions if any exist
    if (!empty($rolePermissions)) {
      DB::connection($this->dbConn)
        ->table($this->table)
        ->insertOrIgnore($rolePermissions);
    }
  }

  public function down()
  {
    // Get the role
    $role = $this->getRole();
    if (!$role) {
      return;
    }

    // Remove all permissions for this role
    DB::connection($this->dbConn)
      ->table($this->table)
      ->where('role_id', $role->id)
      ->delete();
  }

  /**
   * Get the role to which permissions will be assigned
   * 
   * @return object|null
   */
  protected function getRole()
  {
    return DB::connection($this->dbConn)
      ->table('roles')
      ->where('name', $this->role)
      ->first();
  }

  /**
   * Get the permissions to assign to the role
   * 
   * @return \Illuminate\Support\Collection
   */
  protected function getPermissions()
  {
    // Build a flat list of fully qualified permission names
    $formattedPermissions = [];

    foreach ($this->permissions as $group => $permissions) {
      foreach ($permissions as $permission) {
        $formattedPermissions[] = "{$group}.{$permission}";
      }
    }

    return DB::connection($this->dbConn)
      ->table('permissions')
      ->whereIn('name', $formattedPermissions)
      ->get();
  }

  /**
   * Create the role permission entries
   * 
   * @param object $role
   * @param \Illuminate\Support\Collection $permissions
   * @return array
   */
  protected function createRolePermissions($role, $permissions)
  {
    $rolePermissions = [];
    foreach ($permissions as $permission) {
      $rolePermissions[] = [
        'id' => Str::uuid()->toString(),
        'role_id' => $role->id,
        'permission_id' => $permission->id,
        'created_at' => now(),
        'updated_at' => now(),
      ];
    }

    return $rolePermissions;
  }
};
