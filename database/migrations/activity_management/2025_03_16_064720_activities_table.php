<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
  protected $dbConn = 'activity_management';
  protected $table = 'activities';

  public function up()
  {
    if (Schema::connection($this->dbConn)->hasTable($this->table)) {
      return;
    }

    Schema::connection($this->dbConn)->create($this->table, function(Blueprint $table) {
      $table->uuid('id')->primary();
      $table->string('name');
      $table->foreignUuid('program_type_id')->nullable()->constrained()->onDelete('set null');
      $table->foreignUuid('group_id')->nullable()->constrained()->onDelete('set null');
      $table->foreignUuid('level_id')->nullable()->constrained()->onDelete('set null');
      $table->text('description')->nullable();
      $table->dateTime('start_period')->nullable();
      $table->integer('months_duration')->nullable();
      $table->string('activity_type')->nullable();
      $table->string('location')->nullable();
      $table->string('web_portal')->nullable();
      $table->string('academic_year')->nullable();
      $table->string('program_provider')->nullable();
      $table->enum('approval_status', ['PENDING', 'APPROVED', 'REJECTED'])->default('PENDING');
      $table->string('submitted_by');
      $table->string('submitted_user_role')->nullable();
      $table->timestamps();
      $table->softDeletes();

      // indexing
      $table->index('name');
      $table->index('program_type_id');
      $table->index('group_id');
      $table->index('level_id');
      $table->index('approval_status');
      $table->index('submitted_by');
      $table->index('submitted_user_role');
      $table->index('program_provider');
      $table->index('academic_year');
    });
  }

  public function down()
  {
    // remove foreign key first
    Schema::connection($this->dbConn)->table($this->table, function(Blueprint $table) {
      $table->dropForeign(['program_type_id']);
      $table->dropForeign(['group_id']);
      $table->dropForeign(['level_id']);
    });
    Schema::connection($this->dbConn)->dropIfExists($this->table);
  }
};