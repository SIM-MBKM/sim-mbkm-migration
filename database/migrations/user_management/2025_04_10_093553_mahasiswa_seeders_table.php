<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

return new class extends Migration
{
    protected $dbConn = 'user_management';
    protected $table = 'role_permissions';

    public function up()
    {
        // Get the MAHASISWA role
        $mahasiswaRole = DB::connection($this->dbConn)
            ->table('roles')
            ->where('name', 'MAHASISWA')
            ->first();

        if (!$mahasiswaRole) {
            return;
        }

        // Get the user_management_service group
        $userMgmtGroup = DB::connection($this->dbConn)
            ->table('group_permissions')
            ->where('name', 'user_management_service')
            ->first();

        if (!$userMgmtGroup) {
            return;
        }

        // Find the limited permissions for a student
        $limitedPermissions = DB::connection($this->dbConn)
            ->table('permissions')
            ->whereIn('name', [
                'user_management_service.read.users',
                'user_management_service.update.users',
                // 'user_management_service.read.roles',
                // 'user_management_service.read.permissions',
                // Add other permissions as needed
            ])
            ->get();

        // Assign these permissions to the MAHASISWA role
        $rolePermissions = [];
        foreach ($limitedPermissions as $permission) {
            $rolePermissions[] = [
                'id' => Str::uuid()->toString(),
                'role_id' => $mahasiswaRole->id,
                'permission_id' => $permission->id,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        if (!empty($rolePermissions)) {
            DB::connection($this->dbConn)
                ->table($this->table)
                ->insertOrIgnore($rolePermissions);
        }
    }

    public function down()
    {
        // Get the MAHASISWA role
        $mahasiswaRole = DB::connection($this->dbConn)
            ->table('roles')
            ->where('name', 'MAHASISWA')
            ->first();

        if (!$mahasiswaRole) {
            return;
        }

        // Remove all permissions for this role
        DB::connection($this->dbConn)
            ->table($this->table)
            ->where('role_id', $mahasiswaRole->id)
            ->delete();
    }
};
