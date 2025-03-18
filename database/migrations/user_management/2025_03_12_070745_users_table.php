<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
  protected $dbConn = 'user_management';
  protected $table = 'users';

  public function up()
  {
    if (Schema::connection($this->dbConn)->hasTable($this->table)) {
      return;
    }

    Schema::connection($this->dbConn)->create($this->table, function (Blueprint $table) {
      $table->uuid('id')->primary();
      $table->uuid('auth_user_id'); //Fetched from auth service
      $table->uuid('role_id'); // 1 Role for 1 User
      $table->timestamps();

      $table->foreign('role_id')->references('id')->on('roles')->onDelete('CASCADE');
    });
  }

  public function down()
  {
    Schema::connection($this->dbConn)->dropIfExists($this->table);
  }
};
