<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
  protected $dbConn = 'matching_management';
  protected $table = 'subjects';

  public function up()
  {
    if (Schema::connection($this->dbConn)->hasTable($this->table)) {
      return;
    }

    Schema::connection($this->dbConn)->create($this->table, function(Blueprint $table) {
      $table->uuid('id')->primary();
      $table->string('mata_kuliah');
      $table->string('kode')->unique();
      $table->enum('semester', ['GANJIL', 'GENAP']);
      $table->string('prodi_penyeelenggara');
      $table->integer('sks');
      $table->string('kelas');
      $table->string('departemen');
      $table->string('tipe_mata_kuliah');
      $table->timestamps();
    });
  }

  public function down()
  {
    Schema::connection($this->dbConn)->dropIfExists($this->table);
  }
};