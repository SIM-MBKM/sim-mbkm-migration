<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
  protected $dbConn = 'auth_management';
  protected $table = 'sessions';

  public function up()
  {
    if (Schema::connection($this->dbConn)->hasTable($this->table)) {
      return;
    }

    Schema::connection($this->dbConn)->create($this->table, function (Blueprint $table) {
      $table->string('id')->primary(); //Requirement from socialite
      $table->uuid('user_id')->index();
      $table->string('token_hash')->index(); // Hashed JWT token
      $table->longText('payload');
      $table->text('user_agent')->nullable(); // User agent or device identifier
      $table->string('ip_address')->nullable();
      $table->integer('last_activity');
      $table->timestamp('expires_at');
      $table->timestamps();
      $table->softDeletes();

      $table->foreign('user_id')->references('id')->on('users')->onDelete('CASCADE');
    });
  }

  public function down()
  {
    Schema::connection($this->dbConn)->dropIfExists($this->table);
  }
};
