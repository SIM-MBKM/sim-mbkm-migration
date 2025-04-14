<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

return new class extends Migration
{
    // Config
    protected $dbConn = 'user_management';
    protected $table = 'role_permissions';
    protected $role = 'MAHASISWA';

    // Permission configuration - supports multiple groups
    protected $permissions = [
        // Format: 'group_name' => ['permission1', 'permission2', ...]
        'user_management_service' => [
            'read.users',
            'update.users',
            'read.roles',
            'read.user_permissions', // Required for check-permission access
        ],
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
