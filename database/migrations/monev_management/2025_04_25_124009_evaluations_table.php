<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
  protected $dbConn = 'monev_management';
  protected $table = 'evaluations';

  public function up()
  {
    if (Schema::connection($this->dbConn)->hasTable($this->table)) {
      return;
    }

    Schema::connection($this->dbConn)->create($this->table, function (Blueprint $table) {
      $table->uuid('id')->primary();
      $table->string('event_id')->nullable()->index(); // Fetched from events table
      $table->string('mahasiswa_id')->index(); // Fetched from auth service
      $table->string('dosen_pemonev_id')->index();
      $table->string('dosen_pembimbing_id')->index();
      $table->string('activity_id')->index();
      $table->string('registration_id')->index();
      $table->text('notes')->nullable();
      $table->enum('status', ['pending', 'in_progress', 'completed'])->default('pending');
      $table->timestamps();
      $table->softDeletes();
    });
  }

  public function down()
  {
    Schema::connection($this->dbConn)->dropIfExists($this->table);
  }
};
