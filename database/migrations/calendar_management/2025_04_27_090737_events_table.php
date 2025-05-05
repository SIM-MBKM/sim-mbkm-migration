<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
  protected $dbConn = 'calendar_management';
  protected $table = 'events';

  public function up()
  {
    if (Schema::connection($this->dbConn)->hasTable($this->table)) {
      return;
    }

    Schema::connection($this->dbConn)->create($this->table, function (Blueprint $table) {
      $table->uuid('id')->primary();
      $table->string('title');
      $table->text('description')->nullable();
      $table->date('event_date');
      $table->time('start_time');
      $table->time('end_time');
      $table->string('location')->nullable();
      $table->string('meeting_link')->nullable();
      $table->enum('status', ['active', 'completed', 'cancelled'])->default('active');
      $table->string('event_type')->nullable();
      $table->uuid('creator_auth_user_id'); // Fetched from auth service
      $table->timestamps();
      $table->softDeletes();
    });
  }

  public function down()
  {
    Schema::connection($this->dbConn)->dropIfExists($this->table);
  }
};
