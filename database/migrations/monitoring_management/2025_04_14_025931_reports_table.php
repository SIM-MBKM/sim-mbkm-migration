<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
  protected $dbConn = 'monitoring_management';
  protected $table = 'reports';

  public function up()
  {
    if (Schema::connection($this->dbConn)->hasTable($this->table)) {
      return;
    }

    Schema::connection($this->dbConn)->create($this->table, function(Blueprint $table) {
      $table->uuid('id')->primary();
      $table->foreignUuid('report_schedule_id')->constrained('report_schedules')->onDelete('set null');
      $table->string('title')->nullable();
      $table->text('content')->nullable();
      $table->enum('report_type', ['WEEKLY_REPORT', 'FINAL_REPORT'])->default('WEEKLY_REPORT');
      $table->string('file_storage_id')->nullable();
      $table->text('feedback')->nullable();
      $table->enum('academic_advisor_status', ['PENDING', 'SUBMITTED', 'REVIEWED', 'APPROVED', 'REJECTED'])->default('PENDING');
      $table->timestamps();
      $table->softDeletes();

      // indexing
      $table->index('report_schedule_id');
      $table->index('title');
      $table->index('report_type');
      $table->index('academic_advisor_status');
    });
  }

  public function down()
  {
    Schema::connection($this->dbConn)->dropIfExists($this->table);
  }
};