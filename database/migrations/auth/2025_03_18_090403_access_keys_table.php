<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
  protected $dbConn = 'auth';
  protected $table = 'access_keys';

  public function up()
  {
    if (Schema::connection($this->dbConn)->hasTable($this->table)) {
      return;
    }

    Schema::connection($this->dbConn)->create($this->table, function (Blueprint $table) {
      $table->uuid('id')->primary();
      $table->uuid('user_id')->index();
      $table->string('key_hash')->index(); // Hashed API key
      $table->string('description');
      $table->json('scopes')->nullable();
      $table->boolean('is_active')->default(true);
      $table->timestamp('expires_at')->nullable();
      $table->timestamp('last_used_at')->nullable();
      $table->timestamps();

      $table->foreign('user_id')->references('id')->on('users')->onDelete('CASCADE');
    });
  }

  public function down()
  {
    Schema::connection($this->dbConn)->dropIfExists($this->table);
  }
};
