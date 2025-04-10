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
      // REQUEST TAMBAHAN
      $table->integer('age')->nullable();
      $table->string('nrp')->unique()->nullable();
      $table->timestamps();
      //SYNC with auth_service
      $table->timestamp('last_synced_at')->nullable();
      $table->boolean('needs_sync')->default(false);

      $table->foreign('role_id')->references('id')->on('roles')->onDelete('CASCADE');
      // Add indexes
      $table->index('auth_user_id');
      $table->index('nrp');
      $table->index('role_id');
      $table->index('needs_sync');
    });
  }

  public function down()
  {
    Schema::connection($this->dbConn)->dropIfExists($this->table);
  }
};
