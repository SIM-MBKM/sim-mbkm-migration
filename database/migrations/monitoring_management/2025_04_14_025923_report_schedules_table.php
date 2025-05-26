<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
  protected $dbConn = 'monitoring_management';
  protected $table = 'report_schedules';

  public function up()
  {
    if (Schema::connection($this->dbConn)->hasTable($this->table)) {
      return;
    }

    Schema::connection($this->dbConn)->create($this->table, function(Blueprint $table) {
      $table->uuid('id')->primary();
      $table->string('user_id')->nullable();
      $table->string('user_nrp');
      $table->string('registration_id');
      $table->string('academic_advisor_id');
      $table->string("academic_advisor_email");
      $table->enum('report_type', ['WEEKLY_REPORT', 'FINAL_REPORT']);
      $table->integer('week');
      $table->date('start_date');
      $table->date('end_date');
      $table->timestamps();
      $table->softDeletes();

      // indexing
      $table->index('user_id');
      $table->index('user_nrp');
      $table->index('registration_id');
      $table->index('academic_advisor_id');
      $table->index('academic_advisor_email');
      $table->index('report_type');
      $table->index('week');
    });
  }

  public function down()
  {
    Schema::connection($this->dbConn)->dropIfExists($this->table);
  }
};