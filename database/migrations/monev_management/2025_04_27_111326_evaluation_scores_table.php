<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
  protected $dbConn = 'monev_management';
  protected $table = 'evaluation_scores';

  public function up()
  {
    if (Schema::connection($this->dbConn)->hasTable($this->table)) {
      return;
    }

    Schema::connection($this->dbConn)->create($this->table, function (Blueprint $table) {
      $table->uuid('id')->primary();
      $table->uuid('evaluation_id')->index(); // Fetched from evaluations table
      $table->uuid('subject_id')->index(); // Fetched from subject being evaluated
      $table->json('subject_data')->nullable(); // JSON data for the subject (e.g., activity, registration, etc.)
      $table->float('score')->nullable(); // Score given by the dosen pemonev
      $table->char('grade_letter', 2)->nullable(); // Grade letter (A, AB, A-, B, BC, B-, C, CD, C-, D, E)
      $table->timestamps();
      $table->softDeletes();

      $table->foreign('evaluation_id')->references('id')->on('evaluations')->onDelete('CASCADE');
    });
  }

  public function down()
  {
    Schema::connection($this->dbConn)->dropIfExists($this->table);
  }
};
