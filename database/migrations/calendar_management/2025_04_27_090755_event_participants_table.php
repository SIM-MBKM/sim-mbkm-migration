<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
  protected $dbConn = 'calendar_management';
  protected $table = 'event_participants';

  public function up()
  {
    if (Schema::connection($this->dbConn)->hasTable($this->table)) {
      return;
    }

    Schema::connection($this->dbConn)->create($this->table, function (Blueprint $table) {
      $table->uuid('id')->primary();
      $table->uuid('event_id'); // Fetched from events table
      $table->uuid('auth_user_id'); // Fetched from auth service
      $table->timestamps();
      $table->softDeletes();

      $table->foreign('event_id')->references('id')->on('events')->onDelete('CASCADE');
      $table->unique(['event_id', 'auth_user_id']); // Ensure a user can only RSVP once for an event
      $table->index('event_id');
      $table->index('auth_user_id');
    });
  }

  public function down()
  {
    Schema::connection($this->dbConn)->dropIfExists($this->table);
  }
};
