<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
  protected $dbConn = 'registration_management';
  protected $table = 'registrations';

  public function up()
  {
    if (Schema::connection($this->dbConn)->hasTable($this->table)) {
      return;
    }

    Schema::connection($this->dbConn)->create($this->table, function(Blueprint $table) {
      $table->uuid('id')->primary();
      $table->string('activity_id');
      $table->string('activity_name');
      $table->string('user_id');
      $table->string('user_name');
      $table->string('user_nrp');
      $table->boolean('advising_confirmation')->default(false);
      $table->string('academic_advisor_id')->nullable();
      $table->string('academic_advisor')->nullable();
      $table->string('academic_advisor_email')->nullable();
      $table->string('mentor_name')->nullable();
      $table->string('mentor_email')->nullable();
      $table->enum('academic_advisor_validation', ['PENDING', 'APPROVED', 'REJECTED'])->default('PENDING');
      $table->enum('lo_validation', ['PENDING', 'APPROVED', 'REJECTED'])->default('PENDING');
      $table->integer('semester');
      $table->integer('total_sks');
      $table->boolean('approval_status');
      $table->timestamps();
      $table->softDeletes();
    });
  }

  public function down()
  {
    Schema::connection($this->dbConn)->dropIfExists($this->table);
  }
};