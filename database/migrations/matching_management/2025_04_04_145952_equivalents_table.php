<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
  protected $dbConn = 'matching_management';
  protected $table = 'equivalents';

  public function up()
  {
    if (Schema::connection($this->dbConn)->hasTable($this->table)) {
      return;
    }

    Schema::connection($this->dbConn)->create($this->table, function(Blueprint $table) {
      $table->uuid('id')->primary();
      $table->string('registration_id');
      $table->foreignUuid('subject_id')->constrained('subjects')->onDelete('set null');
      $table->timestamps();
      $table->softDeletes();

      // indexing
      $table->index('registration_id');
      $table->index('subject_id');
    });
  }

  public function down()
  {
    // drop foreign key first
    Schema::connection($this->dbConn)->table($this->table, function(Blueprint $table) {
      $table->dropForeign(['subject_id']);
    });
    Schema::connection($this->dbConn)->dropIfExists($this->table);
  }
};