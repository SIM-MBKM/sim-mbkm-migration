<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
  protected $dbConn = 'report_management';
  protected $table = 'report_service_seeders';

  public function up()
  {
    if (Schema::connection($this->dbConn)->hasTable($this->table)) {
      return;
    }

    Schema::connection($this->dbConn)->create($this->table, function(Blueprint $table) {
      $table->uuid('id')->primary();
      $table->timestamps();
    });
  }

  public function down()
  {
    Schema::connection($this->dbConn)->dropIfExists($this->table);
  }
};