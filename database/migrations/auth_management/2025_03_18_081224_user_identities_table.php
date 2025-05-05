<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
  protected $dbConn = 'auth_management';
  protected $table = 'user_identities';

  public function up()
  {
    if (Schema::connection($this->dbConn)->hasTable($this->table)) {
      return;
    }

    Schema::connection($this->dbConn)->create($this->table, function (Blueprint $table) {
      $table->uuid('id')->primary();
      $table->uuid('user_id')->index();
      $table->string('provider');
      $table->string('provider_user_id');
      $table->text('access_token')->nullable();
      $table->text('refresh_token')->nullable();
      $table->timestamp('expires_at')->nullable();
      $table->json('provider_data')->nullable();
      $table->timestamps();
      $table->softDeletes();

      $table->unique(['provider', 'provider_user_id']);
      $table->foreign('user_id')->references('id')->on('users')->onDelete('CASCADE');
    });
  }

  public function down()
  {
    Schema::connection($this->dbConn)->dropIfExists($this->table);
  }
};
