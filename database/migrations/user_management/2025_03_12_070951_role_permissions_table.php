<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
  protected $dbConn = 'user_management';
  protected $table = 'role_permissions';

  public function up()
  {
    if (Schema::connection($this->dbConn)->hasTable($this->table)) {
      return;
    }

    Schema::connection($this->dbConn)->create($this->table, function (Blueprint $table) {
      $table->uuid('id')->primary();
      $table->uuid('role_id');
      $table->uuid('permission_id');
      $table->timestamps();

      $table->foreign('role_id')->references('id')->on('roles')->onDelete('CASCADE');
      $table->foreign('permission_id')->references('id')->on('permissions')->onDelete('CASCADE');

      $table->unique(['role_id', 'permission_id']);
    });
  }

  public function down()
  {
    Schema::connection($this->dbConn)->dropIfExists($this->table);
  }
};
