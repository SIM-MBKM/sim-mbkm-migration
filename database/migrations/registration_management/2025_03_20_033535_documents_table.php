<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
  protected $dbConn = 'registration_management';
  protected $table = 'documents';

  public function up()
  {
    if (Schema::connection($this->dbConn)->hasTable($this->table)) {
      return;
    }

    Schema::connection($this->dbConn)->create($this->table, function(Blueprint $table) {
      $table->uuid('id')->primary();
      $table->string('file_storage_id');
      $table->string('name');
      $table->string('document_type');
      $table->foreignUuid('registration_id')->constrained()->onDelete('set null');
      $table->timestamps();
      $table->softDeletes();

      // indexing
      $table->index('file_storage_id');
      $table->index('name');
      $table->index('document_type');
      $table->index('registration_id');
    });
  }

  public function down()
  {
    // drop foreign key first
    Schema::connection($this->dbConn)->table($this->table, function(Blueprint $table) {
      $table->dropForeign(['registration_id']);
    });
    Schema::connection($this->dbConn)->dropIfExists($this->table);
  }
};