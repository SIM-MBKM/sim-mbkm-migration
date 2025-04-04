<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
  protected $dbConn = 'matching_management';
  protected $table = 'documents';

  public function up()
  {
    if (Schema::connection($this->dbConn)->hasTable($this->table)) {
      return;
    }

    Schema::connection($this->dbConn)->create($this->table, function(Blueprint $table) {
      $table->uuid('id')->primary();
      $table->foreignUuid('subject_id')->constrained('subjects')->onDelete('set null');
      $table->string('file_storage_id')->nullable();
      $table->string('name')->nullable();
      $table->string('document_type')->nullable();
      $table->timestamps();
    });
  }

  public function down()
  {
    Schema::connection($this->dbConn)->dropIfExists($this->table);
  }
};