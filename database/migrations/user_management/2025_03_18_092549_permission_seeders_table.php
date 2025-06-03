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

  // List connections to collect tables
  protected $connections = ['auth_management', 'user_management', 'activity_management', 'matching_management', 'registration_management', 'monitoring_management', 'monev_management', 'calendar_management', 'report_management'];

  // Config array
  protected function config(): array
  {
    return [
      'excluded_tables' => [
        'migrations',
        'password_resets',
        'failed_jobs'
      ],
      'group_mappings' => [
        'auth_service' => ['users'],
        'user_management_service' => ['roles', 'permissions', 'group_permissions', 'role_permissions', 'user_permissions', 'users'],
        'calendar_service' => ['events', 'event_participants'],
        'monev_service' => ['evaluations', 'evaluation_scores', 'partner_ratings'],
        'report_service' => ['reports'],
        // 'activity_management_service' => ['activities', 'groups', 'levels', 'program_types'],
        // 'matching_service' 
      ],
      'custom_permissions' => [
        // Permissions not tied to specific tables
        // [
        //   'group' => 'auth_service',
        //   'name' => 'auth_service.manage.system_settings'
        // ]
      ]
    ];
  }

  public function up()
  {
    $config = $this->config();
    $processedPermissions = []; // Track processed permissions to avoid duplicates

    foreach ($this->connections as $connection) {
      $tables = $this->getConnectionTables($connection, $config['excluded_tables']);

      // Get the tables assigned to each group for this connection
      foreach ($config['group_mappings'] as $groupName => $mappedTables) {
        // Get the group info from user_management connection
        $group = DB::connection($this->dbConn)
          ->table('group_permissions')
          ->where('name', $groupName)
          ->first();

        if (!$group) {
          continue;
        }

        // Filter tables that are both in this connection and assigned to this group
        $relevantTables = array_intersect($tables, $mappedTables);

        // Generate CRUD permissions for these tables
        foreach ($relevantTables as $table) {
          $permissionsForTable = $this->generateCrudPermissions($group, $table, $processedPermissions);

          // Only merge new permissions
          $newPermissions = array_filter($permissionsForTable, function ($permission) use (&$processedPermissions) {
            if (in_array($permission['name'], $processedPermissions)) {
              return false;
            }
            $processedPermissions[] = $permission['name'];
            return true;
          });

          // Insert only unique permissions
          if (!empty($newPermissions)) {
            DB::connection($this->dbConn)
              ->table('permissions')
              ->insertOrIgnore($newPermissions);
          }
        }
      }
    }

    // Generate custom permissions
    $customPermissions = $this->generateCustomPermissions($config['custom_permissions']);
    foreach ($customPermissions as $permission) {
      if (!in_array($permission['name'], $processedPermissions)) {
        DB::connection($this->dbConn)
          ->table('permissions')
          ->insertOrIgnore([$permission]);
        $processedPermissions[] = $permission['name'];
      }
    }
  }

  protected function getConnectionTables(string $connection, array $excludedTables): array
  {
    $tableNameField = $this->getTableNameField($connection);

    return collect(Schema::connection($connection)->getTables())
      ->map(function ($table) use ($tableNameField) {
        return $table['name'] ?? $table->{$tableNameField};
      })
      ->reject(function ($table) use ($excludedTables) {
        return in_array($table, $excludedTables);
      })
      ->values()
      ->toArray();
  }

  protected function getTableNameField(string $connection): string
  {
    return match (DB::connection($connection)->getDriverName()) {
      'mysql' => 'Tables_in_' . DB::connection($connection)->getDatabaseName(),
      'pgsql' => 'tablename',
      'sqlite' => 'name',
      default => 'name'
    };
  }

  protected function generateCrudPermissions($group, string $table, array &$processedPermissions): array
  {
    return collect(['create', 'read', 'read-all', 'update', 'update-all', 'delete', 'delete-all'])
      ->map(function ($action) use ($group, $table) {
        return [
          'id' => Str::uuid()->toString(),
          'group_permission_id' => $group->id,
          'name' => "{$group->name}.{$action}.{$table}",
          'created_at' => now(),
          'updated_at' => now(),
        ];
      })
      ->toArray();
  }

  protected function generateCustomPermissions(array $customPermissions): array
  {
    $permissions = [];

    foreach ($customPermissions as $permission) {
      $group = DB::connection($this->dbConn)
        ->table('group_permissions')
        ->where('name', $permission['group'])
        ->first();

      if (!$group) {
        continue;
      }

      $permissions[] = [
        'id' => Str::uuid()->toString(),
        'group_permission_id' => $group->id,
        'name' => $permission['name'],
        'created_at' => now(),
        'updated_at' => now(),
      ];
    }

    return $permissions;
  }

  public function down()
  {
    $config = $this->config();

    // Delete CRUD permissions based on group mappings
    foreach ($config['group_mappings'] as $groupName => $mappedTables) {
      $group = DB::connection($this->dbConn)
        ->table('group_permissions')
        ->where('name', $groupName)
        ->first();

      if (!$group) {
        continue;
      }

      foreach ($mappedTables as $table) {
        foreach (['create', 'read', 'update', 'delete'] as $action) {
          $permissionName = "{$groupName}.{$action}.{$table}";
          DB::connection($this->dbConn)
            ->table('permissions')
            ->where('name', $permissionName)
            ->delete();
        }
      }
    }

    // Delete custom permissions
    foreach ($config['custom_permissions'] as $permission) {
      DB::connection($this->dbConn)
        ->table('permissions')
        ->where('name', $permission['name'])
        ->delete();
    }
  }
};
