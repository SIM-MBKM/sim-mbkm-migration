<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
  protected $dbConn = 'monev_management';
  protected $table = 'partner_ratings';

  public function up()
  {
    if (Schema::connection($this->dbConn)->hasTable($this->table)) {
      return;
    }

    Schema::connection($this->dbConn)->create($this->table, function (Blueprint $table) {
      $table->uuid('id')->primary();
      $table->uuid('activity_id')->index(); // Fetched from activities service
      $table->uuid('auth_user_id')->index(); // Fetched from auth service
      $table->integer('rating')->default(0); // Rating value (1-5)
      $table->text('comment')->nullable(); // Optional comment
      $table->boolean('is_anonymous')->default(true); // Whether the rating is anonymous
      $table->boolean('is_published')->default(false); // Whether the rating is published publicly -- for further checking
      $table->uuid('approved_by')->nullable(); // Fetched from auth service
      $table->timestamp('approved_at')->nullable(); // Timestamp when the rating was approved
      $table->timestamps();
      $table->softDeletes();

      $table->unique(['activity_id', 'auth_user_id']);
    });
  }

  public function down()
  {
    Schema::connection($this->dbConn)->dropIfExists($this->table);
  }
};
