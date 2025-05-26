<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
  protected $dbConn = 'monitoring_management';
  protected $table = 'transcripts';

  public function up()
  {
    if (Schema::connection($this->dbConn)->hasTable($this->table)) {
      return;
    }

    Schema::connection($this->dbConn)->create($this->table, function(Blueprint $table) {
      $table->uuid('id')->primary();
      $table->string('registration_id');
      $table->string('user_id')->nullable();
      $table->string('user_nrp');
      $table->string('academic_advisor_id')->nullable();
      $table->string('academic_advisor_email');
      $table->string('title')->nullable();
      $table->string('file_storage_id')->nullable();
      $table->timestamps();
      $table->softDeletes();

      // indexing
      $table->index('registration_id');
      $table->index('user_id');
      $table->index('user_nrp');
      $table->index('academic_advisor_id');
      $table->index('academic_advisor_email');
      $table->index('title');
    });
  }

  public function down()
  {
    Schema::connection($this->dbConn)->dropIfExists($this->table);
  }
};