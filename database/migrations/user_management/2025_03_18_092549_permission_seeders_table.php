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
  protected $connections = ['auth', 'user_management'];

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
    $allPermissions = [];

    foreach ($this->connections as $connection) {
      $tables = $this->getConnectionTables($connection, $config['excluded_tables']);

      // Get the tables assigned to each group for this connection
      foreach ($config['group_mappings'] as $groupName => $mappedTables) {
        // Get the group info from user_management connection (not the current connection)
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
          $permissionsForTable = $this->generateCrudPermissions($group, $table);
          $allPermissions = array_merge($allPermissions, $permissionsForTable);
        }
      }
    }

    // Generate custom permissions
    $customPermissions = $this->generateCustomPermissions($config['custom_permissions']);
    $allPermissions = array_merge($allPermissions, $customPermissions);

    // Insert all collected permissions into the permissions table
    if (!empty($allPermissions)) {
      DB::connection($this->dbConn)
        ->table('permissions')
        ->insertOrIgnore($allPermissions);
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

  protected function generateCrudPermissions($group, string $table): array
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
