<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
  protected $dbConn = 'auth';
  protected $table = 'login_histories';

  public function up()
  {
    if (Schema::connection($this->dbConn)->hasTable($this->table)) {
      return;
    }

    Schema::connection($this->dbConn)->create($this->table, function (Blueprint $table) {
      $table->uuid('id')->primary();
      $table->uuid('user_id')->index();
      $table->string('auth_method'); // 'jwt', 'sso', 'google', 'access_key'
      $table->string('ip_address')->nullable();
      $table->string('user_agent')->nullable();
      $table->boolean('success');
      $table->string('failure_reason')->nullable();
      $table->timestamps();

      $table->foreign('user_id')->references('id')->on('users')->onDelete('CASCADE');
    });
  }

  public function down()
  {
    Schema::connection($this->dbConn)->dropIfExists($this->table);
  }
};
